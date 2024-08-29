<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activitys';

    static function add($data)
    {
        $activity = new Activity();
        $activity->bill_no = $data['bill_no'];
        $activity->inv_no = $data['inv_no'];
        $activity->party =  $data['party'];
        $activity->pur_sale_type = $data['pur_sale_type'];
        $activity->comment = $data['comment'];
        $activity->types = $data['types'];
        $activity->old_data = $data['old_data'];
        $activity->new_data = $data['new_data'];
        $activity->branch_id = auth()->user()->branch_id;
        $activity->master_country_id = auth()->user()->master_country_id;
        $activity->user_id = auth()->user()->id;
        $activity->save();
    }
}
