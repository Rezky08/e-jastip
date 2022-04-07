@extends("layouts.user.template")
@section("main")
    <form>
        @csrf
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.select name="provinsi" label="Provinsi" isGroup />
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.select name="kota" label="Kota" isGroup />
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.select name="kecamatan" label="Kecamatan" isGroup />
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.select name="kode_pos" label="Kode Pos" isGroup />
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.text-area name="alamat" label="Alamat Lengkap" placeholder="Masukan Alamat Lengkap" isGroup noResize/>
            </x-wrapper.column>
            <x-wrapper.column>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.file name="file" label="Dokumen Legalisir" placeholder="Pilih Dokumen" isGroup noResize/>
            </x-wrapper.column>
            <x-wrapper.column>
            </x-wrapper.column>
        </x-wrapper.form>

        <x-form.button>
            Ajukan
        </x-form.button>
    </form>
@endsection
@push("stack-script")
    <script>
        API.get(window.location.pathname).then((data)=>{
            console.log(data)
        })
    </script>
@endpush
