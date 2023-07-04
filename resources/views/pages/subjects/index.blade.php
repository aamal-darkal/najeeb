@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">

            <div class="box-header">
                <h2>Subjects</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-b">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Cost</th>
                            <th>Created at</th>
                            {{-- <th>Day</th>
                            <th>Starts at</th>
                            <th>Ends at</th> --}}
                            <th>Assigned students</th>
                            <th class="text-center" style="width:15%">package</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td></td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->cost }}</td>
                                <td>{{ $subject->created_at }}</td>
                                {{-- <td>{{ $subject->weekProg ? $subject->weekProg->day : 'X' }}</td>
                                <td>{{ $subject->weekProg ? $subject->weekProg->start_time : 'X' }}</td>
                                <td>{{ $subject->weekProg ? $subject->weekProg->end_time : 'X' }}</td> --}}
                                <td class="text-center">{{ $subject->students_count }}</td>
                                @if ($subject->package)
                                    <td class="text-center"><span class="label primary pos-rlt" style="font-size: 100%">
                                            {{ $subject->package->name }}</span>
                                    </td>
                                @else
                                    <td></td>
                                @endif
                                <td>
                                    <button class="p-0 text-md btn-rounded text-danger text-md border-0 bg-transparent"
                                        title="delete">
                                        <a href="{{ route('delete.subject', $subject->id) }}">
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
