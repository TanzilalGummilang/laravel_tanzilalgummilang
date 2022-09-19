<?php

namespace App\Http\Controllers;

use App\DataTables\HospitalDataTable;
use App\Http\Requests\HospitalRequest;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HospitalDataTable $dataTable)
    {
        return $dataTable->render('hospital.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hospital.action', ['hospital' => new Hospital()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HospitalRequest $request)
    {
        Hospital::create($request->all());
        return response()->json([
            'status' => '200',
            'message' => 'create data hospital succesfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        return view('hospital.action', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(HospitalRequest $request, Hospital $hospital)
    {
        $hospital->name = $request->name;
        $hospital->address = $request->address;
        $hospital->email = $request->email;
        $hospital->phone = $request->phone;
        $hospital->save();

        return response()->json([
            'status' => '200',
            'message' => 'update hospital succesfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return response()->json([
            'status' => '200',
            'message' => 'Hapus data rumah sakit berhasil'
        ]);
    }
}
