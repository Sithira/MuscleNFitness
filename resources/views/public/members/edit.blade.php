@extends('layouts.MasterLayout')

@section('content')
    <div class="col-xs-12">

        @include('partials.message')

        {!! Form::model($member, ['method' => 'PATCH', 'action' => ['MemberController@update', $member->id]]) !!}
            @include('public.members.partials._formPartial', ['btn' => 'Edit Member'])
        {!! Form::close() !!}

        <br />
        <br />
        
        {!! Form::open(['method' => 'DELETE', 'action' => ['MemberController@destroy', $member->id]]) !!}
            {!! Form::submit("Permanently remove the user", ['onclick' => 'return confirm("Are you sure to remove the user ?")']) !!}
        {!! Form::close() !!}
        
    </div>
@endsection