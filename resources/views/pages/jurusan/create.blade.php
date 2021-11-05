@extends('layouts.dashboard')
@section('title', 'Tambah jurusan')
@section('content')
<x-page-title>
    <x-slot name="title">Jurusan</x-slot>
    <x-slot name="item">
        <li class="breadcrumb-item">Jurusan</li>
        <li class="breadcrumb-item active">Tambah Jurusan</li>
    </x-slot>
</x-page-title>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Tambah Data Jurusan</h3>
                <p class="card-title-desc">Isi form dibawah untuk menambahkan</p>
                {!! Form::open(['route' => 'jurusan.store', 'id' => 'createForm', 'class' => 'outer-repeater']) !!}
                @csrf
                <div class="form-group">
                    <label for="nama">Kode Jurusan</label>
                    {!! Form::text('kode_jurusan', null, ['class' => 'form-control', 'placeholder' => 'Kode jurusan', 'required']) !!}
                </div>
                <div class="form-group">
                    <label for="nama">Nama Jurusan</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama jurusan', 'required']) !!}
                </div>
                <br>
                <h3 class="card-title">Pilih Mata Pelajaran</h3>
                <p class="card-title-desc">Pilih mata pelajaran untuk jurusan baru ini</p>

                <div class="table-responsive">
                    <table class="table" id="matapelajaran">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matapelajaran as $m)
                                <tr>
                                    <td style="width: 50px;">{!! Form::checkbox('matapelajaran[]', $m->id, false) !!}</td>
                                    <td>{{ $m->nama }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-2">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#matapelajaran').DataTable({
                columnDefs: [
                    { orderable: true, targets: 1 },
                    { orderable: false, targets: 0 }
                ]
            });
        });

        let form = $('#createForm');

        form.validate({
            errorPlacement: function errorPlacement(error, element) { element.before(error); }
        })
    </script>
@endpush