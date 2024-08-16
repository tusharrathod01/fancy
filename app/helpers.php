<?php

use App\Models\Master;
use App\Models\Year;

function get_year()
{
    $year = Year::where('status', 1)->first();
    return $year->id;
}

function ag_type()
{
    return Master::where('type', 'agtype_master')->pluck('name');
}
