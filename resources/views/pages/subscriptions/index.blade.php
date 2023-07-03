@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2>Subscriptions</h2>
            </div>
            <div class="table-responsive">
                @if($orders->isNotEmpty())
                    <form method="POST" action="{{ route('change.students.status') }}">
                        @csrf
                        <input type="hidden" name="status" id="status" value="">
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
                                    <td></td>
                                    {{-- <td>{{$order->pa   yments->bill_number}}</td> --}}
                                    <td>{{$order->amount}}</td>
                                    <td>{{$order->subjects_count}}</td>
                                    <td>{{$order->created_at}}</td>
                                    {{-- error --}}
                                    {{-- @if($order->payments->state == 'approved')
                                        <td><span class="label success" title="Suspended">{{$order->payment->state}}</span>
                                        </td>
                                    @elseif($order->payments->state == 'rejected')
                                        <td><span class="label danger" title="Suspended">{{$order->payment->state}}</span>
                                        </td>
                                    @elseif($order->payments->state == 'pending')
                                        <td><span class="label warn" title="Suspended">{{$order->payment->state}}</span>
                                        </td>
                                    @endif --}}
                                        <td>
                                            <span class="label primary" title="Suspended"><a href="{{route('student-details',$order->student->id)}}">{{$order->student->first_name .' '. $order->student->last_name}}</a></span>
                                        </td>
                                        <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                @else
                    <div class="container w-75">
                        <div class="text-center">
                            <img src="{{asset('images/defaults/no-data.png')}}" alt="" class="w-50">

                            <p class="h4 text-primary">There is no subscriptions</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- ############ PAGE END-->


@endsection
