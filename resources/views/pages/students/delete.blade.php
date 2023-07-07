@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="container mt-1">
        <h6 class="alert alert-danger col-md-6 mx-auto text-center text-danger">
            {{ "$student->first_name  $student->last_name" }}
            <br> has an @if ($student->user_count)
                account
            @endif and {{ $student->orders_count }} order(s) and {{ $student->subjects_count }}
            subject(s),
            <br> Are you sure you want to delete him/her with his/her
            details
        </h6>
    </div>
    {{-- orders --}}
    <div class="container" style="overflow: auto">
        <h4 class="text-primary text-center w-100 my-0"> Orders </h4>

        <table class="table bg-white">
            <thead class="primary">
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
        {{-- payments --}}
        <h4 class="text-primary text-center w-100 my-0"> Payments </h4>
        <table class="table bg-white">
            <thead class="primary">
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
        {{-- subjects --}}
        <h4 class="text-primary text-center w-100 my-0"> Subjects </h4>
        <table class="table bg-white">
            <thead class="primary">
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

        <form action="{{ route('student.destroy', ['student' => $student]) }}" class="text-center" method="post">
            @csrf
            @method('delete')
            <button class="btn btn-danger">Delete</button>
            <a href="{{ route('students') }}" class="btn btn-outline-success" >cancel</a>
        </form>
        

    </div>
    <!-- ############ PAGE END-->
@endsection
