@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2>Subscriptions</h2>
            </div>
            @if($orders->isNotEmpty())
            <button type="button" class="btn btn-outline b-primary text-primary m-l" id="checkStatus" onclick="checkAllRecords()">Check All</button>
            @endif
                <form method="POST" action="{{ route('change.subscriptions.status') }}">
                @csrf
            <div class="table-responsive">
                @if($orders->isNotEmpty())
                        <table
                            {{--                    ui-jp="dataTable" ui-options="{--}}
                            {{--          sAjaxSource: 'api/datatable.json',--}}
                            {{--          aoColumns: [--}}
                            {{--            { mData: 'engine' },--}}
                            {{--            { mData: 'browser' },--}}
                            {{--            { mData: 'platform' },--}}
                            {{--            { mData: 'version' },--}}
                            {{--            { mData: 'grade' }--}}
                            {{--          ]--}}
                            {{--        }" --}}
                            class="table table-striped b-t b-b">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Bill number</th>
                                <th>Payed amount</th>
                                <th>Subjects</th>
                                <th>Ordered at</th>
                                <th>Status</th>
                                <th>Orderd by</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td><label class="ui-check m-0"><input type="checkbox" name="ids[]" value="{{$order->id}}"><i style="background-color: #f1efef"></i></label></td>
                                    <td>{{$order->payment->bill_number}}</td>
                                    <td>{{$order->amount}}</td>
                                    <td>{{$order->subjects_count}}</td>
                                    <td>{{$order->created_at}}</td>
                                    @if($order->payment->state == 'approved')
                                        <td><span class="label success" title="Suspended">{{$order->payment->state}}</span>
                                        </td>
                                    @elseif($order->payment->state == 'rejected')
                                        <td><span class="label danger" title="Suspended">{{$order->payment->state}}</span>
                                        </td>
                                    @elseif($order->payment->state == 'pending')
                                        <td><span class="label warn" title="Suspended">{{$order->payment->state}}</span>
                                        </td>
                                    @endif
                                        <td>
                                            <span class="label primary" title="Suspended"><a href="{{route('student-details',$order->student->id)}}">{{$order->student->first_name .' '. $order->student->last_name}}</a></span>
                                        </td>
                                        <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center" >
                            <input type="hidden" name="status" id="status" value="">
                            <button type="submit" class="md-btn md-raised w-xs primary m-4" onclick="updateStatus('approved')">Approve</button>
                            <button type="submit" class="md-btn md-raised w-xs danger m-4" onclick="updateStatus('rejected')">Reject</button>
                        </div>
            </div>
                    </form>
                @else
                    <div class="container w-75">
                        <div class="text-center">
                            <img src="{{asset('images/defaults/no-data.png')}}" alt="" class="w-50">

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
            }
            else
            {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = false;
                }
                document.getElementById("checkStatus").innerHTML = 'Check All';

            }

        }
    </script>
    <!-- ############ PAGE END-->


@endsection
