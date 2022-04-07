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
    </form>
@endsection
