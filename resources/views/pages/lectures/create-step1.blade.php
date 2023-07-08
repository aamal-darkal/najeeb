@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2">
            <div class="wrapper-progressBar">
                <ul class="progressBar">
                    <li class="active"> Choose package</a></li>
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
                                            <a class="md-btn md-raised m-b-sm w-sm primary text-white r-15" 
                                                href="{{ route('package.show', ['package_id' => $package->id]) }}">Details</a>
                                        </td>
                                        <td class="text-center">
                                            <a class="md-btn md-raised m-b-sm w-xs primary text-white r-15"
                                                href="{{ route('create.lecture.step2', ['package_id' => $package->id, 'package_name' => $package->name]) }}"><i
                                                    class="fas fa-long-arrow-right"></i></a>
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
