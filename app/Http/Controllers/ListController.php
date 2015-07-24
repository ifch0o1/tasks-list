<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ListModel;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $lists = $request->user()->lists()->get();
        return response(view('lists', ['lists' => $lists]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('templates.form', [
            'action' => action('ListController@store'),
            'name' => 'Create List',
            'fields' => [
                ['name' => 'name', 'text' => 'List name', 'max' => '100'],
                ['name' => 'description', 'text' => 'List description', 'max' => '512']
            ]
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
            'description' => 'max:512'
        ]);

        $list = new ListModel;
        $list->user_id = $request->user()->id;
        $list->name = $request->name;
        $list->description = $request->description ? $request->description : null;
        $list->save();
        
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
        $list = $request->user()->lists()->where('id', $id)->get();
        if ($list->isEmpty()) {
            return response(view('errors.404'), 404);
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $list = $request->user()->lists()->where('id', $id)->get();
        if ($list->isEmpty()) {
            return response(view('errors.404'), 404);
        }

        return view('templates.form', [
            'action' => action('ListController@update', ['id', $id]),
            'name' => 'Edit list',
            'fields' => [
                ['name' => 'name', 'text' => 'Name', 'max' => '100', 'placeholder' => 'Fill to edit'],
                ['name' => 'description', 'text' => 'Description', 'max' => '512', 'placeholder' => 'Fill to edit'] 
            ]
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
            'name' => 'max:100',
            'description' => 'max:512'
        ]);

        $list = $request->user()->lists()->where('id', $id)->get();
        if ($list->isEmpty()) {
            return response(view('errors.404'), 404);
        }

        if (isset($request->name)) {
            $list->name = $request->name;
        }
        if (isset($request->description)) {
            $list->description = $request->description;
        }

        $list->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        echo $id;
    }
}
