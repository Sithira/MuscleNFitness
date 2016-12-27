{!! Form::label('types', 'Type :') !!}
{!! Form::select('types', $type, null, ['class' => 'form-control']) !!}

<br />

{!! Form::label('servicelist', 'Service Type :') !!}
{!! Form::select('servicelist[]', $service, null, ['class' => 'form-control', 'multiple' => true]) !!}

<br/>

{!! Form::label('name', 'Name :') !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}

<br />

{!! Form::label('last_name', 'Last Name :') !!}
{!! Form::text('last_name', null, ['class' => 'form-control']) !!}

<br/>

{!! Form::label('nic', 'NIC :') !!}
{!! Form::text('nic', null, ['class' => 'form-control']) !!}

<br/>

{!! Form::label('email', 'Email :') !!}
{!! Form::email('email', null, ['class' => 'form-control']) !!}

<br/>

{!! Form::label('address', 'Address :') !!}
{!! Form::text('address', null, ['class' => 'form-control']) !!}

<br/>

{!! Form::label('phone', 'Phone :') !!}
{!! Form::text('phone', null, ['class' => 'form-control']) !!}

<br/>
<br/>

{!! Form::submit("$btn", ['class' => 'btn btn-primary']) !!}