@extends('adminlte::page')
@section('title','Dashboard')
@section('content_header')
<!-- <h1></h1> -->
@endsection
@section('content')
<x-calendario/>
<x-footer/>
@endsection
@push('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

@endpush