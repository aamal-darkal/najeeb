@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">
            <div class="box-header">
                <h2>DataTables</h2>
            </div>
            <div class="table-responsive">
                <table ui-jp="dataTable" ui-options="{
          sAjaxSource: 'api/datatable.json',
          aoColumns: [
            { mData: 'engine' },
            { mData: 'browser' },
            { mData: 'platform' },
            { mData: 'version' },
            { mData: 'grade' }
          ]
        }" class="table table-striped b-t b-b">
                    <thead>
                    <tr>
                        <th></th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Father name</th>
                        <th>Mobile</th>
                        <th>Phone</th>
                        <th>Parent phone</th>
                        <th>State</th>
                        <th>Send at</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td><label class="ui-check m-0"><input type="checkbox" name="post[]"><i class="dark-white"></i></label></td>
                            <td>{{$request->first_name}}</td>
                            <td>{{$request->last_name}}</td>
                            <td>{{$request->father_name}}</td>
                            <td>{{$request->moblie}}</td>
                            <td>{{$request->phone}}</td>
                            <td>{{$request->parent_phone}}</td>
                            <td><span class="label warning" title="Suspended">{{$request->state}}</span></td>
                            <td>{{$request->created_at}}</td>
                            <form method="POST" action="{{ route('approve-student') }}">
                                @csrf
                                <td>
                                    <button type="submit" class="md-btn md-raised m-b-sm w-xs primary" name="ids[{{$request->id}}]" value="{{$request->id}}">Approve</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ############ PAGE END-->


@endsection
