@extends('layouts.master')

@section('title') @lang('Add Employee') @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Users @endslot
        @slot('title') Add Users @endslot
    @endcomponent
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}">
    </script>
@endsection
