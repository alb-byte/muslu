@extends('layouts.app')
@section('page-title') Главная @endsection

@section('content')
<div class="container-fluid mainbox gradient-bg">
    @include('components.header')
    @include('components.homePage.buttonPanel')
    @include('components.homePage.slider')
</div>
<script type="module">
    import {ready} from '/js/homePage.js';
    document.addEventListener("DOMContentLoaded", ready);
</script>
@endsection