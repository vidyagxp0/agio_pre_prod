{{-- @extends('frontend.layout.main') --}}
@section('container')

@php
    // Check if $id is a string and then split it into an array
    $ids = is_string($id) ? explode(',', $id) : [];
@endphp

@foreach ($ids as $singleId)
    <iframe id="theFrame" width="100%" height="800" src="{{ url('documents/viewpdf/' . trim($singleId)) }}#toolbar=0"></iframe>
@endforeach

