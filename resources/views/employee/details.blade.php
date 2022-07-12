@extends('layouts.master')

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    {{-- {{ dd($employees->username) }} --}}
    @if ($employees->isEmpty())
        @include('employee.empty')
    @else
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">All Employees</h4>

                        <div class="row">
                            <div class="col-sm-12 offset-md-12 col-md-12 text-end mb-3">
                                <a href="employee.create">
                                    <button type="button" class="btn btn-success waves-effect waves-light w-md">
                                        <i class="fas fa-plus px-1"></i> Add New Employee
                                    </button>
                                </a>
                                <a href="drop-zone-employees" class="btn btn-info w-md" type="button">Import CSV</a>

                                <span data-href="{{ route('employee') }}" id="export"
                                    class="btn btn-primary w-md">Export</span>
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
                                            <a href="{{ route('employee.edit', ['id' => $employee->id]) }}"
                                                class="text-dark fs-3">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn delete-employee" type="button"
                                                data-id="{{ $employee->id }}" data-bs-toggle="modal"
                                                data-bs-target="#deleteItem">
                                                <i class="fas fa-trash text-danger fs-3"></i>
                                            </button>
                                            {{-- <form class="d-inline delete-icon position-relative"
                                                action="{{ route('employee.destroy', ['id' => $employee->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')

                                                <input type="submit" role="button" aria-label="delete employee" value="">
                                                <i class="fas fa-trash text-danger fs-3"></i>
                                            </form> --}}
                                        </div>
                                    </x-table-column>
                                </tr>
                            @empty
                                <div class="alert alert-warning" role="alert">
                                    No records Found!
                                </div>
                            @endforelse
                        </x-table>
    @endif

    </div>
    </div>
    </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="deleteItem" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="alert alert-danger text-center" role="alert">
                        Are you sure you want to delete the Employee?
                    </div>
                    @foreach ($employees as $employee)
                        <form id="deleteEmployee" action="{{ route('employee.destroy', ['id' => $employee->id]) }}"
                            method="post">
                    @endforeach
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="employeeId" value="">
                    <div class="d-inline delete-icon position-relative">
                        <button class="btn btn-success w-md" type="button" data-bs-dismiss="modal" aria-label="Close">
                            No
                        </button>
                        <button type=submit class="btn btn-danger w-md">
                            Yes
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
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
    <!-- Employee js -->
    {{-- <script src="{{ URL::asset('/assets/js/pages/employee.js') }}"></script> --}}
    <script>
        $('#export').on('click', () => exportTasks(event.target));

        function exportTasks(_this) {
            let _url = $(_this).data('href');
            window.location.href = _url;
        }

        $("#deleteItem").on("show.bs.modal", function(event) {
            $('#deleteItem input[name="employeeId"]').val(
                $(event.relatedTarget).data("id")
            );
        });
    </script>
@endsection
