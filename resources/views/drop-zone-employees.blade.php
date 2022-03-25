@extends('layouts.master')

@section('title') @lang('translation.Form_File_Upload') @endsection

@section('css')
    <!-- Plugins css -->
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') All Desks @endslot
        @slot('title') Import CSV @endslot
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
                    <ul class="text-left -ml-6 mt-8 mb-4 list-disc pl-10">
                        <li>Your CSV must list one record per row.</li>
                        <li>Required columns:</li>
                        <h4><code class="bg-carbon-5 text-carbon-50 py-2 px-4">Employee ID,First Name, Last Name, Designation, Department,Password</code></h4>
                    </ul>
                    </p>

                    {{-- <div>
                        <form action="{{ URL::to('excelImport') }}"  method="post" class="dropzone" enctype="multipart/form-data">
                            @csrf --}}
                            
                            {{-- <div class="form-group">
                                <input name="file" type="file"/>
                            </div> --}}
                            {{-- <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                </div>
                                <h4>Drop files here or click to upload.</h4>
                                <code class="bg-carbon-5 text-carbon-50 py-2 px-4">Employee ID,First Name, Last Name, Designation, Department,Password</code>
                            </div>
                        </form>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Import</button>
                    </div>
                </div>
            </div> --}}
            <form  action="{{ url('importEmployee') }}" class="form-horizontal" method="post" enctype="multipart/form-data">  
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
