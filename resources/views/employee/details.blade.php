@extends('layouts.master')

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/toastr/toastr.min.css') }}">
    <link href="{{ URL::asset('/css/custom.css') }}" id="custom-style" rel="stylesheet" type="text/css" />
@endsection

@section('title') Employee @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Employee @endslot
        @slot('title') Overview @endslot
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

                    <h4 class="card-title">All Employees</h4>

                    <div class="row">
                        <div class="col-sm-12 offset-md-12 col-md-12 mb-3 text-end">
                            <a href="employee.create">
                                <button type="button" class="btn btn-success waves-effect waves-light">
                                    <i class="fas fa-plus px-1"></i> Add New Employee
                                </button>
                            </a>
                        </div>
                    </div>

                    <x-table>
                        <x-slot name="header">
                            <tr>
                                <x-table-column>S.NO</x-table-column>
                                <x-table-column>Username</x-table-column>
                                <x-table-column>Last Name</x-table-column>
                                <x-table-column>Designation</x-table-column>
                                <x-table-column>Department</x-table-column>
                                <x-table-column>Actions</x-table-column>
                            </tr>
                        </x-slot>

                        @forelse ($employees as $employee)
                            <tr class="font-bold" id="tr_{{ Auth::user()->id }}">
                                <x-table-column>{{ $loop->iteration }}</x-table-column>
                                <x-table-column>{{ $employee->username }}</x-table-column>
                                <x-table-column>{{ $employee->last_name }}</x-table-column>
                                <x-table-column>{{ $employee->designation }}</x-table-column>
                                <x-table-column>{{ $employee->department }}</x-table-column>
                                <x-table-column>
                                    <div class="table-action">
                                    <a href="{{ route('employee.edit', ['id' => $employee->id]) }}" class="text-dark fs-3">
                                            <i class="fas fa-edit"></i>
                                    </a>
                                        <form class="d-inline delete-icon position-relative" action="{{ route(
                                            'employee.destroy',['id' => $employee->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <input type="submit" role="button" aria-label="delete employee" value="">
                                            <i class="fas fa-trash text-danger fs-3"></i>
                                        </form>
                                    </div>
                                </x-table-column>
                            </tr>
                            @empty
                            <div class="alert alert-warning" role="alert">
                                    No records Found!
                            </div>
                        @endforelse
                    </x-table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ URL::asset('/assets/js/pages/datatables.init.js') }}"></script>
<!-- toastr plugin -->
<script src="{{ URL::asset('/assets/libs/toastr/toastr.min.js') }}"></script>

<!-- toastr init -->
<script src="{{ URL::asset('/assets/js/pages/toastr.init.js') }}"></script>
@endsection
