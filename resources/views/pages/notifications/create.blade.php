@extends('layouts.master')
@section('content')
    <!-- ############ PAGE START-->
    <div class="container padding">
        <div style="margin-left: 20%; margin-right: 20%">
            <div class="box">
                <div class="box-header text-primary text-xl">
                    <h1>Send notification</h1>
                </div>

                <div class="box-divider"></div>
                <form role="form" method="POST" action="{{ route('notification.store') }}" class="container mt-2">
                    @csrf
                    @if ($search)
                        <div class="form-group">
                            <div><label for="user_id">Choose student</label></div>
                            <select name='student_ids[]' multiple="" class="ui search selection dropdown">
                                <option value=""> Select Multiple students </option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_ids')
                                {{ $message }}
                            @enderror
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" placeholder="Enter notification title" id="title"
                            id="title" name="title" value="{{ old('title') }}" required>
                        <div class="text-danger">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Content</label>
                        <input type="text" class="form-control" placeholder="Enter notification content" id="description"
                            id="description" name="description" value="{{ old('description') }}" required>
                        <div class="text-danger">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="time_publish">Publish Time</label>
                            <div id="time_publish" class='input-group date' ui-jp="datetimepicker"
                                ui-options="{ 
                                    defaultDate: '{{ old('time_publish', Carbon\Carbon::now()) }}'  
                                }">
                                <input type='text' class="form-control" name="time_publish" id="time_publish" required />
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                            <div class="text-danger">
                                @error('time_publish')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>



                    <button type="submit" class="btn white m-b m-t primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".datetimepicker").each(function() {
            $(this).datetimepicker();
        });
    </script>

    <script>
        $('.ui.dropdown').dropdown();
    </script>
    @push('css')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
    @endpush

    @push('js')
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js"></script>
        <!-- datetimepicker jQuery CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
        </script>
    @endpush
    <!-- ############ PAGE END-->
@endsection
