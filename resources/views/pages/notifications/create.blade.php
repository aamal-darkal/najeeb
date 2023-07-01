@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <div style="margin-left: 20%; margin-right: 20%">
            <div class="box">
                <div class="box-header">
                    <h2>Send notification</h2>
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
                    <form role="form" method="POST" action="{{ route('notification.send') }}" >
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control"
                                   placeholder="Enter notification title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Content</label>
                            <input type="text" class="form-control"
                                   placeholder="Enter notification content" name="body" required>
                        </div>
                        <button type="submit" class="btn white m-b">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ############ PAGE END-->


@endsection
