<?php

namespace App\Http\Controllers;

use App\Models\BranchMaster;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
use App\Traits\ApiResponser;

class HomeController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layout.layout');
    }

    public function password_forgot()
    {
        return view('auth.passwords.reset');
    }

    public function password_reset(request $request)
    {
        $validator = \Validator::make($request->all(), [
            'password' => 'required',
            'conform_password' => 'required_with:password|same:password',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages()->first(), 200);
        } else {
            $password = Hash::make($request->password);
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->password = $password;
            $user->save();
        }
        return $this->successResponse([], 'password update successfully');
    }

    public function users()
    {
        $user = User::select(
            'id',
            'name',
            'email',
            'add',
            'edit',
            'delete',
            'user_type',
            \DB::raw("(SELECT branch_name from branch_masters WHERE branch_masters.id=users.branch_id) as branch_name"),
        )->orderBy('id')->get();

        $brance = BranchMaster::select(
            'id',
            'branch_name',
        )->get();
        return view('users', compact('user', 'brance'));
    }

    public function new_user(request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'branch_name' => 'required',
            'password' => 'required',
            'conform_password' => 'required_with:password|same:password',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages()->first(), 200);
        } else {
            $password = Hash::make($request->password);
            $user = new User;
            $user->name = $request->name;
            if ($request->email != "") {
                $user->email = $request->email;
            } else {
                $email = $request->name . '@diamond.com';
                $user->email = $email;
            }
            $user->branch_id = $request->branch_name;
            $user->user_type = $request->roles;
            $user->user_status = 1;
            $user->a_status = 1;
            $user->master_country_id = 1;

            if ($request->has('add')) {
                $user->add = 1;
            } else {
                $user->add = 0;
            }

            if ($request->has('edit')) {
                $user->edit = 1;
            } else {
                $user->edit = 0;
            }

            if ($request->has('delete')) {
                $user->delete = 1;
            } else {
                $user->delete = 0;
            }

            $user->password = $password;

            if ($user->save()) {
                $p = new Permission();
                $p->user_id = $user->id;
                $p->add = $request->has('add') ? 1 : 0;
                $p->edit =  $request->has('edit') ? 1 : 0;
                $p->delete =  $request->has('delete') ? 1 : 0;
                $p->masters_side =  $request->has('masters_side') ? 1 : 0;
                $p->save();
            }
            $user->save();
        }
        return $this->successResponse([], 'user create successfully');
    }

    public function edit_user(Request $request)
    {
        $user = User::select(
            'id',
            'name',
            'email',
            'add',
            'edit',
            'delete',
            'user_type',
            \DB::raw("(SELECT branch_name from branch_masters WHERE branch_masters.id=users.branch_id) as branch_name"),
        )->where('id', $request->id)->get();

        return $this->successResponse($user, 'get invoice successfully');
    }

    public function user_update_new(request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($request->password != "") {
            $validator = \Validator::make($request->all(), [
                'password' => 'required',
                'conform_password' => 'required_with:password|same:password',
            ]);
        }


        if ($validator->fails()) {
            return $this->errorResponse($validator->messages()->first(), 200);
        } else {
            $user = User::find($request->id);
            $user->name = $request->name;
            if ($request->email != "") {
                $user->email = $request->email;
            } else {
                $email = $request->name . '@diamond.com';
                $user->email = $email;
            }
            $user->user_status = 1;
            $user->a_status = 1;
            $user->master_country_id = 1;
            if ($request->password != "") {
                $password = Hash::make($request->password);
                $user->password = $password;
            }
            $user->save();
        }
        return $this->successResponse([], 'user update successfully');
    }

    public function user_update(request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        if ($request->type == "add") {
            $user->add = $request->value;
        }
        if ($request->type == "edit") {
            $user->edit = $request->value;
        }
        if ($request->type == "delete") {
            $user->delete = $request->value;
        }
        if ($request->type == "branch_id") {
            $user->branch_id = $request->value;
        }
        if ($request->type == "role") {
            $user->user_type = $request->value;
        }
        $user->save();
    }

    public function get_users()
    {
        $user = User::select(
            'id',
            'name',
            'email',
            'add',
            'edit',
            'delete',
            'user_type',
            \DB::raw("(SELECT branch_name from branch_masters WHERE branch_masters.id=users.branch_id) as branch_name"),
        )->orderBy('id')->get();

        return $this->successResponse($user, 'get user successfully');
    }

    public function user_activity()
    {
        return view('activitys');
    }

    public function user_logs(Request $request)
    {
        $activity = UserActivity::select(
            'ip',
            'location',
            \DB::raw("(SELECT name from users WHERE users.id=user_activity.user_id) as user_id"),
            'created_at',
        )->orderBy('created_at', 'desc')->limit(30)->get();

        return $this->successResponse($activity, 'get activity successfully');
    }

    public function permissions(Request $request)
    {
        $permission = Permission::where('user_id', $request->user_id)->first();
        if (empty($permission)) {
            $permission = new Permission();
            $permission->user_id = $request->user_id;
            $permission->save();
        }
        return view('permissions', compact('permission'));
    }

    public function permissions_update(Request $request)
    {
        $user = User::find($request->user_id);
        $user->add = $request->has('add') ? 1 : 0;
        $user->edit = $request->has('edit') ? 1 : 0;
        $user->delete = $request->has('delete') ? 1 : 0;
        if ($user->save()) {

            $p = Permission::where('user_id', $request->user_id)->first();

            if (empty($p)) {
                $p = new Permission();
                $p->user_id = $request->user_id;
            }
            $p->add = $request->has('add') ? 1 : 0;
            $p->edit = $request->has('edit') ? 1 : 0;
            $p->delete = $request->has('delete') ? 1 : 0;
            $p->masters_side =  $request->has('masters_side') ? 1 : 0;
            $p->save();
        }
        return $this->successResponse([], 'user permission updated successfully');
    }
}
