@extends("layouts.user.template")
@section("main")
    <form method="POST" enctype="multipart/form-data">

        @csrf
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-api.raja-ongkir.geo.province/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-api.raja-ongkir.geo.city/>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-api.raja-ongkir.geo.district/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.input name="kode_pos" label="Kode Pos" isGroup/>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.text-area name="alamat" label="Alamat Lengkap" placeholder="Masukan Alamat Lengkap" isGroup
                                  noResize/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-api.raja-ongkir.cost.select destination="kota" isGroup/>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.file name="file" label="Dokumen Legalisir" placeholder="Pilih Dokumen" isGroup noResize/>
            </x-wrapper.column>
            <x-wrapper.column>
            </x-wrapper.column>
        </x-wrapper.form>

        <x-form.button isSubmit>
            Ajukan
        </x-form.button>
    </form>
@endsection
