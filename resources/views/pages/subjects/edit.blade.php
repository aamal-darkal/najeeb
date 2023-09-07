@extends('layouts.master')
@section('content')
    <div class="position-absolute top-0 left-0 mt-2 ml-5">
        <a class="md-btn md-raised primary text-white" onclick="history.back()"><i class="fas fa-long-arrow-left"></i></a>
    </div>
    <div class="container position-relative">

        <div class="row">

            {{-- ************** package box ***************** --}}
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

            {{-- ************** subjects box ***************** --}}
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

            {{-- ************** form box ***************** --}}
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

                        {{-- start time-template --}}
                        <div class="time-template" style="display: none">
                            <div class="time-item">
                                <input type="hidden" name="weekProgStates[]" value="insert">
                                <input type="hidden" name="weekProgIds[]" value="insert">       
                                <div class="form-group">
                                    <label>Day</label>
                                    <div class="col-auto my-1 text-center">
                                        <select class="custom-select mr-sm-2" name="days[]" required>
                                            @foreach ($weekDays as $weekDay)
                                                <option value="{{ $weekDay }}" == {{ $weekDay }}>
                                                    {{ $weekDay }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-5">
                                        <label>Start time</label>
                                        <select name="start_times[]" class="form-control">
                                            @foreach ($times as $time)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-5">
                                        <label>End time</label>
                                        <select name="end_times[]" class="form-control">
                                            @foreach ($times as $time)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-outline-danger mt-4"
                                            onclick="delete_time(this)" title="delete time">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end time-template --}}

                        <form role="form" method="POST" id="myForm" action="{{ route('subjects.update' , $subject) }}">
                            @csrf
                            @method('put')
                            <input type="hidden" value="{{ $package->id }}" name="package_id">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" value="{{ old('name' , $subject->name) }}"
                                    placeholder="Enter Name" name="name" maxlength="100" required>
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cost">Cost</label>
                                <input type="number" class="form-control" id="cost" value="{{ old('cost' , $subject->cost) }}"
                                    placeholder="Enter Cost" name="cost" min=0 required>
                                <div class="text-danger">
                                    @error('cost')
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
                                    $days= old('days');
                                    $start_times= old('start_times');
                                    $end_times= old('end_times');
                                    $weekProgStates = old('weekProgStates');
                                    $weekProgIds = old('weekProgIds');
                                @endphp
                                
                                @if ($days)
                                    @for ($i = 0 ; $i < count($days) ; $i++)
                                        <div class="time-item" @if($weekProgStates[$i] == 'delete') style="display: none" @endif>
                                            <input type="hidden" name="weekProgStates[]" value="{{ $weekProgStates[$i] }}">
                                            <input type="hidden" name="weekProgIds[]" value="{{ $weekProgIds[$i] }}">     
                                            <div class="form-group">
                                                <label>Day</label>
                                                <div class="col-sm-5 my-1 text-center">
                                                    <select class="custom-select mr-sm-2" name="days[]" required>
                                                        @foreach ($weekDays as $weekDay)
                                                            <option value="{{ $weekDays }}" @selected($weekDay == $days[$i])>{{ $weekDays }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-sm-5">
                                                    <label>Start time</label>
                                                    <select name="start_times[]" class="form-control" >
                                                        @foreach ($times as $time)
                                                            <option value="{{ $time }}" @selected($time == $start_times[$i])>{{ $time }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-5">
                                                    <label>End time</label>
                                                    <select name="end_times[]" class="form-control">
                                                        @foreach ($times as $time)
                                                            <option value="{{ $time }}" @selected($time == $end_times[$i])>{{ $time }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-outline-danger mt-4"
                                                        onclick="delete_time(this)" title="delete time">-</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    @foreach ($subject->weekProgs as $weekprog)
                                        <div class="time-item">    
                                            <input type="hidden" name="weekProgStates[]" value="update">
                                            <input type="hidden" name="weekProgIds[]" value="{{ $weekprog->id }}">                                       
                                            <div class="form-group">
                                                <label>Day</label>
                                                <div class="col-sm-5 my-1 text-center">
                                                    <select class="custom-select mr-sm-2" name="days[]" required>
                                                        @foreach ($weekDays as $weekDay)
                                                            <option value="{{ $weekDay }}" @selected($weekprog == $weekDay)>{{ $weekDay }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-sm-5">
                                                    <label>Start time</label>
                                                    <select name="start_times[]" class="form-control">
                                                        @foreach ($times as $time)
                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-5">
                                                    <label>End time</label>
                                                    <select name="end_times[]" class="form-control">
                                                        @foreach ($times as $time)
                                                            <option value="{{ $time }}">{{ $time }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-outline-danger mt-4"
                                                        onclick="delete_time(this)" title="delete time">-</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="submit" class="btn primary m-b" id="submit-btn">Save Subject</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            function plus_time() {
                let newTime = document.querySelector(".time-template").cloneNode(true)
                newTime.style.display = 'block'            
                document.querySelector("#time-wrapper").appendChild(newTime)
            }

            function delete_time(inp) {
                inp.parentNode.parentNode.parentNode.style.display = 'none';
                inp.parentNode.parentNode.parentNode.firstElementChild.value = 'delete';
            }

        </script>
    @endpush
@endsection
