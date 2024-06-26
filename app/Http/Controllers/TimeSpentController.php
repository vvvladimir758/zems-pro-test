<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TimeSpentRequest;
use App\Models\TimeSpent;
use Carbon\Carbon;

class TimeSpentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeSpentRequest $request)
    {
        if($request->type == 'mark' && $request->stop == NULL){
            $request->start = Carbon::now();
        }
        
        $data = [
            'description' => $request->get('description'),
            'time_spent'  => $request->time_spent,
            'type'        => $request->get('type'),
            'start'       => $request->start,
            'stop'        => $request->get('stop'),
            'user_id'     => Auth::id(),
            'task_id'     => $request->get('task_id'),
        ];
        
        $ts = TimeSpent::create($data);
        $data['id'] = $ts->id;
        
        return response()->json($data);
    }
     
    public function stop(string $id){
        $timeSpent = TimeSpent::whereId($id)->first();
        $timeSpent->stop = Carbon::now();
        $timeSpent->time_spent = Carbon::parse($timeSpent->start)->diff(Carbon::now())->format('%h:%i:%s');
        $timeSpent->save();
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeSpentRequest $request, string $id)
    {
        $data = [
            'time_spent'       => $request->get('time_spent'),
            'description' => $request->get('description'),
        ];
        
        $ts = TimeSpent::whereId($id);
        $ts->update($data);
        
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TimeSpent::whereId($id)->delete();
    }
}
