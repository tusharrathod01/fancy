<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function Party_report()
    {
        $masters = Master::where('type', 'agtype_master')->orderBy('priority')->get();

        return view('report.party_report', compact('masters'));
    }
}
