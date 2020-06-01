<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $table = "timesheets";
    protected $primaryKey = "time_sheet_id";
}
