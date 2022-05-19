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
                <x-form.input name="zip_code" label="Kode Pos" isGroup/>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <x-form.text-area name="address" label="Alamat Lengkap" placeholder="Masukan Alamat Lengkap" isGroup
                                  noResize/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-api.raja-ongkir.cost.select destination="city_id" isGroup/>
            </x-wrapper.column>
        </x-wrapper.form>
        <x-form.transaction-attachment/>

        <div class="py-3">
            <x-form.button isSubmit fullWidth>
                Ajukan
            </x-form.button>
        </div>

    </form>
@endsection
