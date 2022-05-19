@extends("layouts.admin.template")
@section("main")
    <x-wrapper.card>
        <div class="p-3">
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <span class="font-weight-bold text-lg">Data User</span>
                </x-wrapper.column>
            </x-wrapper.form>
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <x-form.display-text name="user.detail.student_id" label="NIM" isGroup/>
                </x-wrapper.column>
                <x-wrapper.column>
                    <x-form.display-text name="user.detail.name" label="Nama" isGroup/>
                </x-wrapper.column>
            </x-wrapper.form>
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <x-form.display-text name="faculty.name" label="Fakultas" isGroup/>
                </x-wrapper.column>
                <x-wrapper.column>
                    <x-form.display-text name="study_program.name" label="Jurusan" isGroup/>
                </x-wrapper.column>
            </x-wrapper.form>
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <x-form.display-text name="user.detail.phone" label="Nomor HP" isGroup/>
                </x-wrapper.column>
                <x-wrapper.column>
                </x-wrapper.column>
            </x-wrapper.form>

            <hr/>
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <span class="font-weight-bold text-lg">Data Pengiriman</span>
                </x-wrapper.column>
            </x-wrapper.form>
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <x-form.display-text name="province.province_name" label="Provinsi" isGroup/>
                </x-wrapper.column>
                <x-wrapper.column>
                    <x-form.display-text name="city.city_name" label="Kota" isGroup/>
                </x-wrapper.column>
            </x-wrapper.form>
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <x-form.display-text name="district.district_name" label="Kecamatan" isGroup/>
                </x-wrapper.column>
                <x-wrapper.column>
                    <x-form.display-text name="zip_code" label="Kode Pos" isGroup/>
                </x-wrapper.column>
            </x-wrapper.form>
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <x-form.display-text name="address" label="Alamat Lengkap" isGroup/>
                </x-wrapper.column>
                <x-wrapper.column>
                    <x-form.display-text name="partner_shipment" label="Kurir" isGroup/>
                </x-wrapper.column>
            </x-wrapper.form>
        </div>

        <hr/>
        <x-wrapper.form isRow>
            <x-wrapper.column>
                <span class="font-weight-bold text-lg">Dokumen Legalisir</span>
            </x-wrapper.column>
        </x-wrapper.form>
        <div class="d-flex justify-content-center" style="gap:1rem">
            @forelse(\App\Supports\FormSupport::getFormData('documents') as $document)
                <div class="d-flex flex-column align-items-center">
                    <a target="_blank" href="{{route('admin.attachment',['attachment'=>$document['attachment_id']])}}">
                        <x-form.button id="download"
                                       circle
                                       type="{{\App\View\Components\Form\Button::TYPE_INFO}}"
                                       size="{{\App\View\Components\Form\Button::SIZE_SMALL}}"
                                       data-toggle="tooltip"
                                       title="Unduh Dokumen"
                        >
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </x-form.button>
                    </a>
                    <span>{{$document['name']}}</span>
                </div>
            @empty
            @endforelse
        </div>
    </x-wrapper.card>
@endsection
