@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <div style="margin-left: 20%; margin-right: 20%">
            <div class="box">
                <div class="box-header">
                    <h2>Add new Student</h2>
                </div>
                <div class="box-divider m-0"></div>
                <div class="box-body">
                    <div class="text-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p> 
                        @endforeach
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ route('store.student') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">First name</label>
                                    <input type="text" class="form-control" placeholder="Enter First name"
                                        name="first_name" value="{{ old('first_name') }}" required>

                                    <div class="text-danger">
                                        @error('first_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="exampleInputEmail1">Last name</label>
                                    <input type="text" class="form-control" placeholder="Enter Last name"
                                        name="last_name" value="{{ old('last_name') }}" required>
                                    <div class="text-danger">
                                        @error('last_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">Father name</label>
                                    <input type="text" class="form-control" placeholder="Enter Father name"
                                        name="father_name" value="{{ old('father_name') }}">
                                    <div class="text-danger">
                                        @error('father_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Governorate</label>
                                    <input type="text" class="form-control" placeholder="Enter governorate"
                                        name="governorate" value="{{ old('governorate') }}" required>
                                    <div class="text-danger">
                                        @error('governorate')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Land line</label>
                            <div id='datetimepicker8'>
                                <input type="text" class="form-control" placeholder="Enter land line number"
                                    name="land_line" value="{{ old('land_line') }}" required>
                                <div class="text-danger">
                                    @error('land_line')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Parent phone</label>
                            <div id='datetimepicker8'>
                                <input type="text" class="form-control" placeholder="Enter parent phone"
                                    name="parent_phone" value="{{ old('parent_phone') }}" required>
                                <div class="text-danger">
                                    @error('parent_phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone"
                                value="{{ old('phone') }}" required>
                            <div class="text-danger">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn white m-b">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ############ PAGE END-->
    @endsection
