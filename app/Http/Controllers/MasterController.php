<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Master;
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
                        } else {
                            $masters = new Master();
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
}
