<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        $activities = Activity::where('causer_id', $user->id)
            ->where('causer_type', get_class($user))
            ->orderBy('created_at', 'DESC')
            ->get();

        if (!blank($activities)) {
            foreach ($activities as $k => $v) {
                $v->date = formatToDate($v->created_at);
                $v->time = formatToTime($v->created_at);
                $v->ip = json_decode($v->properties)->ip ?? null;
            }
        }

        return view('admin::activity', compact('activities'));
    }

    public function show($id)
    {
        return view('admin::show');
    }
}
