@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2">
            <div class="wrapper-progressBar">
                <ul class="progressBar">
                    <li class="active">{{ $package_name }}</li>
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
                        <table class="table table-striped b-t b-b">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Cost</th>
                                    <th class="w-25"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $subject)
                                    <tr>
                                        <td></td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->cost }}</td>
                                        <td>

                                            <form method="post" action="{{ route('create.lecture.step3') }}">
                                                @csrf
                                                <select name="week_program_id" id="" class="form-control">
                                                    @foreach ($subject->weekProgs as $weekProg)
                                                        <option value="{{ $weekProg->id }}">{{ $weekProg->day }} -
                                                            {{ $weekProg->start_time }} - {{  $weekProg->end_time }}</option>
                                                    @endforeach
                                                </select>
                                        </td>
                                        <td>
                                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                            <input type="hidden" name="subject_name" value="{{ $subject->name }}">
                                            <input type="hidden" name="package_name" value="{{ $package_name }}">
                                            <button class="md-btn md-raised m-b-sm primary text-white"><i
                                                    class="fa fa-check-square-o"></i></button>
                                        </td>
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
