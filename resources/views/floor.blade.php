@extends('layouts.master')

@section('title') Add Desk @endsection
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/toastr/toastr.min.css') }}">
<link href="{{ URL::asset('/css/custom.css') }}" id="custom-style" rel="stylesheet" type="text/css" />
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Desk Reservation System @endslot
        @slot('title') Dashbaord @endslot
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
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Setup Desks</h4>
                <hr>
                <p class="mb-0">Create a floor to get started or Import CSV</p>
            </div>
        </div>
        {{-- <div class="col-12">
            <button class="btn btn-success btn-lg" type="button" data-bs-toggle="modal" data-bs-target="#createFloor">Create
                Floor</button>
            <a href="drop-zone" class="btn btn-primary btn-lg" type="button">Import CSV</a>
        </div> --}}
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createFloor" tabindex="-1" aria-labelledby="createFloor" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Floor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('createFloor') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="floorName" class="form-label">Floor Name <span
                                    style="color:red">*</span></label>
                            <input type="text" class="form-control @error('floorName') is-invalid @enderror" id="floorName"
                                value="Floor 4" name="floorName" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="floorMap" class="form-label">Floor Map <span style="color:red">*</span></label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('floorMap') is-invalid @enderror"
                                    id="floorMap" name="floorMap" autofocus required>
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3 align-items-center">
                        {{-- <div class="col-sm-12 offset-md-12 col-md-12 mb-3 text-end"> --}}
                        <div class="col-sm-12 col-md-6 text-start">
                            <h4 class="card-title">All Desks</h4>
                        </div>
                        <div class="col-sm-12 col-md-6 text-end">
                            <button class="btn btn-success btn-lg" type="button" data-bs-toggle="modal"
                                data-bs-target="#createFloor">
                                <i class="fas fa-plus px-1"></i>
                                Create
                                Floor</button>
                            <a href="drop-zone" class="btn btn-primary btn-lg" type="button">Import CSV</a>
                        </div>
                    </div>
                    <x-table>
                        <x-slot name="header">
                            <tr>
                                <x-table-column>S.NO</x-table-column>
                                <x-table-column>Floor Name</x-table-column>
                                <x-table-column>Floor map</x-table-column>
                                <x-table-column>Actions</x-table-column>
                            </tr>
                        </x-slot>

                        @forelse ($floors as $floor)
                            <tr class="font-bold" id="tr_{{ Auth::user()->id }}">
                                <x-table-column>{{ $loop->iteration }}</x-table-column>
                                <x-table-column>{{ $floor->floor_name }}</x-table-column>
                                <x-table-column id="td_{{ Auth::user()->id }}">
                                    <img class="desk-overview-img"
                                        src="{{ isset(Auth::user()->id) ? asset($floor->floor_map) : asset('/assets/images/users/avatar-1.jpg') }}"
                                        alt="" />
                                </x-table-column>
                                <x-table-column>
                                    <div class="table-action">
                                        <a href="{{ route('floor.edit', ['id' => $floor->id]) }}" class="text-dark fs-3">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form
                                            class="d-inline delete-icon
                                            position-relative mb-0"
                                            action="" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <input type="submit" role="button" aria-label="delete location" value="">
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
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}">
    </script>
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
