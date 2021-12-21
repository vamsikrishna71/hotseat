@extends('layouts.employee-master')

@section('title') @lang('Add Employee') @endsection
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Users @endslot
        @slot('title') User Profile @endslot
    @endcomponent
    
    <div class="">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Success!</h4>
                        <p>Aww yeah <strong>{{ Auth::user()->username }}</strong>, you successfully read this important alert message ..</p>
                        <hr>
                        <p class="mb-0">Whenever you need to <strong>{{ Auth::user()->username }}</strong>, be sure to use margin utilities to keep things nice and tidy.</p>
                    </div>
                </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}">
    </script>
@endsection
