@extends('layout.nav')
@section('content')
@include('layout.card')
<div class="d-flex justify-content-center mt-4">
    {{$stocks->links()}}
</div>
@endsection