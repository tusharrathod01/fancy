<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\CurrencyMaster;
use App\Models\Master;
use App\Models\PartyMaster;
use App\Models\State;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;

class PartyMasterController extends Controller
{
    //
    use ApiResponser;
    public function save_party(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->messages()->first(), 200);
        } else {

            $user = auth()->user();
            if ($request->has('hiddenId') && !empty($request->input('hiddenId'))) {
                $party = PartyMaster::find($request->hiddenId);
                // PurSaleEntry::where('party', $party->name)->update(['party' => $request->name]);
                // PaymentOpening::where('party', $party->name)->update(['party' => $request->name]);
                // Payment::where('party', $party->name)->update(['party' => $request->name]);
                // Payment::where('account', $party->name)->update(['account' => $request->name]);
                // PaymentTrans::where('party', $party->name)->update(['party' => $request->name]);
                // PaymentTrans::where('account', $party->name)->update(['account' => $request->name]);
            } else {
                $party = new PartyMaster();
            }
            // dd($party);
            $party->name = $request->name;
            $party->currency = $request->currency;
            $party->rate = $request->rate;
            $party->party_code = $request->party_code;
            $party->contact_person = $request->contact_person;
            $party->account_type = $request->account_type;
            $party->broker = $request->broker;
            $party->mobile = $request->mobile;
            $party->fax = $request->fax;
            $party->address = $request->address;
            $party->city = $request->city;
            $party->state = $request->state;
            $party->country = $request->country;
            $party->zipcode = $request->zipcode;
            $party->bank_account = $request->bank_account;
            $party->swift_code = $request->swift_code;
            $party->bank_routing = $request->bank_routing;
            $party->limit = $request->limit;
            $party->opening_bal = $request->opening_bal;
            $party->debit_credit = $request->debit_credit;
            $party->pdate = $request->pdate;
            $party->area = $request->area;
            $party->agent = $request->agent;
            $party->due_days = $request->due_days;
            $party->overdue = $request->overdue;
            $party->phone1 = $request->phone1;
            $party->phone2 = $request->phone2;
            $party->skype = $request->skype;
            $party->email = $request->email;
            $party->website = $request->website;
            $party->ref_party_1 = $request->ref_party_1;
            $party->ref_party_2 = $request->ref_party_2;
            $party->ref_phone_1 = $request->ref_phone_1;
            $party->ref_phone_2 = $request->ref_phone_2;
            $party->ref_comment_1 = $request->ref_comment_1;
            $party->ref_comment_2 = $request->ref_comment_2;
            $party->executive = $request->executive;
            $party->remark = $request->remark;
            $party->user_id = $user->id;
            $party->master_country_id = $user->master_country_id;
            $party->branch_id = $user->branch_id;
            $party->current_time = date('H:i:s');
            $party->save();
            return $this->successResponse([], 'Party save successfully');
        }
    }

    public function get(Request $request)
    {
        $user = auth()->user();
        $get = PartyMaster::where('branch_id', $user->branch_id)->where('name', 'like', $request->q . '%')->pluck('name');
        return $get;
    }

    public function get_details(Request $request)
    {
        $name = $request->name;
        $user = auth()->user();
        $details = PartyMaster::where('name', $name)->where('branch_id', $user->branch_id)->first();
        if ($details) {
            return $this->successResponse($details, 'Party get successfully');
        } else {
            return $this->successResponse([], 'not fount');
        }
    }

    public function party_add(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->messages()->first(), 200);
        } else {
            $user = auth()->user();
            if ($request->has('hiddenId') && !empty($request->input('hiddenId'))) {
                $party = PartyMaster::find($request->hiddenId);
            } else {
                $party = new PartyMaster();
            }
            $party->name = $request->name;
            $party->branch_id = $user->branch_id;
            $party->account_type = "party";
            $party->current_date = date('Y-m-d');
            $party->current_time = date('H:i:s');
            $party->save();
            return $this->successResponse($party, 'Party save successfully');
        }
    }
    public function  get_party()
    {
        $user = auth()->user();
        $party = PartyMaster::select("id", "name")->where('branch_id', $user->branch_id)->get();
        return $this->successResponse($party, 'Expense get successfully');
    }

    public function getCurrancy()
    {
        $year_id = get_year();
        $user = auth()->user();
        $currancy = CurrencyMaster::where('branch_id', $user->branch_id)->where('year_id', $year_id)->orderBy('priority')->pluck('rate', 'name');
        return $this->successResponse($currancy, 'get data');
    }

    public function getStates($countryId)
    {
        $states = State::where('country_id', $countryId)->get();
        return response()->json($states);
    }

    public function getCities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        return response()->json($cities);
    }
}
