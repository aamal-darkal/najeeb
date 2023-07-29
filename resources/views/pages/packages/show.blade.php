@extends('layouts.master')
@section('content')
    {{-- ***************************  package's subjects ************************** --}}
    <div class="container-fluid">
        <a href="{{ route('packages.index') }}" title="All packages"
            class="md-btn md-raised m-b-sm w-md primary text-white r-15 mt-3"><i class="fas fa-long-arrow-left"></i>
            &nbsp;&nbsp; All packages</a>
        <div class="row text-center">
            <div class="col-md-5 p-1">
                <div class="text-primary box-header">
                    <h2 class="d-inline ml-2"> {{ $package->name }} package</h2>
                </div>
                <div class="table-reponsive">
                    <table class="table table-responive text-center b-a b-a b-3x b-primary">
                        <thead>
                            <tr class="text-primary dker">
                                <th>package image</th>
                                <th>package Name</th>
                                <th>Starts at</th>
                                <th>Ends at</th>
                                <th>Subj count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="primary-light text-primary _800">
                                <td><img class="w-xxs m-0" src="{{ asset('storage/images/packages/' . $package->image) }}"
                                        alt={{ asset('storage/images/packges/' . $package->image) }}>
                                </td>
                                <td class="v-m">{{ $package->name }}</td>
                                <td class="v-m">{{ $package->start_date }}</td>
                                <td class="v-m">{{ $package->end_date }}</td>
                                <td class="v-m w-xxs">{{ $package->subjects->count() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-7">
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
