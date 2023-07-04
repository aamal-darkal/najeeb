@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2>Subscriptions</h2>
            </div>
            @if ($payments->isNotEmpty())
                <button type="button" class="btn btn-outline b-primary text-primary m-l" id="checkStatus"
                    onclick="checkAllRecords()">Check All</button>
            @endif

            <form method="POST" action="{{ route('change.subscriptions.status') }}">
                @csrf
                <div class="table-responsive">
                    @if ($payments->isNotEmpty())
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
                                        <td><label class="ui-check m-0"><input type="checkbox" name="ids[]"
                                                    value="{{ $payment->id }}"><i
                                                    style="background-color: #f1efef"></i></label></td>
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
                        <div class="d-flex justify-content-center">
                            <input type="hidden" name="status" id="status" value="">
                            <button type="submit" class="md-btn md-raised w-xs primary m-4" name="status"
                                value="approved">Approve</button>
                            <button type="submit" class="md-btn md-raised w-xs danger m-4" name="status"
                                value="rejected">Reject</button>
                        </div>
                </div>
            </form>
        @else
            <div class="container w-75">
                <div class="text-center">
                    <img src="{{ asset('images/defaults/no-data.png') }}" alt="" class="w-50">

                    <p class="h4 text-primary">There is no pending subscriptions</p>
                </div>
            </div>
            @endif
        </div>
    </div>
    <script>
        function updateStatus(id) {
            document.getElementById("status").value = id;
        }

        function checkAllRecords() {
            var checkboxes = document.getElementsByName("ids[]");
            var checkStatus = document.getElementById("checkStatus").innerHTML;
            if (checkStatus === 'Check All') {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = true;
                }
                document.getElementById("checkStatus").innerHTML = 'Uncheck All';
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = false;
                }
                document.getElementById("checkStatus").innerHTML = 'Check All';

            }

        }
    </script>
    <!-- ############ PAGE END-->


@endsection
