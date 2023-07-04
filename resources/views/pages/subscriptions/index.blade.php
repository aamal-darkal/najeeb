@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2>Subscriptions</h2>
            </div>
            <div class="table-responsive">
                @if ($payments->isNotEmpty())
                    @csrf
                    <table class="table table-striped b-t b-b">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Bill number</th>
                                <th>Payed amount</th>
                                <th>Ordered at</th>
                                <th>Status</th>
                                <th>Orderd by</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr>
                                    <td></td>
                                    <td>{{ $payment->bill_number }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->payment_date }}</td>
                                    @if ($payment->state == 'approved')
                                        <td><span class="label success" title="approved">{{ $payment->state }}</span>
                                        </td>
                                    @elseif($payment->state == 'rejected')
                                        <td><span class="label danger" title="rejected">{{ $payment->state }}</span>
                                        </td>
                                    @elseif($payment->state == 'pending')
                                        <td><span class="label warn" title="pending">{{ $payment->state }}</span>
                                        </td>
                                    @endif
                                    <td>
                                        <a class="md-btn md-raised w-100 primary"
                                            href="{{ route('student-details', $payment->order->student->id) }}">{{ $payment->order->student->first_name . ' ' . $payment->order->student->last_name }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="container w-75">
                        <div class="text-center">
                            <img src="{{ asset('images/defaults/no-data.png') }}" alt="" class="w-50">

                            <p class="h4 text-primary">There is no subscriptions</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ############ PAGE END-->


@endsection
