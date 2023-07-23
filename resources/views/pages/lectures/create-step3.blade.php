@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2">
            <div class="wrapper-progressBar">
                <ul class="progressBar">
                    <li><a href="{{ route('lectures.create') }}" title="change package"
                            class="md-btn md-raised m-b-sm w-sm primary text-white r-15"><i
                                class="fas fa-long-arrow-left"></i> {{ $package_name }}</a> </li>
                    <li><a href="{{ route('lectures.create.step2', ['package_name' => $package_name, 'package_id' => $package_id]) }}"
                            title="change subject" class="md-btn md-raised m-b-sm w-sm primary text-white r-15"><i
                                class="fas fa-long-arrow-left"></i> {{ $subject_name }}</a> </li>
                    <li class="active text-primary">Create lecture</li>
                </ul>
            </div>
        </div>
    </div>
    <style>
        .hidden {
            display: none;
        }
    </style>
    <div class="padding">
        <div style="margin-left: 20%; margin-right: 20%">
            <div class="box">
                <div class="box-header">
                    <h2>Add new lecture</h2>
                </div>
                <div class="box-divider m-0"></div>
                <div class="box-body">
                    <form id="myForm" method="POST" action="{{ route('lectures.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ old('week_program_id', $week_program_id) }}" name="week_program_id">
                        <input type="hidden" value="{{ old('subject_id', $subject_id) }}" name="subject_id">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter name"
                                name="name" value="{{ old('name') }}" required>
                            <div class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="duration">Duration - by minutes</label>
                            <input type="number" class="form-control" name="duration" value="{{ old('duration') }}"
                                required>
                            <div class="text-danger">
                                @error('duration')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="video_link">Video link</label>
                            <input type="url" class="form-control" placeholder="Enter video link" name="video_link"
                                value="{{ old('video_link') }}" required>
                            <div class="text-danger">
                                @error('video_link')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pdf_files">Pdf file (hold ctrl key - choose many files )</label>
                            <input type="file" multiple class="form-control" placeholder="Upload pdf file" id="pdf_files"
                                name="pdf_files[]" value="{{ old('pdf_files') }}" accept=".pdf">
                            <div class="text-danger">
                                @error('pdf_files')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        {{-- <div id="extraInput" class="form-group hidden">
                            <label for="exampleInputEmail1">Pdf file Name</label>
                            <input type="text" class="form-control" placeholder="Enter pdf file name" id="pdf_file_name" name="pdf_file_name">
                        </div> --}}

                        <div class="form-group">
                            <label for="date">Date - <span class="text-primary">Only {{ $allowedDayName }}</span> </label>
                            <div id="date" class='input-group date' ui-jp="datetimepicker"
                                ui-options="{ 
                                        daysOfWeekDisabled: {{ $denyDays }},
                                        format: 'D-M-YYYY',
                                        allowInputToggle: true 
                                    }"
                                    >
                                <input type='text' class="form-control" name="date" value="{{ old('date') }}" required />
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>

                            <div class="text-danger">
                                @error('date')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class='text-center'><button type="submit"
                                class="md-btn md-raised m-b-sm w-lg primary text-white r-15">Save Lecture</button></div>
                    </form>
                </div>
            </div>
        </div>


        @push('css')
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
        @endpush

        @push('js')
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <!-- datetimepicker jQuery CDN -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
            </script>
 <script type="text/javascript">
    $(".datetimepicker").each(function() {
        $(this).datetimepicker();
    });
</script>
            <script>
                document.getElementById('myForm').addEventListener('submit', function(event) {
                    var fileInput = document.getElementById('pdf_file');
                    var file = fileInput.files[0];

                    if (file && file.type !== 'application/pdf') {
                        event.preventDefault(); // Prevent form submission
                        document.getElementById('pdfFileError').style.display = 'block';
                    }
                });

                document.getElementById("pdf_file").addEventListener("change", function() {
                    // Get the file input element and check if a file is selected
                    var fileInput = document.getElementById("pdf_file");
                    if (fileInput.files.length > 0) {
                        // Show the extra input field
                        document.getElementById("extraInput").classList.remove("hidden");
                        document.getElementById("pdf_file_name").setAttribute('required', 'required');
                    } else {
                        // Hide the extra input field
                        document.getElementById("extraInput").classList.add("hidden");
                    }
                });
            </script>
        @endpush
        <!-- ############ PAGE END-->
    @endsection
