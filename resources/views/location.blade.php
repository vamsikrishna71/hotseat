@extends('layouts.master')

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/libs/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}" type="text/css" />
@endsection

@section('title') Location @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Location @endslot
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

                    <h4 class="card-title">All Location</h4>

                    <div class="row">
                        <div class="col-sm-12 offset-md-12 col-md-12 mb-3 text-end">
                            <a href="{{ url('addlocation') }}">
                                <button type="button" class="btn btn-success waves-effect waves-light">
                                    <i class="fas fa-plus px-1"></i> Add New Location
                                </button>
                            </a>
                        </div>
                    </div>

                    <x-table>
                        <x-slot name="header">
                            <tr>
                                <x-table-column>S.NO</x-table-column>
                                <x-table-column>City</x-table-column>
                                <x-table-column>Area</x-table-column>
                                <x-table-column>Building Name</x-table-column>
                                <x-table-column>Level</x-table-column>
                                <x-table-column>Time Zone</x-table-column>
                                <x-table-column>Actions</x-table-column>
                            </tr>
                        </x-slot>

                        @forelse ($locations as $centre)
                            <tr class="font-bold" id="tr_{{ Auth::user()->id }}">
                                <x-table-column>{{ $loop->iteration }}</x-table-column>
                                <x-table-column>{{ $centre->city }}</x-table-column>
                                <x-table-column>{{ $centre->country }}</x-table-column>
                                @forelse ($centre->zone as $zone)
                                    @forelse (explode(',', $zone->building_name) as $building)
                                        <x-table-column>
                                            <option>{{ $building }}</option>
                                        </x-table-column>
                                        @empty
                                        <div class="alert alert-warning" role="alert">
                                    No buildings Found!
                                        </div>
                                    @endforelse
                                    @forelse (explode(',', $zone->level) as $level)
                                        <x-table-column>
                                            {{ $level }}
                                        </x-table-column>
                                        @empty
                                        <div class="alert alert-warning" role="alert">
                                    No Levels found!
                                        </div>
                                    @endforelse
                                    @empty
                                    <div class="alert alert-warning" role="alert">
                                    No zones found !
                                    </div>
                                @endforelse
                                <x-table-column>{{ $centre->timezone }}</x-table-column>
                                <x-table-column>
                                    <div class="table-action">
                                    <a href="{{ route('location.edit', ['location_id' => $centre->id]) }}" class="text-dark fs-3">
                                            <i class="fas fa-edit"></i>
                                    </a>
                                    
                                        <form class="d-inline delete-icon position-relative" action="{{ route(
                                            'location.destroy',['location_id' => $centre->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            
                                            {{--  <input type="submit" id="showtoast" class="btn btn-danger"value="Delete">  --}}
                                            
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
