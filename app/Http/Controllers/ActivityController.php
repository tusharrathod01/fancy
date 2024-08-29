<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use DB;

use App\Traits\ApiResponser;

class ActivityController extends Controller
{
    use ApiResponser;
    public function myActivity()
    {
        return view('activity.my_activity');
    }

    public function getMyActivity(Request $request)
    {
        $from = date('Y-m-d', strtotime($request->from));
        $to = date('Y-m-d', strtotime($request->to . ' +1 day'));
        $user = auth()->user();

        $activity = Activity::select(
            DB::raw("(SELECT name from users where users.id = activitys.user_id) as user_name"),
            \DB::raw("(SELECT branch_name from branch_masters WHERE branch_masters.id=activitys.branch_id) as client"),
            'activitys.comment',
            'activitys.old_data',
            'activitys.types',
            'activitys.created_at',
            'activitys.id',
            'activitys.bill_no',
            'activitys.inv_no',
            'activitys.party',
        )->where('branch_id', auth()->user()->branch_id)
            ->whereBetween('activitys.created_at', [$from, $to])
            ->orderBy('id', 'DESC')->get();
        return $this->successResponse($activity, 'Invoice Accepted');
    }

    public function getMyActivityDetail(Request $request)
    {

        $activity = Activity::find($request->id);
        if ($activity->pur_sale_type == 'master') {
            return view('activity.master', compact('activity'));
        }
        // if ($activity->pur_sale_type == 'purchase') {
        //     return view('activity.purchase', compact('activity'));
        // }
        // if ($activity->pur_sale_type == 'sale') {
        //     return view('activity.sale', compact('activity'));
        // }
        // if ($activity->pur_sale_type == 'Consignment') {
        //     return view('activity.consignment', compact('activity'));
        // }
        // if ($activity->pur_sale_type == 'consignment_return') {
        //     return view('activity.consignment_return', compact('activity'));
        // }
        // if ($activity->pur_sale_type == 'branch') {
        //     return view('activity.branch', compact('activity'));
        // }


        // return view('activity_detail', compact('activity'));
    }
}
