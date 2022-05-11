@extends("layouts.user.template")
@section("main")
    @php
        $columns = [
        'Token' => 'token',
        'NIM' => 'user_id',
        'Nama' => 'user_id',
        'Fakultas' => 'user_id',
        'Program Studi' => 'user_id',
        'Aksi' => 'user_id',
    ];
    @endphp
    <x-wrapper.table :columns="$columns"/>
@endsection
