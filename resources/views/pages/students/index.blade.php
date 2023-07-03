@extends('layouts.master')
@section('content')

    <!-- ############ PAGE START-->
    <div class="padding">
        <form action="{{route('search.students')}}" method="post" class="m-b-md">
            @csrf
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" name="search" placeholder="Type keyword">
                <span class="input-group-btn">
        <button class="btn b-a no-shadow white" type="submit">Search</button>
      </span>
            </div>
        </form>
        <div class="box">
            @if(isset($status))
                <div class="box-header">
                    <h2>{{$status}} Students</h2>
                </div>
            @endif
            <div class="table-responsive">
                @if($students->isNotEmpty())
                    <form method="POST" action="{{ route('change.students.status') }}">
                        @csrf
                        <input type="hidden" name="status" id="status" value="">
                        <input type="hidden" name="ids[]" id="ids" value="">
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
                                <th>User name</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Father name</th>
                                <th>Phone</th>
                                <th>Land line</th>
                                <th>Parent phone</th>
                                <th>Send</th>
                                <th>Assigned subjects</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>                                
                            @foreach($students as $student)
                                <tr>
                                    <td>{{$student->user? $student->user->user_name : ''}}</td>
                                    <td>{{$student->first_name}}</td>
                                    <td>{{$student->last_name}}</td>
                                    <td>{{$student->father_name}}</td>
                                    <td>{{$student->phone}}</td>
                                    <td>{{$student->land_line}}</td>
                                    <td>{{$student->parent_phone}}</td>
                                    <td>{{\Carbon\Carbon::create($student->created_at)->diffForHumans()}}</td>

                                    @if($student->state == 'current')
                                        <td class="text-center">
                                            <div class="btn-group dropdown">
                                                <button class="btn white dropdown-toggle" data-toggle="dropdown">{{$student->subjects_count}}</button>
                                                <div class="dropdown-menu dropdown-menu-scale">
                                                    <ul class="timeline">
                                                    @foreach($student->subjects as $subject)
                                                            <li class="tl-item">
                                                                <div class="tl-wrap b-primary" style="margin-left: 10px; padding: 4px 0px 4px 20px">
                                                                    <div class="tl-content text-center">
                                                                        {{$subject->name}}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                    @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="label primary" title="Suspended">{{$student->state}}</span>
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('reset.token.date')}}">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$student->user->id}}">
                                            <button type="submit" class="p-0 text-md btn-rounded text-warn border-0 bg-transparent"
                                                    title="Reset token date">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                            </form>
                                        </td>

                                        <td>
                                            <a href="{{route('student-details',$student->id)}}"
                                               class="p-0 text-md btn-rounded text-primary border-0 bg-transparent"
                                               title="packages">
                                                <i class="fa fa-book"></i>
                                            </a>
                                        <td>
                                            <button type="submit"
                                                    class="p-0 text-md btn-rounded text-danger border-0 bg-transparent"
                                                    title="dissaprove"
                                                    onclick="updateStatus('rejected','{{$student->id}}')">
                                                <i class="fa fa-ban"></i>
                                            </button>
                                        </td>
                                    @elseif($student->state == 'new')
                                        <td></td>
                                        <td><span class="label warn" title="Suspended">{{$student->state}}</span></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="submit"
                                                    class="p-0 text-md btn-rounded text-success border-0 bg-transparent"
                                                    title="approve" onclick="updateStatus('current',{{$student->id}})">
                                                <a>
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </button>
                                        </td>
                                    @elseif($student->state == 'rejected')
                                        <td></td>
                                        <td><span class="label danger" title="Suspended">{{$student->state}}</span></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button type="submit"
                                                    class="p-0 text-md btn-rounded text-primary border-0 bg-transparent"
                                                    title="Undo the rejection"
                                                    onclick="updateStatus('current',{{$student->id}})">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </form>
                @else
                    <div class="container w-75">
                        <div class="text-center">
                            <img src="{{asset('images/defaults/no-data.png')}}" alt="" class="w-50">
                            @if(isset($status))
                                <p class="h4 text-primary">There is no {{$status}} students</p>
                            @elseif(isset($search))
                                <p class="h4 text-primary">There is no name such as "{{$search}}"</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- ############ PAGE END-->
    <script>
        function updateStatus(status, id) {
            document.getElementById("status").value = status;
            document.getElementById("ids").value = id;
        }
    </script>

@endsection
