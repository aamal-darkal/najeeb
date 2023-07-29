@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <div style="margin-left: 20%; margin-right: 20%">
            <div class="box">
                <div class="box-header text-primary">
                    <a class="md-btn md-raised primary text-white" onclick="history.back()"><i
                            class="fas fa-long-arrow-left"></i></a>
                    <h2 class="d-inline ml-2">Add new package</h2>
                </div>
                <div class="box-divider m-0"></div>
                <div class="box-body">
                    <form role="form" method="POST" action="{{ route('packages.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter package name"
                                name="name" value="{{ old('name') }}" required maxlength="100">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" id="image" class="form-control" name="image" value="{{ old('image') }}" accept="image/*">
                            @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="start_date">Starts at</label>
                            <div id='start_date'>
                                <input type='date' class="form-control" name="start_date" value="{{ old('start_date') }}" required />
                                @error('start_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <script></script>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Ends at</label>
                            <div id='end_date'>
                                <input type='date' class="form-control" name="end_date"  value="{{ old('end_date') }}" required />
                                @error('end_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror                               
                            </div>
                        </div>
                        <button type="submit" class="btn white m-b primary">Save Package</button>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $('#start_date').datetimepicker();
            $('#enddate').datetimepicker();
        </script>
    @endsection
