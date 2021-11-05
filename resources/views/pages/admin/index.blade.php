@extends('layouts.dashboard')
@section('title', 'Admin')
@section('content')
<x-page-title>
    <x-slot name="title">Admin</A></x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item active">List Admin</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Admin</h3>
                <p class="card-title-desc">List admin</p>
                <div class="table-responsive"> 
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>
<x-delete-modal></x-delete-modal>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    {{ $dataTable->scripts() }}
@endpush