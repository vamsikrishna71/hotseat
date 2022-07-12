@extends('layouts.master')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/toastr/toastr.min.css') }}">
    <link href="{{ URL::asset('/css/custom.css') }}" id="custom-style" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Employee
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Employee
        @endslot
        @slot('title')
            Overview
        @endslot
    @endcomponent
    @if (Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::get('fail'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('fail') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title text-center text-primary mb-3 fs-3">Add Employees</h4>

                    <div class="row">
                        <div class="col-12 col-md-4 offset-md-4 text-start mb-3">
                            <ul class="mb-2">
                                <li>Add Employee OR</li>
                                <li>Click 'Import CSV' for Bulk Update</li>
                            </ul>
                        </div>
                        <div class="col-sm-12 offset-md-12 col-md-12 mb-3 text-center">
                            <a href="employee.create" class="btn btn-success waves-effect waves-light w-md" type="button">
                                Add Employee
                            </a>
                            <a href="drop-zone-employees" class="btn btn-info w-md" type="button">Import CSV</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('script')
    <!-- Required datatable js -->
    <!-- toastr plugin -->
    <script src="{{ URL::asset('/assets/libs/toastr/toastr.min.js') }}"></script>

    <!-- toastr init -->
    <script src="{{ URL::asset('/assets/js/pages/toastr.init.js') }}"></script>
@endsection
