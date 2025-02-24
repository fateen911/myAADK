<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarisView extends Model
{
    protected $connection = 'mysql_support'; // Connect to second DB
    protected $table = 'view_pccp_waris';    // Target the view
    public $incrementing = false;            // Views often have no auto-increment
    public $timestamps = false;              // Views usually lack timestamp columns
}
