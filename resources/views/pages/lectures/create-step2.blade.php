@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2">
            <div class="wrapper-progressBar">
                <ul class="progressBar">
                    <li class="active">{{$packageName}}</li>
                    <li class="active">Choose subject</li>
                    <li>Create lecture</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container">

        <!-- ############ PAGE START-->
        <div class="padding">
            <div class="box">

                <div class="box-header">
                    <h2>Packages</h2>
                </div>
                <div class="table-responsive">
                    <table
{{--                        ui-jp="dataTable" ui-options="{--}}
{{--          sAjaxSource: 'api/datatable.json',--}}
{{--          aoColumns: [--}}
{{--            { mData: 'engine' },--}}
{{--            { mData: 'browser' },--}}
{{--            { mData: 'platform' },--}}
{{--            { mData: 'version' },--}}
{{--            { mData: 'grade' }--}}
{{--          ]--}}
{{--        }"--}}
                        class="table table-striped b-t b-b">
                        <thead>
                        <tr>
                            <th></th>
                            <th >Name</th>
                            <th >Cost</th>
                            <th class="text-center" ></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td></td>
                                <td>{{$subject->name}}</td>
                                <td>{{$subject->cost}}</td>
                                <td class="text-center">
                                    <form method="post" action="{{route('create.lecture.step3')}}">
                                        @csrf
                                        <input type="hidden" name="weekProg_id" value="{{$subject->id}}">
                                        <input type="hidden" name="subject_id" value="{{$subject->weekProg->id}}">
                                        <input type="hidden" name="subject_name" value="{{$subject->name}}">
                                        <input type="hidden" name="package_name" value="{{$packageName}}">
                                    <button class="md-btn md-raised m-b-sm primary text-white"><i class="fa fa-check-square-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


        <!-- ############ PAGE END-->
@endsection
