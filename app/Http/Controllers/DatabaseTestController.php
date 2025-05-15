<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DatabaseTestController extends Controller
{
    public function testSecondDb()
    {
        try {
            $database = DB::connection('mysql_support')->select('SELECT DATABASE() AS db');
            return response()->json(['status' => 'Connected', 'database' => $database[0]->db]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Connection Failed', 'errors' => $e->getMessage()]);
        }
    }
}
