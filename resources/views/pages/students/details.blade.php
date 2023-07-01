@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="container padding w-50">
{{--        <div style="margin-left: 20%; margin-right: 20%">--}}
        <div class="box">
            <div class="text-center text-md m-b h-2x _800">
                <div class="item">
                    <div class="item-overlay active p-a">
                        <p class="pull-left text-u-c label label-md primary">{{$student->first_name .' '. $student->last_name}}</p>
                    </div>
                    <div class="item-overlay active p-a">
                        <p class="pull-right text-u-c label label-md primary">{{$student->subjects_count}}</p>
                    </div>
                </div>
            </div>
            <div class="box-divider m-0"></div>
            <ul class="list no-border">
                @if($student->subjects->isNotEmpty())
                    @foreach($student->subjects as $subject)
                        <li class="list-item">
                            <div class="pull-left">
                                <a class="pull-left m-r">
			                	<span class="w-40">
			                  		<img src="{{asset($subject->package->image)}}" class="w-full" alt="...">
			                 	</span>
                                </a>
                            </div>
                            <div class="clear">
                                <div class="pull-left">
                                    <a href class="_500 text-ellipsis">{{$subject->package->name}}</a>
                                    <small class="text-muted">{{$subject->name}}</small>
                                </div>
                                <div class="pull-right">
{{--                                    <form action="{{route('create.subject.selected')}}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="package_id" value="{{$subject->id}}">--}}
{{--                                        <button--}}
{{--                                            class="md-btn md-raised m-b-sm w-xs primary text-white">Details</button>--}}
{{--                                    </form>--}}
                                </div>
                            </div>

                        </li>
                    @endforeach
                @else

                    <div class="text-center">
                        <img src="{{asset('images/defaults/no-data.jpg')}}" alt=""  class="w-50">

                        <p class="h4">Student has never assigned to a subject</p>
                    </div>

                @endif
            </ul>
        </div></div>
    <!-- ############ PAGE END-->
@endsection
