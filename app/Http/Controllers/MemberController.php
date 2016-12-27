<?php

namespace App\Http\Controllers;

use App\Member;
use App\Service;
use App\Type;
use Flash;
use Illuminate\Http\Request;
use Redirect;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::isActive()->get();

        return view('public.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = Type::pluck('name', 'id');

        $service = Service::pluck('name', 'id');

        return view('public.members.create', compact('type', 'service'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        // validate the request
        $this->validate($request, [
            'types' => 'required',
            'servicelist' => 'required',
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'nic' => 'required|regex:^[0-9]{9}[vVxX]$^',
            'email' => 'required|email',
            'address' => 'required|min:5',
            'phone' => 'required|min:10|max:10'
        ]);

        // create the member
        $member = Member::create([
            'type_id' => $request->types,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'nic' => $request->nic,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'active' => 1,
        ]);

        // attach the services to the user
        $member->services()->attach($request->servicelist);

        // display the success message
        Flash::success("Member has been added to system");

        // return the result to the user
        return Redirect::to('/members/'.$member->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);

        return view('public.members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);

        $type = Type::pluck('name', 'id');

        $service = Service::pluck('name', 'id');

        return view('public.members.edit', compact('member', 'type', 'service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // validate the request
        $this->validate($request, [
            'types' => 'required',
            'servicelist' => 'required',
            'name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'nic' => 'required|regex:^[0-9]{9}[vVxX]$^',
            'email' => 'required|email',
            'address' => 'required|min:5',
            'phone' => 'required|min:10|max:10'
        ]);

        // get the member from the database
        $member = Member::findOrFail($id);

        // set up the attributes
        $member->type_id = $request->types;
        $member->name = $request->name;
        $member->last_name = $request->last_name;
        $member->nic = $request->nic;
        $member->address = $request->address;
        $member->phone = $request->phone;

        // update the services
        $member->services()->sync($request->servicelist);

        // make member an inactive member
        ($request->has('active')) ? $member->active = 1 : $member->active = 0;

        // update status
        ($member->save()) ? Flash::success("Member details updated") : Flash::error("Member could not be updated");

        // return the response
        return Redirect::back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $member = Member::findOrFail($id);

        ($member->delete()) ? $status = 1 : $status = 0;

        return Redirect::to('/members');

    }
}
