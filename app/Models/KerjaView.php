<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerjaView extends Model
{
    protected $connection = 'mysql_support'; // Connect to second DB
    protected $table = 'view_pccp_kerja';    // Target the view
    public $incrementing = false;            // Views often have no auto-increment
    public $timestamps = false;              // Views usually lack timestamp columns
}
