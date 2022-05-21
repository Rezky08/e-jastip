@extends("layouts.user.template")
@section("main")
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <x-form.input type="hidden" name="university_id"/>
        <x-form.input type="hidden" name="name"/>
        <div class="d-flex flex-column" style="gap: 1rem">
            <x-wrapper.card>
                <span class="font-weight-bold text-lg">Alamat Universitas</span>
                <span class="font-weight-bold text-lg d-block">{{$user->university->name ?? ""}}</span>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-api.raja-ongkir.geo.province name="origin_province_id"/>
                    </x-wrapper.column>
                    <x-wrapper.column>
                        <x-api.raja-ongkir.geo.city name="origin_city_id" parentName="origin_province_id"/>
                    </x-wrapper.column>
                </x-wrapper.form>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-api.raja-ongkir.geo.district name="origin_district_id" parentName="origin_city_id"/>
                    </x-wrapper.column>
                    <x-wrapper.column>
                        <x-form.input name="origin_zip_code" label="Kode Pos" isGroup/>
                    </x-wrapper.column>
                </x-wrapper.form>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-form.text-area name="origin_address" label="Alamat Lengkap" placeholder="Masukan Alamat Lengkap"
                                          isGroup
                                          noResize/>
                    </x-wrapper.column>
                </x-wrapper.form>
            </x-wrapper.card>

            <x-wrapper.card>
                <span class="font-weight-bold text-lg">Alamat Tujuan</span>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-api.raja-ongkir.geo.province name="destination_province_id"/>
                    </x-wrapper.column>
                    <x-wrapper.column>
                        <x-api.raja-ongkir.geo.city name="destination_city_id" parentName="destination_province_id"/>
                    </x-wrapper.column>
                </x-wrapper.form>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-api.raja-ongkir.geo.district name="destination_district_id" parentName="destination_city_id"/>
                    </x-wrapper.column>
                    <x-wrapper.column>
                        <x-form.input name="destination_zip_code" label="Kode Pos" isGroup/>
                    </x-wrapper.column>
                </x-wrapper.form>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-form.text-area name="destination_address" label="Alamat Lengkap" placeholder="Masukan Alamat Lengkap"
                                          isGroup
                                          noResize/>
                    </x-wrapper.column>
                </x-wrapper.form>
            </x-wrapper.card>

            <x-wrapper.card>
                <span class="font-weight-bold text-lg">Kurir dan Dokumen</span>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-api.raja-ongkir.cost.select origin="origin_city_id" destination="destination_city_id" isGroup/>
                    </x-wrapper.column>
                </x-wrapper.form>
                <x-form.transaction-attachment/>
            </x-wrapper.card>

            <div class="py-3">
                <x-form.button isSubmit fullWidth>
                    Ajukan
                </x-form.button>
            </div>

        </div>
    </form>
@endsection
