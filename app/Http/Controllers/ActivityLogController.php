<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::latest()->paginate(10);

        return view('activity_logs.index', compact('activityLogs'));
    }
}
