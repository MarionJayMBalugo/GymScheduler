<?php

namespace App\Http\Controllers;
use App\Repository\Implementations\GymScheduleEloquent;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    protected $schedule;
    public function __construct(
        GymScheduleEloquent $schedule
    ) {
        $this->middleware('auth');  
        $this->schedule = $schedule;
    }

    public function store(Request $request) {
        $res = $this->schedule->create($request->all())->load('purpose');
        return response()->json($res, 200);
    }

    public function getByUser($user_id) {
        $res = $this->schedule->with('purpose')->where('user_id', '=', $user_id)->get();
        return response()->json($res, 200);
    }
    public function getById( $id) {
        $res = $this->schedule->with('purpose')->find($id);
        return response()->json($res, 200);
    }
    public function update($id, Request $request) {
        $sched =  $this->schedule->findorFail($id);
        $res = $sched->update($request->all());
        $res = $this->schedule->with('purpose')->find($id);
        return response()->json($res, 200);
    }
    public function delete($id) {
        $res =  $this->schedule->findorFail($id)->delete();
        return response()->json($res, 200);
    }
}
