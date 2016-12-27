<?php

namespace App\Http\Controllers;

use App\Measurements;
use Flash;
use Illuminate\Http\Request;

class MeasurementController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'weight' => 'required',
            'height' => 'required',
            'bmi' => 'required',
            'fat' => 'required',
            'chest' => 'required',
            'waist' => 'required',
            'hip' => 'required',
            'arm_right' => 'required',
            'arm_left' => 'required',
            'forearm_left' => 'required',
            'forearm_right' => 'required',
            'thigh_left' => 'required',
            'thigh_right' => 'required',
            'calf_left' => 'required',
            'calf_right' => 'required',
        ]);

        Measurements::create([
            'member_id' => $request->member_id,
            'weight' => $request->weight,
            'height' => $request->height,
            'bmi' => $request->bmi,
            'fat' => $request->fat,
            'chest' => $request->chest,
            'waist' => $request->waist,
            'hip' => $request->hip,
            'arm_right' => $request->arm_right,
            'arm_left' => $request->arm_left,
            'forearm_left' => $request->forearm_left,
            'forearm_right' => $request->forearm_right,
            'thigh_left' => $request->thigh_left,
            'thigh_right' => $request->thigh_right,
            'calf_left' => $request->calf_left,
            'calf_right' => $request->calf_right,
        ]);

        Flash::success("Measurements added successfully !");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
