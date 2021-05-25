@extends('layouts.app')
@section('page-title') Администратор @endsection

@section('content')
<div class="container-fluid mainbox gradient-bg ">
    @include('components.header')
    @include('components.adminPage.buttonPanel')

    <div class="row align-items-center h-75">
        <div class="col-12">
            <div class="row">
                <div id="itemList" class="text-center col-6 offset-3 searchItemList">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="module">
    import {ready} from '/js/adminPage.js';
    document.addEventListener("DOMContentLoaded", ready);
</script>
@endsection