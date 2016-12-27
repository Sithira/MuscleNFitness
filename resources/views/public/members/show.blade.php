@extends('layouts.MasterLayout')

@section('content')

    <div class="col-xs-12">
        <br/>
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
                    $append = "";
                    $append .= "<div class='well'>
                        <fieldset>
                            <legend>Issued Date:" . $measurement->created_at->toDateString() ."
                                (".($measurement->created_at->diffForHumans()).")
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
        <div id="hidden_measurements" class="hidden">{!! $append !!}</div>
        <a href="#" id="measurements_toggle">Show other measurements</a>

        <h4>Member Schedules</h4>

        <div class="well">
            <ul>
                @foreach($member->schedules->reverse() as $schedule)
                    <li><a href="{!! url('/members/'.$member->id.'/schedule/'.$schedule->id) !!}">{!! $schedule->issued_date->toDateString() !!}</a></li>
                @endforeach
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
                    <a href="#" class="btn btn-primary center-block">Add Payment</a>
                </td>
            </tr>

            @foreach($member->payments->reverse() as $payment)
                <tr>
                    <td>{!! $payment->amount !!}</td>
                    <td>{!! $payment->month->toDateString() !!}</td>
                    <td>{!! $payment->month->addMonths($member->type->days)->toDateString() !!}</td>
                    <td>{!! ($payment->active == 1) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' !!}</td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection



@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {
        $("#measurements_toggle").on('click', function (e) {
            e.preventDefault();
            $("#hidden_measurements").toggleClass("hidden");
        })
    });
</script>
@endsection