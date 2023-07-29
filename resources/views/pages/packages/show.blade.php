@extends('layouts.master')
@section('content')
    {{-- ***************************  package's subjects ************************** --}}
    <div class="container-fluid">
        <div class="row text-center align-items-start">
            <div class="col-md-2 p-1">
                <a href="{{ route('packages.index') }}" title="All packages"
                    class="md-btn md-raised m-b-sm w-md primary text-white r-15 mt-3"><i class="fas fa-long-arrow-left"></i>
                    &nbsp;&nbsp; All packages</a>
                <div class="p-2 primary-light b-a b-primary b-2x text-left text-md mt-1">
                    <div class="text-center">
                        <img src="{{ asset('storage/images/packages/' . $package->image) }}"
                            alt={{ asset('storage/images/packges/' . $package->image) }} width="100%">
                    </div>
                    <div class="p-2 text-center _800">
                        <div class="field-value">
                            <div class="text-primary">package Name: </div>
                            {{ $package->name }}
                        </div>
                        <div class="field-value">
                            <div class="text-primary">Starts at: </div>
                            {{ $package->start_date }}
                        </div>
                        <div class="field-value">
                            <div class="text-primary">Ends at: </div>
                            {{ $package->end_date }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 ">
                <div class="box-header text-primary">
                    <h2 class="d-inline ml-2">{{ $package->name }}’s subjects ({{ $package->subjects->count() }})</h2>
                </div>
                <div class="table-reponivev box p-2">
                    <a class="md-btn md-raised primary text-white w-md m-3"
                        href="{{ route('subjects.create', ['package' => $package->id]) }}"> Add subject
                        &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-plus-square fa-lg"></i></a>
                    <table class="table table-striped b-a b-2x">
                        <thead class="dker text-primary">
                            <tr>
                                <th>Subject Name</th>
                                <th>Subject Cost</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($package->subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->cost }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-success border-0" title="students"
                                            href="{{ route('students.index', ['subject' => $subject]) }}">
                                            <i class="fa fa-users"></i></a>
                                        <a class="btn btn-sm btn-outline-warning border-0" title="notify"
                                            href="{{ route('notifications.create', ['subject' => $subject]) }}">
                                            <i class="fa fa-bell"></i></a>
                                        <a class="btn btn-sm btn-outline-info border-0" title="edit"
                                            onclick="alert('under working')" href="{{ route('subjects.edit', $subject) }}">
                                            <i class="fa fa-edit"></i></a>
                                        <form action="{{ route('subjects.destroy', ['subject' => $subject]) }}"
                                            method="POST" class="d-inline pl-1"
                                            onsubmit="return confirm('Delete {{ $subject->name }} Subject?')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-outline-danger border-0" title="delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center w-sm">
                                        <a title="Lectures" class="md-btn md-raised primary text-white w-sm r-15"
                                            href="{{ route('subjects.show', ['subject' => $subject]) }}"> Lectures <i
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

    <script>
        const startTime = document.getElementById('start_time');
        const endTime = document.getElementById('end_time');
        const submitBtn = document.getElementById('submit-btn');
        document.getElementById('myForm').addEventListener('submit', function(event) {
            // Prevent form submission
            event.preventDefault();
            const startTimeVal = new Date("2023-01-01 " + startTime.value);
            const endTimeVal = new Date("2023-01-01 " + endTime.value);

            var starttimestamp = startTimeVal.getTime();
            var endtimestamp = endTimeVal.getTime();
            // Check condition
            if (endtimestamp < starttimestamp) {
                // Display error message
                alert('Your error message here');
            } else {
                // Submit form
                this.submit();
            }
        });
    </script>
    <!-- ############ PAGE END-->
@endsection
