@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
            <div style="margin-left: 20%; margin-right: 20%">
                <div class="box">
                    <div class="box-header">
                        <h2>Add new package</h2>
                    </div>
                    <div class="box-divider m-0"></div>
                    <div class="box-body">
                        <form role="form" method="POST" action="{{ route('store-package') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter package name" name="name" required>
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Image</label>
                                <input type="file" id="exampleInputFile" class="form-control" name="image" required accept="image/*">
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Starts at</label>
                                        <div id='datetimepicker8'>
                                            <input type='date' class="form-control" name="start_date" required />
                                            @error('start_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker8').datetimepicker({
                                            icons: {
                                                time: "fa fa-clock-o",
                                                date: "fa fa-calendar",
                                                up: "fa fa-arrow-up",
                                                down: "fa fa-arrow-down"
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Ends at</label>
                            <div id='datetimepicker8'>
                                <input type='date' class="form-control" name="end_date" required/>
                                @error('end_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker8').datetimepicker({
                                            icons: {
                                                time: "fa fa-clock-o",
                                                date: "fa fa-calendar",
                                                up: "fa fa-arrow-up",
                                                down: "fa fa-arrow-down"
                                            }
                                        });
                                    });
                                </script>
                            </div>
                            </div>
                            <button type="submit" class="btn white m-b">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

    <!-- ############ PAGE END-->


@endsection
