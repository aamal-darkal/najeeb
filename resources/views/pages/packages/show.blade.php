@extends('layouts.master')
@section('content')


    <!-- ############ PAGE START-->
    <div class="padding">
                <div class="row">
                    <div class="col-xs-6 col-md-4"><div class="box p-a">
                            <div class="item">
                                <div class="item-overlay active p-a">
                                    <p class="pull-left text-u-c label label-md primary">Package</p>
                                </div>
                                <img src="{{asset($package->image ?: 'images/no-image.jpg')}}" class="img-responsive">
                            </div>
                            <div class="p-a">
                                <div class="pull-right text-muted m-b-xs">
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                </div>
                                <div class="text-center text-md m-b h-2x _800">{{$package->name}}</div>
                                <p class="text-center _800">Starts at : {{$package->start_date}}</p>
                                <p class="text-center _800">Ends at : {{$package->end_date}}</p>
                            </div>
                        </div>

                    </div>
                    {{--                    <div class="col-xs-6 col-sm-12 col-md-6">--}}
                    {{--                        <div class="box">--}}
                    {{--                            <div class="item">--}}
                    {{--                                <div class="item-bg">--}}
                    {{--                                    <img src="{{asset($package->image ?: 'images/no-image.jpg')}}" class="blur">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="p-a-lg pos-rlt text-center">--}}
                    {{--                                    <img src="{{asset($package->image)}}" class="img-circle w-56" style="margin-bottom: -7rem">--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="p-a text-center">--}}
                    {{--                                <a href class="text-md m-t block">{{$package->name}}</a>--}}
                    {{--                                <p><small>Designer, Blogger</small></p>--}}
                    {{--                                <p><a href class="btn btn-sm primary">Follow</a></p>--}}
                    {{--                                <div class="text-xs">--}}
                    {{--                                    <em>Photos: <strong>32</strong>, Videos: <strong>50</strong></em>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="col-xs-12 col-md-8 "><div class="box p-a">
                            <div class="item">
                                <div class="item-bg primary h6" style="height: 3rem">
                                    <p class="p-a text-center">{{$package->name}}’s subjects</p>
                                </div>
                                <div class="p-a pos-rlt">
                                </div>
                            </div>
                            <div class="p-a">
                                <div class="table-responsive">
                                    <table class="table table-striped b-t text-center">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Cost</th>
                                            <th class="text-center">Created at</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($package->subjects as $subject)
                                            <tr>
                                                <td>{{$subject->name}}</td>
                                                <td>{{$subject->cost}}</td>
                                                <td>{{$subject->created_at}}</td>
                                                <td >
                                                    <a href="{{route('delete.subject',$subject->id)}}"
                                                       class="md-btn md-raised m-b-sm w-xs danger text-white">Delete</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>



<script>

            const startTime = document.getElementById('start_time');
            const endTime = document.getElementById('end_time');
            const submitBtn = document.getElementById('submit-btn');
    document.getElementById('myForm').addEventListener('submit', function(event) {
        // Prevent form submission
        event.preventDefault();
                    const startTimeVal = new Date( "2023-01-01 " + startTime.value);
                    const endTimeVal = new Date("2023-01-01 " + endTime.value);

                    var starttimestamp = startTimeVal.getTime();
                    var endtimestamp = endTimeVal.getTime();
        // Check condition
        if (endtimestamp < starttimestamp) {
            // Display error message
            alert('Your error message here');
        } else {
            // Submit form
            this.submit();
        }
    });
</script>
    <!-- ############ PAGE END-->


@endsection
