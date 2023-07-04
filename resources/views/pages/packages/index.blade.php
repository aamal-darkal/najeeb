@extends('layouts.master')
@section('content')
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
                                    <form action="{{ route('package.show') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                                        <button type="submit"
                                            class="p-0 text-md btn-rounded text-primary border-0 bg-transparent"
                                            title="details">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <button class="p-0 text-md btn-rounded text-danger border-0 bg-transparent"
                                        title="delete">
                                        <a href="{{ route('delete.package', $package->id) }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <!-- ############ PAGE END-->
@endsection
