@extends('layouts.dashboard')
@section('title', 'Sesi')
@section('content')
<x-page-title>
    <x-slot name="title">Sesi</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Sesi</li>
        <li class="breadcrumb-item active">List Sesi</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        @include('messages.alert')
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Sesi</h3>
                <p class="card-title-desc">List Sesi</p>
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