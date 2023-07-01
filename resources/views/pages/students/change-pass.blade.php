@extends('layouts.master')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />

    @endpush
    <!-- ############ PAGE START-->
    <div class="padding">
        <div style="margin-left: 20%; margin-right: 20%">
            <div class="box">
                <div class="box-header">
                    <h2>Send notification to student</h2>
                </div>

                <div class="box-divider m-0"></div>

                <div class="box-body">

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('update.password') }}" >
                        @csrf
                        <div class="form-group">
                            <label>Choose student</label>

                            <select class="searchable-dropdown" name="user_id" style="width: 100%"></select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input type="text" class="form-control"
                                   placeholder="Enter notification title" name="password" required>
                        </div>

                        <button type="submit" class="btn white m-b">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        @push('js')
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('.searchable-dropdown').select2({
                        placeholder: 'Search for an item',
                        ajax: {
                            url: '{{ route("fetch.data") }}',
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {
                                return {
                                    searchTerm: params.term // Pass the search term as 'searchTerm'
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: $.map(data, function(item) {
                                        return {
                                            id: item.id,
                                            text: item.user_name
                                        };
                                    })
                                };
                            },
                            cache: true
                        }
                    });
                });
            </script>
    @endpush
    <!-- ############ PAGE END-->


@endsection
