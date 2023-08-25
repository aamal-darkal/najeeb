@extends('layouts.master')
@section('content')
    <div class="position-absolute top-0 left-0 mt-2 ml-5">
        <a class="md-btn md-raised primary text-white" onclick="history.back()"><i class="fas fa-long-arrow-left"></i></a>
    </div>
    <div class="container position-relative">

        <div class="row">

            <div class="col-md-3 p-2 text-center">
                <div class="box p-2">
                    <div class="text-primary box-header ">
                        <h2>Package {{ $package->name }}</h2>
                    </div>
                    <img src="{{ asset('storage/images/packages/' . $package->image ?? 'no-image.png') }}" width="100%">
                    <div>Starts at : {{ $package->start_date }}</div>
                    <div>Ends at : {{ $package->end_date }}</div>
                </div>
            </div>

            <div class="col-md-4 p-2 text-center">
                <div class="box p-1">
                    <div class="text-primary box-header">
                        <h2>{{ $package->name }}’s subjects</h2>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped b-a ">
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

            <div class="col-md-5  p-2">
                <div class="box">
                    <div class="box-header text-primary">
                        <span class="label primary pull-right text-sm">{{ $package->subjects->count() + 1 }}</span>
                        <h2>Edit subject</h2>
                    </div>
                    <div class="box-body">
                        <div class="text-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>

                        {{-- ========================== start of template-week prog instance ======================================= --}}
                        <div id="time-template" style="display: none">
                            <div class="time-item">
                                <input type="hidden" name="weekProgStates[]" value="new">
                                <input type="hidden" name="weekProgIds[]" value="new">                                                        
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Day</label>
                                    <div class="btn-group dropdown ">
                                        <div class="col-auto my-1 text-center">
                                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="days[]"
                                                required>
                                                <option hidden>select a day</option>
                                                <option @selected(old('day' , $subject->day) == 'sunday') value="sunday">Sunday</option>
                                                <option @selected($subject->day == 'monday') value="monday">Monday</option>
                                                <option @selected($subject->day == 'tuesday') value="tuesday">Tuesday</option>
                                                <option @selected($subject->day == 'wednesday') value="wednesday">Wednesday</option>
                                                <option @selected($subject->day == 'thursday') value="thursday">Thursday</option>
                                                <option @selected($subject->day == 'friday') value="friday">Friday</option>
                                                <option @selected($subject->day == 'saturday') value="saturday">Saturday</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-5">
                                        <label for="start_time">Start time</label>
                                        <div class='input-group date' id='start_time'>
                                            <input type='text' class="form-control" name="start_times[]" id="start_time"
                                                value="{{ old('start_time', $subject->start_time) }}"
                                                placeholder="08:00 AM" required
                                                pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)" title="time 8:00 AM" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-time"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-5">
                                        <label for="end_time">End time</label>
                                        <div class='input-group date' id='start_time'>
                                            <input type='text' class="form-control" name="end_times[]" id="end_time"
                                                value="{{ old('end_time', $subject->end_time) }}" placeholder="12:00 AM"
                                                required pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)"
                                                title="time 8:00 AM" />
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
                        {{-- ========================== end of template-week prog instance ======================================= --}}


                        <form role="form" method="POST" id="myForm" action="{{ route('subjects.update' , $subject) }}">
                            @csrf
                            <input type="hidden" value="{{ $package->id }}" name="package_id">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('name', $subject->name) }}" placeholder="Enter Name" name="name"
                                    required>
                                <div class="text-danger">
                                    @error('first_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cost</label>
                                <input type="number" class="form-control" id="exampleInputEmail1"
                                    value="{{ old('cost', $subject->cost) }}" placeholder="Enter Cost" name="cost"
                                    required>
                                <div class="text-danger">
                                    @error('first_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            <div id="time-wrapper">
                                <div class="">
                                    <button type="button" class="btn btn-outline-success mt-4" onclick="plus_time()"
                                        title="Add new time">+</button>
                                </div>

                                {{-- has pre posted value (old) --}}
                                @php
                                    $days = old('days');
                                    $start_time = old('start_time');
                                    $end_time = old('end_time');
                                @endphp

                                @if ($days)
                                    @for ($i = 0; $i < count($days); $i++)
                                        <div class="time-item">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Day</label>
                                                <div class="btn-group dropdown ">
                                                    <div class="col-auto my-1 text-center">
                                                        <input type="hidden" name="weekProgStates[]" value="{{ $weekProgStates[$i] }}">
                                                        <input type="hidden" name="weekProgIds[]" value="{{ $weekProgIds[$i] }}">
                                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect"
                                                            name="days[]" required>
                                                            <option hidden>select day</option>
                                                            <option @selected($weekProg->day == 'sunday') value="sunday">Sunday
                                                            </option>
                                                            <option @selected($weekProg->day == 'monday') value="monday">Monday
                                                            </option>
                                                            <option @selected($weekProg->day == 'tuesday') value="tuesday">Tuesday
                                                            </option>
                                                            <option @selected($weekProg->day == 'wednesday') value="wednesday">Wednesday
                                                            </option>
                                                            <option @selected($weekProg->day == 'thursday') value="thursday">Thursday
                                                            </option>
                                                            <option @selected($weekProg->day == 'friday') value="friday">Friday
                                                            </option>
                                                            <option @selected($weekProg->day == 'saturday') value="saturday">Saturday
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-sm-5">
                                                    <label for="start_time">Start time</label>
                                                    <div class='input-group date' id='start_time'>
                                                        <input type='text' class="form-control" name="start_times[]"
                                                            id="start_time"
                                                            value="{{ old('start_time', $weekProg->start_time) }}"
                                                            placeholder="8:00 AM" required
                                                            pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)"
                                                            title="time 8:00 AM" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-5">
                                                    <label for="end_time">End time</label>
                                                    <div class='input-group date' id='start_time'>
                                                        <input type='text' class="form-control" name="end_times[]"
                                                            id="end_time"
                                                            value="{{ old('end_time', $weekProg->end_time) }}"
                                                            placeholder="8:00 AM" required
                                                            pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)"
                                                            title="time 8:00 AM" />
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
                                    @endfor
                                @else
                                    {{-- has already saved value --}}
                                    @foreach ($subject->weekProgs() as $weekProg)
                                        <div class="time-item">
                                            <input type="hidden" name="weekProgStates[]" value="old">
                                            <input type="hidden" name="weekProgIds[]" value="{{ $weekProg->id }}">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Day</label>
                                                <div class="btn-group dropdown ">
                                                    <div class="col-auto my-1 text-center">
                                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect"
                                                            name="days[]" required>
                                                            <option hidden>select day</option>
                                                            <option @selected($weekProg->day == 'sunday') value="sunday">Sunday
                                                            </option>
                                                            <option @selected($weekProg->day == 'monday') value="monday">Monday
                                                            </option>
                                                            <option @selected($weekProg->day == 'tuesday') value="tuesday">Tuesday
                                                            </option>
                                                            <option @selected($weekProg->day == 'wednesday') value="wednesday">
                                                                Wednesday
                                                            </option>
                                                            <option @selected($weekProg->day == 'thursday') value="thursday">Thursday
                                                            </option>
                                                            <option @selected($weekProg->day == 'friday') value="friday">Friday
                                                            </option>
                                                            <option @selected($weekProg->day == 'saturday') value="saturday">Saturday
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-sm-5">
                                                    <label for="start_time">Start time</label>
                                                    <div class='input-group date' id='start_time'>
                                                        <input type='text' class="form-control" name="start_times[]"
                                                            id="start_time"
                                                            value="{{ old('start_time', $weekProg->start_time) }}"
                                                            placeholder="8:00 AM" required
                                                            pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)"
                                                            title="time 8:00 AM" />
                                                        <span class="input-group-addon">
                                                            <span class="glyphicon glyphicon-time"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-5">
                                                    <label for="end_time">End time</label>
                                                    <div class='input-group date' id='start_time'>
                                                        <input type='text' class="form-control" name="end_times[]"
                                                            id="end_time"
                                                            value="{{ old('end_time', $weekProg->end_time) }}"
                                                            placeholder="8:00 AM" required
                                                            pattern="(1[012]|[1-9]):[0-5][0-9] (am|pm|AM|PM)"
                                                            title="time 8:00 AM" />
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
                                    @endforeach
                                @endif

                                <button type="submit" class="btn primary m-b" id="submit-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('css')
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    @endpush

    @push('js')
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    @endpush


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
            inp.parentNode.parentNode.style.visibility = 'collapse';
            inp.parentNode.parentNode.firstElementChild.firstElementChild.value = 'del';
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
