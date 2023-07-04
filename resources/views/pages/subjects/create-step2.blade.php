@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2 block border">
            <div class="wrapper-progressBar">
                <ul class="progressBar">
                    <li class="active">Choose package</li>
                    <li class="active">Create subject</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="row">
            <div class="col-sm-6 col-md-7">
                <div class="row">
                    <div class="col-xs-6 col-sm-12 col-md-6 col-0">
                        <div class="box">
                            <div class="item">
                                <div class="item-overlay active p-a">
                                    <p class="pull-left text-u-c label label-md primary">Package</p>
                                </div>
                                <img src="{{ asset($package->image ?: 'images/no-image.jpg') }}" class="img-responsive">
                            </div>
                            <div class="p-a">
                                <div class="pull-right text-muted m-b-xs">
                                    <a href="#"><i class="fa fa-edit"></i></a>
                                </div>
                                <div class="text-center text-md m-b h-2x _800">{{ $package->name }}</div>
                                <p class="text-center _800">Starts at : {{ $package->start_date }}</p>
                                <p class="text-center _800">Ends at : {{ $package->end_date }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-12 col-md-6 col-0">
                        <div class="box">
                            <div class="item">
                                <div class="item-bg primary h6" style="height: 3rem">
                                    <p class="p-a text-center">{{ $package->name }}’s subjects</p>
                                </div>
                                <div class="p-a pos-rlt">
                                </div>
                            </div>
                            <div class="p-a">
                                <div class="table-responsive">
                                    <table class="table table-striped b-t">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Cost</th>
                                                <th>Created at</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($package->subjects as $subject)
                                                <tr>
                                                    <td>{{ $subject->name }}</td>
                                                    <td>{{ $subject->cost }}</td>
                                                    <td>{{ $subject->created_at }}</td>
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

            <div class="col-sm-6 col-md-5">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box">
                            <div class="box-header">
                                <span class="label success pull-right">5</span>
                                <h3>Add subject</h3>
                            </div>
                            <div class="box-body">
                                <div class="text-danger">
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p> 
                                    @endforeach
                                </div>
                                <div id="time-template" style="display: none">
                                    <div class="time-item">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Day</label>
                                            <div class="btn-group dropdown ">
                                                <div class="col-auto my-1 text-center">
                                                    <select class="custom-select mr-sm-2"
                                                        id="inlineFormCustomSelect" name="days[]" required>
                                                        <option selected value="sunday">Sunday</option>
                                                        <option value="monday">Monday</option>
                                                        <option value="tuesday">Tuesday</option>
                                                        <option value="wednesday">Wednesday</option>
                                                        <option value="thursday">Thursday</option>
                                                        <option value="friday">Friday</option>
                                                        <option value="saturday">Saturday</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-5">
                                                <label for="start_time">Start time</label>
                                                <div class='input-group date' id='start_time'>
                                                    <input type='text' class="form-control" name="start_times[]"
                                                        id="start_time" value="{{ old('start_time') }}"
                                                        placeholder="08:00 AM" required pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)" title="time 12:00PM" />
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-5">
                                                <label for="end_time">End time</label>
                                                <div class='input-group date' id='start_time'>
                                                    <input type='text' class="form-control" name="end_times[]"
                                                        id="end_time" value="{{ old('end_time') }}"
                                                        placeholder="12:00 AM" required pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)" title="time 12:00PM"/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-time"></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-outline-danger mt-4"
                                                    onclick="delete_time(this)" title="delete time">-</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form role="form" method="POST" id="myForm" action="{{ route('store-subject') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $package->id }}" name="package_id">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                            value="{{ old('name') }}" placeholder="Enter Name" name="name" required>
                                            <div class="text-danger">
                                                @error('first_name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Cost</label>
                                        <input type="number" class="form-control" id="exampleInputEmail1"
                                            value="{{ old('cost') }}" placeholder="Enter Cost" name="cost" required>
                                            <div class="text-danger">
                                                @error('first_name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                    </div>

                                    <div id="time-wrapper">
                                        <div class="">
                                            <button type="button" class="btn btn-outline-success mt-4"
                                                onclick="plus_time()" title="Add new time">+</button>
                                        </div>                                       
                                        <div class="time-item">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Day</label>
                                                <div class="btn-group dropdown ">
                                                    <div class="col-auto my-1 text-center">
                                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect"
                                                            name="days[]" required>
                                                            <option selected value="sunday">Sunday</option>
                                                            <option value="monday">Monday</option>
                                                            <option value="tuesday">Tuesday</option>
                                                            <option value="wednesday">Wednesday</option>
                                                            <option value="thursday">Thursday</option>
                                                            <option value="friday">Friday</option>
                                                            <option value="saturday">Saturday</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
        
                                            <div class="row">
                                                <div class="form-group col-sm-5">
                                                    <label for="start_time">Start time</label>
                                                    <div class='input-group date' id='start_time'>
                                                        <input type='text' class="form-control" name="start_times[]"
                                                            id="start_time" value="{{ old('start_time') }}"
                                                            placeholder="08:00 AM" required pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)" title="time 12:00PM"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-5">
                                                    <label for="end_time">End time</label>
                                                    <div class='input-group date' id='start_time'>
                                                        <input type='text' class="form-control" name="end_times[]"
                                                            id="end_time" value="{{ old('end_time') }}"
                                                            placeholder="12:00 AM" required pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)" title="time 12:00PM"/>
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-outline-danger mt-4"
                                                        onclick="delete_time(this)" title="delete time">-</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>                                    
                                    <button type="submit" class="btn primary m-b" id="submit-btn">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // $(function() {
        //     $('#start_time').datetimepicker({
        //         format: 'LT'
        //     });
        // });


        function plus_time() {
            let newTime = document.querySelector("#time-template").children[0].cloneNode(true)
            document.querySelector("#time-wrapper").appendChild(newTime)
        }

        function delete_time(inp) {
            inp.parentNode.parentNode.parentNode.remove();
        }

        // const startTime = document.getElementById('start_time');
        // const endTime = document.getElementById('end_time');
        // const submitBtn = document.getElementById('submit-btn');
        // document.getElementById('myForm').addEventListener('submit', function(event) {
        //     // Prevent form submission
        //     event.preventDefault();
        //     const startTimeVal = new Date("2023-01-01 " + startTime.value);
        //     const endTimeVal = new Date("2023-01-01 " + endTime.value);

        //     var starttimestamp = startTimeVal.getTime();
        //     var endtimestamp = endTimeVal.getTime();
        //     // Check condition
        //     if (endtimestamp < starttimestamp) {
        //         // Display error message
        //         alert('Your error message here');
        //     } else {
        //         // Submit form
        //         this.submit();
        //     }
        // });
    </script>
    <!-- ############ PAGE END-->
@endsection
