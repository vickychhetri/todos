<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     * listing of all the tasks
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return Todo::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     *  Store a newly created resource in storage.
     *  task_name, userid
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $todo = Todo::where('task_name','=', $request->task_name)->get();

        if(count($todo)>0){
            // prevent to add duplicate data
            return response('duplicate Todo');
        }

        $task = Todo::create([
            'task_name' => $request->task_name,
            'user_id' => $request->userid
        ]);

        return $task->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Todo::find($id);
         
    }

    /** 
     * Update the specified resource in storage.
     * task_name,complete,userid
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $todo = Todo::findOrFail($request->id);
        $todo->task_name =$request->task_name;
        $todo->complete =$request->complete;
        $todo->user_id =$request->userid;
        $todo->save();
        return response($todo->toArray(),200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response("deleted");
    }

    // mark complete task
    public function complete(Request $request){
        $todo = Todo::findOrFail($request->id);
        $todo->complete = true;
        $todo->save();
        return response('Task has been completed.',200);

    }

    //Api to search task by requesting keyword and show data with pagination.
    public function search_filter(Request $request){
        $todo = Todo::where('task_name', 'like', "%{$request->search}%")->paginate(10);
        if(count($todo)==0){
            return response('No Records',200);
        }
         return $todo->toArray();
        }

}
