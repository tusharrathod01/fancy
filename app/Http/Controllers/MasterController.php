<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Master;
use App\Models\PartyMaster;
use App\Traits\ApiResponser;

class MasterController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function color()
    {
        $colors = Master::where('type', 'color_master')->get();
        return view('master.color', compact('colors'));
    }

    public function shape()
    {
        return view('master.shape');
    }

    public function size()
    {
        return view('master.size');
    }

    public function calarity()
    {
        return view('master.calarity');
    }

    public function type()
    {
        return view('master.type');
    }

    public function agtype()
    {
        return view('master.agtype');
    }

    public function currancy()
    {
        $colors = Master::where('type', 'currancy_master')->get();
        return view('master.currancy', compact('colors'));
    }

    public function party()
    {
        $countries = Country::all();
        return view('master.party', compact('countries'));
    }

    public function save_masters(Request $request)
    {
        try {
            if ($request->has('masters')) {
                \DB::beginTransaction();
                foreach ($request->masters as $d) {
                    if (!empty($d['name'])) {

                        if (isset($d['id'])) {
                            $masters = Master::where('type', $d['type'])->where('id', $d['id'])->first();
                            $old_data = $masters->toArray();
                            $types = 'Master Update';
                            $hasDifferences = (
                                (isset($masters->name) && $masters->name != $d['name']) ||
                                (isset($masters->color) && $masters->color != $d['color']) ||
                                (isset($masters->intensity) && $masters->intensity != $d['intensity']) ||
                                (isset($masters->overtone) && $masters->overtone != $d['overtone']) ||
                                (isset($masters->p_from) && $masters->p_from != $d['p_from']) ||
                                (isset($masters->p_to) && $masters->p_to != $d['p_to']) ||
                                (isset($masters->st_name) && $masters->st_name != $d['st_name'])
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
                            $masters = new Master();
                            $types = 'Master Add';

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
                        $masters->type = $d['type'];

                        $masters->priority = $d['priority'];

                        if (array_key_exists('color', $d)) {
                            $masters->color = $d['color'];
                        }
                        if (array_key_exists('intensity', $d)) {
                            $masters->intensity = $d['intensity'];
                        }
                        if (array_key_exists('overtone', $d)) {
                            $masters->overtone = $d['overtone'];
                        }
                        if (array_key_exists('p_from', $d)) {
                            $masters->p_from = $d['p_from'];
                        }
                        if (array_key_exists('p_to', $d)) {
                            $masters->p_to = $d['p_to'];
                        }
                        if (array_key_exists('st_name', $d)) {
                            $masters->st_name = $d['st_name'];
                        }
                        if (array_key_exists('date', $d)) {
                            $masters->date = $d['date'];
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

    public function get_masters($type)
    {
        $masters = Master::where('type', $type)->orderBy('priority')->get();
        return $this->successResponse($masters, 'imports successfully');
    }

    public function Party_report(Request $request)
    {
        $data = PartyMaster::select(
            'party_masters.*',
            'cities.name as city_name',
            'states.name as state_name',
            'countries.name as country_name'
        )
            ->leftJoin('cities', 'party_masters.city', '=', 'cities.id')
            ->leftJoin('states', 'party_masters.state', '=', 'states.id')
            ->leftJoin('countries', 'party_masters.country', '=', 'countries.id');

        if ($request->has('party') && !empty($request->party)) {
            $data = $data->where('party_masters.name', $request->party);
        }
        if ($request->has('account_type') && !empty($request->account_type)) {
            $data = $data->where('party_masters.account_type', $request->account_type);
        }

        $data = $data->orderBy('party_masters.name')->get();
        return $data;
    }
    public function Party_delete(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $party = PartyMaster::find($request->id);
                if (!empty($party)) {
                    // $purchase = PurSaleEntry::where('party', $party->name)->first();
                    // $payment = Payment::where('party', $party->name)->orwhere('account', $party->name)->first();
                    // if (empty($purchase) && empty($payment)) {
                    if (file_exists(public_path('/img/party') . '/' . $party->attachment)) {
                        unlink(public_path('/img/party') . '/' . $party->attachment);
                    }

                    $types = 'Party Delete';
                    $pdata = $party->toArray();
                    unset($pdata['attachment']);
                    $pdata['attachment_name'] = $party->attachment;

                    $data['comment'] = '';
                    $data['types'] = $types;
                    $data['bill_no'] = !empty($request->bill_no) ? $request->bill_no : '';
                    $data['inv_no'] = $request->inv_no;
                    $data['party'] =  $party->name;
                    $data['old_data'] =  json_encode($pdata);
                    $data['new_data'] = json_encode('');
                    $data['pur_sale_type'] = 'party';

                    Activity::add($data);

                    $party->delete();
                    return $this->successResponse([], 'Delete successfully');
                    // } else {
                    //     return $this->errorResponse('Please Delete First Entry.', 200);
                    // }
                } else {
                    return $this->errorResponse('Party Not Found', 200);
                }
            } else {
                return $this->errorResponse('Party Not Found', 200);
            }
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 200);
        }
    }
}
