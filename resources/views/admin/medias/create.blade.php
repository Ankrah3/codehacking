@extends('layouts.admin')


@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">

@stop


@section('content')

    <h1>Upload Media</h1>

    <form action="{{ route('admin.medias.store') }}" method="POST" class="dropzone">
        @csrf
        

        

    </form>

@stop


@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

@stop