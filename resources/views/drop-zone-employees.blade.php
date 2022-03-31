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
                    <h4 class="card-title">Upload a .csv file from your computer</h4>
                    <p class="card-title-desc">
                    <ul class="-ml-6 mt-8 mb-4 list-disc pl-10 text-left">
                        <li>Your CSV must list one record per row.</li>
                        <li>Required columns:</li>
                        <h4><code class="bg-carbon-5 text-carbon-50 py-2 px-4">Employee ID,First Name, Last Name,
                                Designation, Department,Password</code></h4>
                    </ul>
                    </p>
                    <form action="{{ url('importEmployee') }}" class="form-horizontal" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input class="form-control-sm" type="file" name="file" />
                        <button class="btn btn-primary">Import File</button>
                    </form>
                </div> <!-- end col -->
            </div> <!-- end row -->
        @endsection
        @section('script')
            <!-- Plugins js -->
            <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
        @endsection
