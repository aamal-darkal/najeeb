@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2>Students requests</h2>
            </div>
            <button type="button" class="btn btn-outline b-primary text-primary m-l" id="checkStatus" onclick="checkAllRecords()">Check All</button>
            <form method="POST" action="{{ route('change.students.status') }}">
                @csrf

                <div class="table-responsive">
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
{{--        }"--}}
                    class="table table-striped b-t b-b">
                    <thead>
                    <tr>
                        <th></th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Father name</th>
                        <th>Phone</th>
                        <th>Land line</th>
                        <th>Parent phone</th>
                        <th>State</th>
                        <th>Send at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td><label class="ui-check m-0"><input type="checkbox" name="ids[]" value="{{$request->id}}"><i style="background-color: #f1efef"></i></label></td>
                            <td>{{$request->first_name}}</td>
                            <td>{{$request->last_name}}</td>
                            <td>{{$request->father_name}}</td>
                            <td>{{$request->phone}}</td>
                            <td>{{$request->land_line}}</td>
                            <td>{{$request->parent_phone}}</td>
                            <td><span class="label warn" title="Suspended">{{$request->state}}</span></td>
                            <td>{{$request->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
                <div class="d-flex justify-content-center" >
                <input type="hidden" name="status" id="status" value="">
                <button type="submit" class="md-btn md-raised w-xs primary m-4" onclick="updateStatus('current')">Approve</button>
                <button type="submit" class="md-btn md-raised w-xs danger m-4" onclick="updateStatus('rejected')">Reject</button>
                </div>
            </form>
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
