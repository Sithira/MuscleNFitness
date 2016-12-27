@extends('layouts.MasterLayout')

@section('style')
    <style type="text/css">
        .clickable {
            cursor: pointer;
        }
        .clickable:hover {
            background-color: lightgrey;
        }
    </style>
@endsection

@section('content')

    <div class="col-xs-12">
        <br/>
        @include('partials.message')
        <br />
        @if($member->payments->isEmpty())
            <div class="alert alert-warning text-center">
                <h4>No Payment records found</h4>
            </div>
        @else
            @if ($member->payments->last()->month->addMonths($member->type->days)->gte(\Carbon\Carbon::today()))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p class="text-center">
                        <strong>Success</strong>
                        <br/>
                        Payment verified for the month
                    </p>
                </div>
            @else
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p class="text-center">
                        <strong>Alert</strong>
                        <br/>
                        No Verified Payment found for this month
                    </p>
                </div>
            @endif

            @if( \Carbon\Carbon::today()->month - $member->payments->last()->month->month >= 2)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p class="text-center">
                        <strong>Whoops !</strong><br/>This member is an inActive member
                    </p>
                </div>
            @endif
        @endif

        <h3>
            Member Details
            <br/>
            <small>
                Membership ID : {!! $member->id !!}
            </small>
        </h3>
        <a href="{!! $member->id !!}/edit" class="btn btn-primary btn-sm pull-right">Edit member</a>
    </div>

    <!-- Right Panel -->
    <div class="col-xs-8">
        <h4>Basic information</h4>

        <div class="well">
            <ul>
                <li>Name : {!! $member->name !!}</li>
                <li>Last Name : {!! $member->last_name !!}</li>
                <li>NIC : {!! $member->nic !!}</li>
                <li>Email : {!! $member->email !!}</li>
                <li>Address : {!! $member->address !!}</li>
                <li>Phone : {!! $member->phone !!}</li>
                <li>Member Since : {!! $member->created_at->toDateString() !!}
                    ({!! $member->created_at->diffForHumans() !!})
                </li>
                <li>Active : {!! ($member->active == 1) ? "Active" : "inActive" !!}</li>
            </ul>
        </div>

        <h4>Membership type and Services information</h4>

        <div class="well">
            <?php
            $serviceNames = \App\Service::whereIn('id', $member->servicelist)->get()->pluck('name');
            ?>
            <ul>
                <li>Membership type : {!! $member->type->name !!}</li>
                <li>Services Subscribed to : @foreach($serviceNames as $name){!! $name !!}@if (!$loop->last)
                        ,@endif @endforeach</li>
            </ul>
        </div>

        <h4>Member Measurements</h4>

        <div style="overflow: hidden; margin-bottom: 20px">
            <a class="btn btn-primary btn-sm pull-right" data-toggle="modal" href="#addschedule">Add Schedule</a>
        </div>

        <?php $append = "";?>
        @if($member->measurements->isEmpty())
            <div class="well">
                <p class="text-center">No Measurements</p>
            </div>
        @else
            @foreach($member->measurements->reverse() as $measurement)
                @if($loop->first)
                    <div class="well">
                        <fieldset>
                            <legend>Issued Date: {!! $measurement->created_at->toDateString() !!}
                                ({!! $measurement->created_at->diffForHumans() !!})
                            </legend>

                            <table class="table table-bordered table-responsive">

                                <tr>
                                    <th>M & F</th>
                                    <th>Measurement</th>
                                </tr>

                                <tr>
                                    <td>Weight</td>
                                    <td>{!! $measurement->weight !!}</td>
                                </tr>

                                <tr>
                                    <td>Height</td>
                                    <td>{!! $measurement->height !!}</td>
                                </tr>

                                <tr>
                                    <td>BMI</td>
                                    <td>{!! $measurement->bmi !!}</td>
                                </tr>

                                <tr>
                                    <td>Fat</td>
                                    <td>{!! $measurement->fat !!}%</td>
                                </tr>

                                <tr>
                                    <td>Chest</td>
                                    <td>{!! $measurement->chest !!}</td>
                                </tr>

                                <tr>
                                    <td>Waist</td>
                                    <td>{!! $measurement->waist !!}</td>
                                </tr>

                                <tr>
                                    <td>Hip</td>
                                    <td>{!! $measurement->hip !!}</td>
                                </tr>

                                <tr>
                                    <td>Arm Left</td>
                                    <td>{!! $measurement->arm_left !!}</td>
                                </tr>

                                <tr>
                                    <td>Arm Right</td>
                                    <td>{!! $measurement->arm_right !!}</td>
                                </tr>

                                <tr>
                                    <td>ForeArm Left</td>
                                    <td>{!! $measurement->forearm_left !!}</td>
                                </tr>

                                <tr>
                                    <td>ForeArm Right</td>
                                    <td>{!! $measurement->forearm_right !!}</td>
                                </tr>

                                <tr>
                                    <td>Thigh Left</td>
                                    <td>{!! $measurement->thigh_left !!}</td>
                                </tr>

                                <tr>
                                    <td>Thigh Right</td>
                                    <td>{!! $measurement->thigh_right !!}</td>
                                </tr>

                                <tr>
                                    <td>Calf Left</td>
                                    <td>{!! $measurement->calf_left !!}</td>
                                </tr>

                                <tr>
                                    <td>Calf Right</td>
                                    <td>{!! $measurement->calf_right !!}</td>
                                </tr>

                            </table>
                        </fieldset>

                    </div>
                @else
                    <?php
                    $append .= "<div class='well'>
                        <fieldset>
                            <legend>Issued Date:" . $measurement->created_at->toDateString() . "
                                (" . ($measurement->created_at->diffForHumans()) . ")
                            </legend>

                            <table class='table table-bordered table-responsive'>

                                <tr>
                                    <th>M & F</th>
                                    <th>Measurement</th>
                                </tr>

                                <tr>
                                    <td>Weight</td>
                                    <td>$measurement->weight</td>
                                </tr>

                                <tr>
                                    <td>Height</td>
                                    <td>$measurement->height</td>
                                </tr>

                                <tr>
                                    <td>BMI</td>
                                    <td>$measurement->bmi</td>
                                </tr>

                                <tr>
                                    <td>Fat</td>
                                    <td>$measurement->fat%</td>
                                </tr>

                                <tr>
                                    <td>Chest</td>
                                    <td>$measurement->chest</td>
                                </tr>

                                <tr>
                                    <td>Waist</td>
                                    <td>$measurement->waist</td>
                                </tr>

                                <tr>
                                    <td>Hip</td>
                                    <td>$measurement->hip</td>
                                </tr>

                                <tr>
                                    <td>Arm Left</td>
                                    <td>$measurement->arm_left</td>
                                </tr>

                                <tr>
                                    <td>Arm Right</td>
                                    <td>$measurement->arm_right</td>
                                </tr>

                                <tr>
                                    <td>ForeArm Left</td>
                                    <td>$measurement->forearm_left</td>
                                </tr>

                                <tr>
                                    <td>ForeArm Right</td>
                                    <td>$measurement->forearm_right</td>
                                </tr>

                                <tr>
                                    <td>Thigh Left</td>
                                    <td>$measurement->thigh_left</td>
                                </tr>

                                <tr>
                                    <td>Thigh Right</td>
                                    <td>$measurement->thigh_right</td>
                                </tr>

                                <tr>
                                    <td>Calf Left</td>
                                    <td>$measurement->calf_left</td>
                                </tr>

                                <tr>
                                    <td>Calf Right</td>
                                    <td>$measurement->calf_right</td>
                                </tr>

                            </table>
                        </fieldset>
                    </div>"
                    ?>
                @endif
            @endforeach
        @endif
        <div id="hidden_measurements" class="hidden">{!! $append !!}</div>
        <a href="#" id="measurements_toggle">Show other measurements</a>

        <h4>Member Schedules</h4>
        <div style="overflow: hidden; margin-bottom: 20px">
            <a class="btn btn-primary pull-right" href="{!! url("/members/".$member->id."/schedule/create") !!}/">Add Schedule</a>
        </div>

        <div class="well">
            <ul>
                @if($member->schedules->isEmpty())
                    <li>
                        No Schedules
                    </li>
                @else
                    @foreach($member->schedules->reverse() as $schedule)
                        <li>
                            <a href="{!! url('/members/'.$member->id.'/schedule/'.$schedule->id) !!}">{!! $schedule->issued_date->toDateString() !!}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>

    </div>

    <!-- Left Panel -->
    <div class="col-xs-4">
        <h4>Payment information</h4>

        <table class="table table-responsive table-bordered">
            <tr>
                <th>Amount</th>
                <th>Payed Date</th>
                <th>Next Payday</th>
                <th>Status</th>
            </tr>

            <tr>
                <td colspan="4">
                    <a class="btn btn-primary center-block" data-toggle="modal" href="#addpayment">Add Payment</a>
                </td>
            </tr>

            @if($member->payments->isEmpty())
                <tr>
                    <td colspan="4">No Payments Made yet</td>
                </tr>
            @else
                @foreach($member->payments->reverse() as $payment)
                    <tr class="clickable" data-payment="{!! $payment->id !!}">
                        <td>{!! $payment->amount !!}</td>
                        <td>{!! $payment->month->toDateString() !!}</td>
                        <td>{!! $payment->month->addMonths($member->type->days)->toDateString() !!}</td>
                        <td>{!! ($payment->active == 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>

    <!-- Modal for Adding an payment -->
    <div class="modal fade" id="addpayment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Fees to Member</h4>
                </div>
                <div class="modal-body">
                    <div class="errors"></div>
                    <img class="center-block hidden" id="cube" src="{!! asset('/images/cube.gif') !!}" alt="">
                    <div class="message"></div>
                    {!! Form::open(['method' => 'POST', 'action' => 'PaymentController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('member_id', 'Member ID : ') !!}
                        {!! Form::text('member_id', $member->id, ['class' => 'form-control', 'disabled' => true]) !!}
                    </div>

                    <div class="alert alert-info">
                        Payment Type : <strong>{!! $member->type->name !!}</strong> <br/>
                        <?php $amount = 0;?>
                        @foreach($member->services as $service)
                            <?php
                            $amount += $service->fees;
                            ?>
                        @endforeach
                        Total Recurring Fees : {!! $amount !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('amount', 'Amount : ') !!}
                        {!! Form::text('amount', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    @if(!$member->payments->isEmpty())
                        @if ($member->payments->last()->month->addMonths($member->type->days)->gte(\Carbon\Carbon::today()))
                            {!! Form::submit("Add Payment", ['class' => 'btn btn-primary', 'disabled' => true]) !!}
                            <p class="text-danger">This member has a valid payment already !
                                <small></small>
                            </p>
                        @else
                            {!! Form::submit("Add Payment", ['class' => 'btn btn-primary', 'id' => 'make_payment']) !!}
                        @endif
                    @else
                        {!! Form::submit("Add Payment", ['class' => 'btn btn-primary', 'id' => 'make_payment']) !!}
                    @endif


                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="addmeasurements">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    				<h4 class="modal-title">Add a Schedule</h4>
    			</div>
    			<div class="modal-body">
    				{!! Form::open(['method' => 'POST', 'action' => 'MeasurementController@store']) !!}

                    <div class="form-group">
                        {!! Form::label('weight', 'Weight :') !!}
                        {!! Form::text('weight', null, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::hidden('member_id', $member->id) !!}

                    <div class="form-group">
                        {!! Form::label('height', 'Height :') !!}
                        {!! Form::text('height', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('bmi', 'BMI :') !!}
                        {!! Form::text('bmi', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('fat', 'Fat :') !!}
                        {!! Form::text('fat', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('chest', 'Chest') !!}
                        {!! Form::text('chest', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('waist', 'Waist :') !!}
                        {!! Form::text('waist', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('hip', 'Hip :') !!}
                        {!! Form::text('hip', null, ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('arm_left', 'Arm Left :') !!}
                        {!! Form::text('arm_left', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('arm_right', 'Arm Right :') !!}
                        {!! Form::text('arm_right', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('forearm_left', 'Forearm Left :') !!}
                        {!! Form::text('forearm_left', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('forearm_right', 'Forearm Right :') !!}
                        {!! Form::text('forearm_right', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('thigh_left', 'Thigh Left :') !!}
                        {!! Form::text('thigh_left', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('thigh_right', 'Thigh Right') !!}
                        {!! Form::text('thigh_right', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('calf_right', 'Calf Right :') !!}
                        {!! Form::text('calf_right', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('calf_left', 'Calf Left :') !!}
                        {!! Form::text('calf_left', null, ['class' => 'form-control']) !!}
                    </div>

    			</div>
    			<div class="modal-footer">
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {!! Form::submit('Add Measurement', ['class' => 'btn btn-primary', 'id' => 'addmeasurements']) !!}
                    {!! Form::close() !!}
    			</div>
    		</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection



@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            // Show Measurements
            $("#measurements_toggle").on('click', function (e) {
                e.preventDefault();
                $("#hidden_measurements").toggleClass("hidden");
            });

            // Ajax Payment add
            $("#make_payment").on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/make-payment",
                    data: {
                        member_id: $("#member_id").val(),
                        amount: $("#amount").val(),
                        _token: "{!! Session::token() !!}"
                    },
                    beforeSend: function () {
                        $("#cube").removeClass('hidden');
                    },
                    complete: function () {
                        $("#cube").addClass('hidden');
                    },
                    error: function(data) {
                        var errors = data.responseJSON; //this will get the errors response data.
                        //show them somewhere in the markup
                        //e.g
                        errorsHtml = '<div class="alert alert-danger"><ul>';

                        $.each( errors , function( key, value ) {
                            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                        });
                        errorsHtml += '</ul></di>';

                        $( '.errors' ).html( errorsHtml ); //appending to a <div id="form-errors">

                    },
                    success: function (data) {
                        if (data.active) {
                            $(".message").append("<div class='alert alert-success text-center'><i class='fa fa-check-circle'></i> " + data.message + "</div>")
                        } else {
                            $(".message").append("<div class='alert alert-warning text-center'><i class='fa fa-times-circle'></i> " + data.message + "</div>")
                        }

                        $("#make_payment").attr('disabled', 'disabled');

                        $("#amount").val("");

                        setTimeout(function() {
                            $("#addpayment").modal('hide');
                            location.reload();
                        }, 2000);
                    }
                })
            });

            // Payment Navigation
            $(".clickable").click(function() {

                var boolean = confirm("Are you sure you need to navigate to this payment with ID : " + $(this).data("payment") + " ?");

                if (boolean) {
                    window.document.location = $(this).data("href");
                }
            });

        });
    </script>
@endsection