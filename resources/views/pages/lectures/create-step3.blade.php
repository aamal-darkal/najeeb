@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2">
            <div class="wrapper-progressBar">
                <ul class="progressBar">
                    <li class="active text-primary">{{$package_name}}</li>
                    <li class="active text-primary">{{$subject_name}}</li>
                    <li>Create lecture</li>
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
                    <form id="myForm" method="POST" action="{{ route('store.lecture')}}" enctype="multipart/form-data" >
                        @csrf                        
                        <input type="hidden" value="{{$week_program_id}}" name="week_program_id">
                        <input type="hidden" value="{{$subject_id}}" name="subject_id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label >Duration - by minutes</label>
                            <input type="number" class="form-control" name="duration" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Video link</label>
                            <input type="text" class="form-control" placeholder="Enter video link" name="video_link" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pdf file</label>
                            <input type="file" class="form-control" placeholder="Upload pdf file" id="pdf_file" name="pdf_file">
                            <div id="pdfFileError" class="alert alert-danger" style="display: none">File type should be PDF</div>
                        </div>
                        <div id="extraInput" class="form-group hidden">
                            <label for="exampleInputEmail1">Pdf file Name</label>
                            <input type="text" class="form-control" placeholder="Enter pdf file name" id="pdf_file_name" name="pdf_file_name">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <div id='datetimepicker8'>
                                <input type='date' class="form-control" name="date" required>

                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker8').datetimepicker({
                                            icons: {
                                                time: "fa fa-clock-o",
                                                date: "fa fa-calendar",
                                                up: "fa fa-arrow-up",
                                                down: "fa fa-arrow-down"
                                            }
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                        <button type="submit" class="btn white m-b">Submit</button>
                    </form>
                </div>
            </div>
        </div>

@push('js')
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
