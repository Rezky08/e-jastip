@extends('layouts.sprinter.template')
@section("main")
    <form method="POST">
        @csrf
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.input name="name" label="Nama" isGroup/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.input name="phone" label="Nomor HP" placeholder="Masukan Nomor Hp" isGroup />
            </x-wrapper.column>
        </x-wrapper.form>
        <x-form.button isSubmit>
            Simpan
        </x-form.button>
    </form>
@endsection
