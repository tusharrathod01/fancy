<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Year;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponser;
    public function index()
    {
        $user = auth()->user();
        $data = Year::all();
        return view('year.index', compact('data'));
    }

    public function get_year()
    {
        $user = auth()->user();
        $data = Year::all();
        return $this->successResponse($data, 'get data successfully');
    }

    public function save(Request $request)
    {
        try {
            if ($request->has('entry') && is_array($request->entry)) {
                $user = auth()->user();
                $status = 0;
                $status2 = 0;

                foreach ($request->entry as $trans) {
                    if ($trans['status'] <= 1 && $trans['status'] >= 1 || $trans['status'] <= 0 && $trans['status'] >= 0) {
                        if ($trans['status'] <= 1 && $trans['status'] >= 1) {
                            $status++;
                        }
                    } else {
                        $status++;
                    }
                    if (!empty($trans['year'])) {
                        if ($trans['from_date'] == '' || $trans['to_date'] == '') {
                            $status2++;
                        }
                    }
                    if (!empty($trans['from_date'])) {
                        if ($trans['year'] == '' || $trans['to_date'] == '') {
                            $status2++;
                        }
                    }
                    if (!empty($trans['to_date'])) {
                        if ($trans['year'] == '' || $trans['from_date'] == '') {
                            $status2++;
                        }
                    }
                }
                if ($status == 1 && $status2 == 0) {
                    foreach ($request->entry as $trans) {
                        if (!empty($trans['year'])) {
                            if (isset($trans['id'])) {
                                $year = Year::find($trans['id']);
                            } else {
                                $year = new Year();
                            }
                            $year->year = $trans['year'];
                            $year->status = $trans['status'];
                            $year->from_date = date('Y-m-d', strtotime($trans['from_date']));
                            $year->to_date = date('Y-m-d', strtotime($trans['to_date']));
                            $year->create_user_id = $user->id;
                            $year->master_country_id = $user->master_country_id;
                            $year->branch_id = $user->branch_id;
                            $year->current_date = date('Y-m-d');
                            $year->current_time = date('H:i:s');
                            $year->save();
                        }
                    }
                    return $this->successResponse([], 'year Save successfully');
                } else {
                    if ($status != 1) {
                        return $this->errorResponse('Please Check Status', 200);
                    } else {
                        return $this->errorResponse('Please Check Entry', 200);
                    }
                }
            }
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 200);
        }
    }

}
