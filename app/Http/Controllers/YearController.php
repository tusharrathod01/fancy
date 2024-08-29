<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
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
                                $old_data = $year->toArray();
                                $types = 'Year Update';
                                $hasDifferences = (
                                    (isset($year->year) && $year->year != $trans['year']) ||
                                    (isset($year->status) && $year->status != $trans['status']) ||
                                    (isset($year->from_date) && $year->from_date != date('Y-m-d', strtotime($trans['from_date']))) ||
                                    (isset($year->to_date) && $year->to_date != date('Y-m-d', strtotime($trans['to_date'])))
                                );

                                if ($hasDifferences) {
                                    $data['comment'] = '';
                                    $data['types'] = $types;
                                    $data['bill_no'] = !empty($request->bill_no) ? $request->bill_no : '';
                                    $data['inv_no'] = $request->inv_no;
                                    $data['party'] =  $request->party;
                                    $data['old_data'] =  json_encode($old_data);
                                    $data['new_data'] = json_encode($trans);
                                    $data['pur_sale_type'] = 'year';

                                    Activity::add($data);
                                }
                            } else {
                                $year = new Year();
                                $types = 'Year Add';

                                $data['comment'] = '';
                                $data['types'] = $types;
                                $data['bill_no'] = !empty($request->bill_no) ? $request->bill_no : '';
                                $data['inv_no'] = $request->inv_no;
                                $data['party'] =  $request->party;
                                $data['old_data'] =  json_encode('');
                                $data['new_data'] = json_encode($trans);
                                $data['pur_sale_type'] = 'year';

                                Activity::add($data);
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
