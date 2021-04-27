@extends('layouts.app')
@section('page-title') Поиск @endsection

@section('content')
<div class="container-fluid mainbox gradient-bg">
    @include('components.header')
    @include('components.searchPage.itemListHeader')
    @include('components.searchPage.itemListContainer')
</div>
<script src="/js/search.js" type="module"></script>
@endsection