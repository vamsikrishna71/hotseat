@extends('layouts.master')

@section('title')
    @lang('translation.Form_File_Upload')
@endsection

@section('css')
    <!-- Plugins css -->
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            All Desks
        @endslot
        @slot('title')
            Import CSV
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <a href="{{ url('employee.details') }}" class="btn btn-primary w-md mb-4">Back to Overview</a>
                    <h4 class="card-title">Upload a .csv file from your computer</h4>
                    <p class="card-title-desc">
                    <ul class="-ml-6 mt-8 mb-4 list-disc pl-10 text-left">
                        <li>Your CSV must list one record per row.</li>
                        <li>Required columns:</li>
                        <h4><code class="bg-carbon-5 text-carbon-50 py-2 px-4">Employee ID, Username ,First Name, Last
                                Name,E-mail,
                                Designation, Department,Password</code></h4>
                    </ul>
                    </p>
                    <form id="csvImport" action="{{ url('importEmployee') }}" class="form-horizontal needs-validation"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <input name="file" type="file" id="file" class="form-control-sm">
                        </div>
                        <div class="mt-3">
                            <div class="progress mb-3">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"
                                    role="progressbar"></div>
                            </div>
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <span class="text-danger">
                            @error('file')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="invalid-feedback">
                            Upload CSV.
                        </div>
                        <button class="btn btn-success w-md">Import</button>
                        <button class="btn btn-danger w-md" type="button" data-bs-toggle="modal"
                            data-bs-target="#stopImport"> Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade" id="stopImport" tabindex="-1" aria-labelledby="stopImport" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="d-inline delete-icon position-relative">
                        <div class="alert alert-danger text-center" role="alert">
                            Are you sure want Stop Import. Please Confirm!
                        </div>
                        <button class="btn btn-success w-md">
                            Yes
                        </button>
                        <button class="btn btn-danger w-md" type="button" data-bs-dismiss="modal" aria-label="Close">
                            No
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <!-- Plugins js -->
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script>
        $(function() {
            $(document).ready(function() {
                $('#csvImport').ajaxForm({
                    beforeSend: function() {
                        var per = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var per = percentComplete;
                        $('.progress .progress-bar').css("width", per + '%', function() {
                            return $(this).attr("aria-valuenow", per) + "%";
                        })
                    },
                    complete: function(xhr) {
                        console.log('File uploaded');
                    }
                });
            });
        });
    </script>
@endsection
