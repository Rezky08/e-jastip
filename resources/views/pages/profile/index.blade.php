@extends("layouts.user.template")
@section("main")
    <form>
        @csrf
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.input name="nim" label="NIM" isGroup/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.input name="nama" label="Nama" isGroup/>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.select name="fakultas" label="Fakultas" isGroup />
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.select name="jurusan" label="Jurusan" isGroup />
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.input name="nomor_hp" label="Nomor HP" isGroup/>
            </x-wrapper.column>
            <x-wrapper.column>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-form.button>
            Simpan
        </x-form.button>
    </form>
@endsection
