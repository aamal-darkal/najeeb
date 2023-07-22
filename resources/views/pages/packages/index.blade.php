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
                                    <a title="details" class="p-0 text-md btn-rounded text-primary border-0 bg-transparent"
                                        href="{{ route('packages.show', ['package' => $package]) }}"><i
                                            class="fa fa-bars"></i></a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('packages.destroy', ['package' => $package]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger border-0"
                                            title="delete">                                           
                                                <i class="fa fa-trash"></i>                                            
                                        </button>
                                    </form>
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
