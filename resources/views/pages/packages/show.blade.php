@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="padding">
        <a class="md-btn md-raised primary text-white" onclick="history.back()"><i class="fas fa-long-arrow-left"></i></a>
        <h2 class="text-primary d-inline ms-3">Package</h2>
        <div class="row">

            <div class="col-xs-6 col-md-4">
                <div class="box p-a">

                    <div class="text-center">
                        <img class='w-75' src="{{ asset('storage/images/packages/' . $package->image) }}"
                            class="img-responsive" alt={{ asset('images/packges/' . $package->image) }}>
                    </div>
                    <div class="p-a">
                        <div class="pull-right text-muted m-b-xs">
                            <a href="{{ route('packages.edit') }}"><i class="fa fa-edit"></i></a>
                        </div>
                        <div class="text-center text-md m-b h-2x _800">{{ $package->name }}</div>
                        <p class="text-center _800">Starts at : {{ $package->start_date }}</p>
                        <p class="text-center _800">Ends at : {{ $package->end_date }}</p>
                    </div>
                </div>

            </div>

            <div class="col-xs-12 col-md-8 ">
                <div class="box p-a">
                    <div class="item">
                        <div class="item-bg primary h6" style="height: 3rem">
                            <p class="p-a text-center">{{ $package->name }}’s subjects</p>
                        </div>
                        <div class="p-a pos-rlt">
                        </div>
                    </div>
                    <div class="p-a">
                        <div class="table-responsive">
                            <table class="table table-striped b-t text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Cost</th>
                                        <th class="text-center">Created at</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($package->subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->cost }}</td>
                                            <td>{{ $subject->created_at }}</td>
                                            <td>
                                                <form action="{{ route('subject.delete', ['subject' => $subject]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm md-raised btn-outline-danger border-0"
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
