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
                    <form role="form" method="POST" action="{{ route('store.student') }}" >
                        @csrf
                        <div class="form-group">
                            <div class="row">
                            <div class="col">
                                <label for="exampleInputEmail1">First name</label>
                                <input type="text" class="form-control"
                                       placeholder="Enter First name" name="first_name" required>
                            </div>
                            <div class="col">
                                <label for="exampleInputEmail1">Last name</label>
                                <input type="text" class="form-control"
                                       placeholder="Enter Last name" name="last_name" required>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">Father name</label>
                                    <input type="text" class="form-control"
                                           placeholder="Enter Father name" name="father_name" required>
                                </div>
                                <div class="col">
                                    <label for="exampleInputEmail1">Governorate</label>
                                    <input type="text" class="form-control"
                                           placeholder="Enter governorate" name="governorate" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Land line</label>
                            <div id='datetimepicker8'>
                                <input type="text" class="form-control"
                                       placeholder="Enter land line number" name="land_line" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Parent phone</label>
                            <div id='datetimepicker8'>
                                <input type="text" class="form-control"
                                       placeholder="Enter parent phone" name="parent_phone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone</label>
                            <input type="text" class="form-control"
                                   placeholder="Enter Phone Number" name="phone" required>
                        </div>
                        <button type="submit" class="btn white m-b">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ############ PAGE END-->


@endsection
