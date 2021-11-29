<?php

namespace App\Http\Controllers;

use App\Models\CustomColumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomColumnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = [
            'success' => false,
            'exception' => false,
            'exceptionMessage' => '',
            'message' => '',
            'errors' => '',
        ];

        $rules = [
            'columnName' => 'required|min:3|unique:' . CustomColumn::class .',name',
            'columnType' => 'required|exists:column_types,id',
        ];

        $messages = [
            '*.required'=>'The :attribute field is required',
            'columnName.unique' => 'The :attribute already exists in the database',
            'columnName.min' => 'The :attribute must be at least 3 characters',
            'columnType.exists' => "The :attribute you submitted doesn't seem to be a legitimate column type"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if (!$validator->fails()) {
            try{
                $customColumn = CustomColumn::create([
                    'name' => $request->get('columnName'),
                    'column_type_id' => $request->get('columnType'),
                ]);
                $response['success'] = true;
                $response['message'] = 'Column successfully created!';

            }
            catch(\Exception $e){
                $response['message'] = 'There was an error when processing your request. Try again later.';
                $response['exception'] = true;
                $response['exceptionMessage'] = [$e->getMessage()];
            }
        }else{
            $response['message'] = 'There was something wrong with the data you entered.';
            $response['errors'] = $validator->messages();
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomColumn  $customColumn
     * @return \Illuminate\Http\Response
     */
    public function show(CustomColumn $customColumn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomColumn  $customColumn
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomColumn $customColumn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomColumn  $customColumn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomColumn $customColumn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomColumn  $customColumn
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomColumn $customColumn)
    {
        //
    }
}
