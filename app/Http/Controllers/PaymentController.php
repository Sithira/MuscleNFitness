<?php

namespace App\Http\Controllers;

use App\Member;
use App\Payment;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
        $this->validate($request, [
            'member_id' => 'required',
            'amount' => 'required|min:3'
        ]);

        $member = Member::findOrFail($request->member_id);

        $lastPayment = Payment::where('member_id', $member->id)->get()->last();

        if ($lastPayment->month->addMonths($member->type->days)->gte(Carbon::today())) {

            return response()->json(['message' => 'The member is already paid']);
        } else {

            $serviceAmounts = 0;

            foreach ($member->services as $service) {
                $serviceAmounts += $service->fees;
            }

            if ($request->amount == $serviceAmounts) {

                $activePaymentBool = true;
            } else {

                $activePaymentBool = false;
            }

            DB::table('payments')->where('member_id', $member->id)->update(['active' => 0]);

            Payment::create([
                'member_id' => $member->id,
                'amount' => $request->amount,
                'active' => $activePaymentBool,
                'month' => Carbon::today()
            ]);

            return response()->json(['message' => 'Payment Accepted', 'active' => $activePaymentBool]);
        }

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
