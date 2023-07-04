@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2">
            <div class="wrapper-progressBar">
                <ul class="progressBar">
                    <li class="active">Choose package</li>
                    <li>Choose subject</li>
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
                                    <th>Starts at</th>
                                    <th>Ends at</th>
                                    <th class="text-center">Subjects count</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr>
                                        <td></td>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->start_date }}</td>
                                        <td>{{ $package->end_date }}</td>
                                        <td class="text-center">{{ $package->subjects_count }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('create.subject.step2') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                <button
                                                    class="md-btn md-raised m-b-sm w-xs primary text-white">Details</button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <form method="post" action="{{ route('create.lecture.step2') }}">
                                                @csrf
                                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                <input type="hidden" name="package_name" value="{{ $package->name }}">
                                                <button type="submit" class="md-btn md-raised m-b-sm primary text-white"><i
                                                        class="fa fa-check-square-o"></i></button>
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
