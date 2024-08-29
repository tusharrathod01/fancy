<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\CurrencyMaster;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class CurrencyController extends Controller
{
    use ApiResponser;
    public function save_currency(Request $request)
    {
        try {
            if ($request->has('masters')) {
                \DB::beginTransaction();
                $year_id = get_year();
                $user = auth()->user();

                foreach ($request->masters as $d) {
                    if (!empty($d['name'])) {

                        if (isset($d['id'])) {
                            $masters = CurrencyMaster::where('type', $d['type'])->where('id', $d['id'])->first();
                            $old_data = $masters->toArray();
                            $types = 'Currency Master Update';
                            $hasDifferences = (
                                (isset($masters->name) && $masters->name != $d['name']) ||
                                (isset($masters->rate) && $masters->rate != $d['rate'])
                            );

                            if ($hasDifferences) {
                                $data['comment'] = $d['type'] . ' Update';
                                $data['types'] = $types;
                                $data['bill_no'] = !empty($request->bill_no) ? $request->bill_no : '';
                                $data['inv_no'] = $request->inv_no;
                                $data['party'] =  $request->party;
                                $data['old_data'] =  json_encode($old_data);
                                $data['new_data'] = json_encode($d);
                                $data['pur_sale_type'] = 'master';

                                Activity::add($data);
                            }
                        } else {
                            $masters = new CurrencyMaster();
                            $types = 'Currency Master Add';

                            $data['comment'] = $d['type'] . ' Add';
                            $data['types'] = $types;
                            $data['bill_no'] = !empty($request->bill_no) ? $request->bill_no : '';
                            $data['inv_no'] = $request->inv_no;
                            $data['party'] =  $request->party;
                            $data['old_data'] =  json_encode('');
                            $data['new_data'] = json_encode($d);
                            $data['pur_sale_type'] = 'master';

                            Activity::add($data);
                        }

                        $masters->name = $d['name'];
                        $masters->priority = $d['priority'];
                        $masters->type = $d['type'];
                        $masters->branch_id = $user->branch_id;
                        $masters->year_id = $year_id;
                        if (array_key_exists('rate', $d)) {
                            $masters->rate = $d['rate'];
                        }
                        if (array_key_exists('c_id', $d)) {
                            $masters->c_id = $d['c_id'];
                        }
                        if (array_key_exists('m_c_id', $d)) {
                            $masters->m_c_id = $d['m_c_id'];
                        }
                        $masters->save();
                    }
                }
                \DB::commit();
                return $this->successResponse([], 'Master save successfully');
            } else {
                return $this->errorResponse('Data not found', 200);
            }
        } catch (\Throwable $e) {
            \DB::rollback();
            return $this->errorResponse($e->getMessage(), 200);
        }
    }
    public function get_currency($type)
    {
        $year_id = get_year();
        $user = auth()->user();
        $masters = CurrencyMaster::where('branch_id', $user->branch_id)->where('year_id', $year_id)->orderBy('priority')->get();

        return $this->successResponse($masters, 'imports successfully');
    }
}
