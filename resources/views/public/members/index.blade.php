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

        <h3>
            Active Members <br/>
            <small>
                for {!! \Carbon\Carbon::today()->toDateString() !!}
            </small>
        </h3>


        <table id="table" class="table table-responsive table-bordered"
               data-paging="true"
               data-filtering="true"
               data-sorting="true"
               data-paging-size="50"
               data-paging-position="right"
        >
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Services</th>
                <th>Last Payed</th>
                <th>Next Payday</th>
                <th>Last Schedule</th>
                <th>Status</th>
            </tr>

            @foreach($members as $member)
                <?php
                $serviceNames = \App\Service::whereIn('id', $member->servicelist)->get()->pluck('name');
                ?>
                <tr class="clickable" data-href="{!! url('/members/'.$member->id) !!}" data-member="{!! $member->id !!}">
                    <td>{!! $member->id !!}</td>
                    <td>{!! $member->name !!}</td>
                    <td>{!! $member->phone !!}</td>
                    <td>{!! $member->type->name !!}</td>
                    <td>
                        @foreach($serviceNames as $name)
                            {!! $name !!}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        @if($member->active == 1)
                            Active
                        @else
                            inActive
                        @endif
                    </td>

                </tr>
            @endforeach
        </table>

    </div>

@endsection


@section('javascript')
    <script type="text/javascript">
        jQuery(function ($) {
            $('.table').footable({
                "paging": {
                    "enabled": true,
                    "size": 50,
                    "position": "right"
                }
            });
        });

        $(".clickable").click(function() {

            var boolean = confirm("Are you sure you need to navigate to this user with ID : " + $(this).data("member") + " ?");

            if (boolean) {
                window.document.location = $(this).data("href");
            }
        });
    </script>
@endsection