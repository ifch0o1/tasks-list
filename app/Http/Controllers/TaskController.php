<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;
use App\ListModel;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->get();
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('templates.form', [
            'action' => action('TaskController@store'),
            'name' => 'Add task',
            'fields' => $this->getFormFields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'max:512',
            'type' => 'required|max:30',
            'due' => 'required|max:30',
            'list' => 'required|integer'   
        ]);

        $listId = $request->list;
        $list = $request->user()->lists()->where('id', $listId)->first();

        if (!isset($list)) {
            $resData = ['message' => 'You are trying to create task into list which does not exist or is not belongs to you.'];
            return response(view('errors.404', $resData), 404);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->description = $request->description ? $request->description : null;
        $task->type = $request->type;
        $task->due = $this->tempDueCalculation($request->due);

        $list->tasks()->save($task);

        return response(null, 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $task = $request->user()->tasks()->where('tasks.id', $id)->first();
        if (!isset($task)) {
            return response(view('errors.404'), 404);
        }

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $task = $request->user()->tasks()->where('tasks.id', $id)->first();
        if (!isset($task)) {
            return response(view('errors.404', ['message' => 'Task not found in your tasks list.']), 404);
        }

        return view('templates.form', [
            'action' => action('TaskController@update', ['id' => $id]),
            'name' => 'Edit task',
            'fields' => $this->getFormFields($task)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'description' => 'max:512',
            'type' => 'required|max:30',
            'due' => 'required|max:30',
        ]);

        $task = $request->user()->tasks()->where('tasks.id', $id)->first();
        if (!isset($task)) {
            return response(view('errors.404', ['Message' => 'Task not found in your tasks list.']), 404);
        }

        $task->name = $request->name;
        $task->description = $request->description;
        $task->type = $request->type;
        $task->due = $this->tempDueCalculation($request->due);
        $task->save();

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


    /**
    * Get an array of form field options for a task.
    *
    * @param Task $task - Model to bind values to.
    * @return array
    */
    private function getFormFields(Task $task = null) {
        $lists = auth()->user()->lists()->get();

        $listIds = $lists->map(function($list) {
            return $list->id;
        });

        $fields = [
            ['name' => 'name', 'text' => 'Task Name', 'max' => '100'],
            ['name' => 'description', 'text' => 'Task Description', 'max' => '512'],
            ['type' => 'select', 'name' => 'type', 'text' => 'Type', 'options' => [
                'Normal',
                'Important',
                'Personal',
                'Work',
                'It can wait'
            ]],
            ['type' => 'select', 'name' => 'due', 'text' => 'Due', 'options' => [
                'Not specified',
                'Day',
                'Tomorrow',
                'Week',
                'Month',
                'Year'
            ]],
            ['type' => 'select', 'name' => 'list', 'text' => 'List ID', 'options' => $listIds],
        ];

        if (isset($task)) {
            /**
            * Bind $task values to each form fields.
            * Usually used when showing edit form.
            */

            $fields[0]['value'] = $task->name;
            $fields[1]['value'] = $task->description;
            $fields[2]['selected'] = $task->type;
        }

        return $fields;
    }

    private function tempDueCalculation($string) {
        $due = null;
        if ($string == 'Day') {
            $due = Carbon::now()->addDay();
        } elseif ($string == 'Tomorrow') {
            $due = Carbon::now()->addDays(2);
        } elseif ($string == 'Week') {
            $due = Carbon::now()->addDays(7);
        } elseif ($string == 'Month') {
            $due = Carbon::now()->addDays(30);
        } elseif ($string == 'Year') {
            $due = Carbon::now()->addDays(365);
        }

        return $due;
    }
}
