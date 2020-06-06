<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller\API;
use Illuminate\Http\Request;
use App\Lead;
class ReportController extends Controller
{
    public function open()
    {
        $leads = Lead::where('status', 'Open')->get();
    
        return response()->json($leads, 200);
    }
    
    public function close()
    {
        $leads = Lead::where('status', 'Converted')->get();
    
        return response()->json($leads, 200);
    }
}
