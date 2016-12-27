@extends('layouts.MasterLayout')

@section('content')
    <div class="col-xs-12">
        <br />

        @include('partials.message')

        <br />

        {!! Form::open(['method' => 'POST', 'action' => 'MemberController@store']) !!}
        @include('public.members.partials._formPartial', ['btn' => 'Add Member to System'])
        {!! Form::close() !!}
    </div>
@endsection