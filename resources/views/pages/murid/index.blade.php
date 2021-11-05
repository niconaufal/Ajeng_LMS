@extends('layouts.dashboard')
@section('title', 'Murid')
@section('content')
<x-page-title>
    <x-slot name="title">Murid</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Murid</li>
        <li class="breadcrumb-item active">List Murid</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Murid</h3>
                <p class="card-title-desc">List murid</p>
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