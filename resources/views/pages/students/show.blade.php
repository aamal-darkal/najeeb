@extends('layouts.master')
@section('content')

    <div class="box-header p-1 pl-3">
        <a class="md-btn md-raised primary text-white m-0" onclick="history.back()"><i class="fas fa-long-arrow-left"></i></a>

        <h2 class="text-primary d-inline ml-2"> Student info: {{ $student->first_name }} {{ $student->father_name }}
            {{ $student->last_name }} </h2>
    </div>

    <div class="container text-center py-3 ">
        <a href="{{ route('students.password-edit', $student) }}" class="md-btn md-raised w-sm accent py-1"> edit password</a>
        <a href="{{ route('students.edit', $student) }}" class="md-btn md-raised w-sm py-1 primary">Edit data</a>
        <a href="{{ route('students.subcribe-edit', $student) }}" class="md-btn md-raised w-sm py-1 info">subcribe</a>
        <a href="{{ route('students.notification-create', $student) }}" class="md-btn md-raised w-sm py-1 warn">notify</a>
        <form action="{{ route('students.destroy', ['student' => $student]) }}" class="d-inline" method="post"
            onsubmit="return confirm('delete student ?')">
            @csrf
            @method('delete')
            <button class="md-btn md-raised w-sm py-1 warning position-relative" style="bottom:10px">Delete</button>
        </form>
    </div>
    <div class="box w-75 mx-auto p-3 col-md-8 col-md-8 mx-auto mt-3">
        <div class="row">
            <div class="col-md-6">
                <div class="text-primary p-1">Username: </div>
                <div class="field-value bg-white p-1 box-shadow">{{ $student->user->user_name }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-primary p-1 ">First name:</div>
                <div class="field-value bg-white p-1 box-shadow"> {{ $student->first_name }} </div>
            </div>
            <div class="col-md-6">
                <div class="text-primary p-1">Last name: </div>
                <div class="field-value bg-white p-1 box-shadow">{{ $student->last_name }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-primary p-1">Fathor name:</div>
                <div class="field-value bg-white p-1 box-shadow ">{{ $student->father_name }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-primary p-1">governorate</div>
                <div class="field-value bg-white p-1 box-shadow ">{{ $student->governorate }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-primary p-1">phone</div>
                <div class="field-value bg-white p-1 box-shadow ">{{ $student->phone }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-primary p-1">parent phone </div>
                <div class="field-value bg-white p-1 box-shadow ">{{ $student->parent_phone }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-primary p-1">land line:</div>
                <div class="field-value bg-white p-1 box-shadow ">{{ $student->land_line }}</div>
            </div>

        </div>
    </div>

    {{-- subjects --}}
    @if ($student->subjects->count())
        <div class="container col-md-8 mt-5">
            <h5 class="text-primary w-100 my-0"> Subjects </h5>
            <table class="table table-bordered table-condensed bg-white">
                <thead class="dker text-dark">
                    <tr>
                        <th>name</th>
                        <th>cost</th>
                        <th>package</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->cost }}</td>
                            <td>{{ $subject->package->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- orders --}}
    @if ($student->orders->count())
        <div class="container col-md-8 mt-5">
            <h5 class="text-primary w-100 my-0"> Orders </h5>
            <table class="table table-bordered table-condensed bg-white">

                <thead class="dker text-dark">
                    <tr>
                        <th>amount</th>
                        <th>date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->orders as $order)
                        <tr>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- payments --}}
        <div class="container col-md-8 my-5">
            <h5 class="text-primary w-100 my-0"> Payments </h5>
            <table class="table table-bordered table-condensed bg-white">
                <thead class="dker text-dark">
                    <tr>
                        <th>amount</th>
                        <th>bill_number</th>
                        <th>payment_date</th>
                        <th>payment_method</th>
                        <th>state</th>
                        <th>start_duration_date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->orders as $order)
                        @foreach ($order->payments as $payment)
                            <tr>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->bill_number }}</td>
                                <td>{{ $payment->payment_date }}</td>
                                <td>{{ $payment->paymentMethod->name }}</td>
                                <td>{{ $payment->state }}</td>
                                <td>{{ $payment->start_duration_date }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    @if ($student->notifications->count())
        <div class="container col-md-8 mt-5">
            <h5 class="text-primary w-100 my-0"> Notications </h5>
            <table class="table table-bordered table-condensed bg-white">
                <thead class="dker text-dark">
                    <tr>
                        <th>title</th>
                        <th>description</th>
                        <th>time_publish</th>
                        <th>seen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($student->notifications as $notification)
                        <tr>
                            <td>{{ $notification->title }}</td>
                            <td>{{ $notification->description }}</td>
                            <td>{{ $notification->time_publish }}</td>
                            <td>{{ $notification->pivot->seen }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <br>
    <br>
    <br>


@endsection
