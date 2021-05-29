@extends('layouts.app')
@section('page-title') Поиск @endsection

@section('content')
<div class="container-fluid mainbox gradient-bg">
    @include('components.header')
    @include('components.searchPage.itemListHeader')
    @include('components.searchPage.itemListContainer')
</div>
<script type="module">
    import {ready} from '/js/searchPage.js';
    document.addEventListener("DOMContentLoaded", ready);
</script>
@endsection