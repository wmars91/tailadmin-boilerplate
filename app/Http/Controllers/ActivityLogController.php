<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load logs with causer (User) relationship, order by latest
        $activities = Activity::with('causer')->latest()->paginate(15);

        return view('activity-log.index', compact('activities'));
    }
}
