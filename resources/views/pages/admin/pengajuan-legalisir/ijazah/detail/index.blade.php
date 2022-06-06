@extends("layouts.admin.template")
@section("main")
    <x-wrapper.card>
        <div class="p-3">
            @section("user-detail")
                <div>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <div class="d-flex justify-content-between">
                                <span class="font-weight-bold text-lg">Data User</span>
                                <div>
                                    <x-badges.transaction-status
                                        status="{{\App\Supports\FormSupport::getFormData('status')}}"/>
                                </div>
                            </div>
                        </x-wrapper.column>
                    </x-wrapper.form>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <x-form.display-text name="student_id" label="NIM" isGroup/>
                        </x-wrapper.column>
                        <x-wrapper.column>
                            <x-form.display-text name="name" label="Nama" isGroup/>
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
                </div>
            @show
            @section("origin-address")
                <div>
                    <hr/>
                    <div>
                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <span class="font-weight-bold text-lg">Alamat Universitas</span>
                            </x-wrapper.column>
                        </x-wrapper.form>
                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                            <span class="font-weight-bold text-lg">
                                <x-form.display-text name="university.name"/>
                            </span>
                            </x-wrapper.column>
                        </x-wrapper.form>
                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <x-form.display-text name="origin_province.province_name" label="Provinsi" isGroup/>
                            </x-wrapper.column>
                            <x-wrapper.column>
                                <x-form.display-text name="origin_city.city_name" label="Kota" isGroup/>
                            </x-wrapper.column>
                        </x-wrapper.form>
                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <x-form.display-text name="origin_district.district_name" label="Kecamatan" isGroup/>
                            </x-wrapper.column>
                            <x-wrapper.column>
                                <x-form.display-text name="origin_zip_code" label="Kode Pos" isGroup/>
                            </x-wrapper.column>
                        </x-wrapper.form>
                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <x-form.display-text name="origin_address" label="Alamat Lengkap" isGroup/>
                            </x-wrapper.column>
                        </x-wrapper.form>
                    </div>
                </div>
            @show
            @section("destination-address")
                <div>

                    <hr/>
                    <div>
                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <span class="font-weight-bold text-lg">Alamat Tujuan</span>
                            </x-wrapper.column>
                        </x-wrapper.form>

                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <x-form.display-text name="destination_province.province_name" label="Provinsi"
                                                     isGroup/>
                            </x-wrapper.column>
                            <x-wrapper.column>
                                <x-form.display-text name="destination_city.city_name" label="Kota" isGroup/>
                            </x-wrapper.column>
                        </x-wrapper.form>
                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <x-form.display-text name="destination_district.district_name" label="Kecamatan"
                                                     isGroup/>
                            </x-wrapper.column>
                            <x-wrapper.column>
                                <x-form.display-text name="destination_zip_code" label="Kode Pos" isGroup/>
                            </x-wrapper.column>
                        </x-wrapper.form>
                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <x-form.display-text name="destination_address" label="Alamat Lengkap" isGroup/>
                            </x-wrapper.column>
                        </x-wrapper.form>
                    </div>

                </div>
            @show
            @section("courier-document")
                <div>
                    <hr/>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <span class="font-weight-bold text-lg">Kurir dan Dokumen Legalisir</span>
                        </x-wrapper.column>
                    </x-wrapper.form>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <x-form.display-text name="partner_shipment" label="Kurir" isGroup/>
                        </x-wrapper.column>
                    </x-wrapper.form>
                    <div class="d-flex justify-content-center" style="gap:1rem">
                        @forelse(\App\Supports\FormSupport::getFormData('documents') as $document)
                            <div class="d-flex flex-column align-items-center">
                                <a target="_blank"
                                   href="{{route($isAdmin ? 'admin.attachment':'attachment',['attachment'=>$document['attachment_id']])}}">
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
                </div>
            @show
            @section("payment")
                @if(!empty(\App\Supports\FormSupport::getFormData('invoice')))
                    <div>
                        <hr/>
                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <span class="font-weight-bold text-lg">Pembayaran</span>
                            </x-wrapper.column>
                        </x-wrapper.form>

                        <x-wrapper.form isRow>
                            <x-wrapper.column>
                                <x-form.display-text name="status" label="Status Pembayaran" isGroup>
                                    <x-badges.invoice-payment-status
                                        status="{{\App\Supports\FormSupport::getFormData('invoice.status')}}"/>
                                </x-form.display-text>
                            </x-wrapper.column>
                            <x-wrapper.column>
                                <x-form.display-text name="total" label="Jumlah Pembayaran" isGroup>
                                    <x-display.display-currency
                                        amount="{{\App\Supports\FormSupport::getFormData('invoice.calculated.total')}}"/>
                                </x-form.display-text>
                            </x-wrapper.column>
                        </x-wrapper.form>
                        @if(!empty(\App\Supports\FormSupport::getFormData('invoice.account')))
                            <x-wrapper.form isRow>
                                <x-wrapper.column>
                                    <x-form.display-text name="account_name" label="Tujuan" isGroup>
                                        <x-display.payment-method
                                            :paymentMethod="\App\Supports\FormSupport::getFormData('invoice.account.payment_method')"/>
                                    </x-form.display-text>
                                </x-wrapper.column>
                                <x-wrapper.column>
                                    <x-form.display-text name="account_number" label="Rekening Tujuan" isGroup>
                                        <div class="d-flex flex-column">
                                            <span>{{\App\Supports\FormSupport::getFormData('invoice.account.name')}}</span>
                                            <span>{{\App\Supports\FormSupport::getFormData('invoice.account.account')}}</span>
                                        </div>
                                    </x-form.display-text>
                                </x-wrapper.column>
                            </x-wrapper.form>
                        @endif
                        @if(\App\Supports\FormSupport::getFormData('invoice.status') >= \App\Models\Transaction\Invoice\Invoice::INVOICE_STATUS_WAITING_CONFIRMATION)
                            <x-wrapper.form isRow>

                                <x-wrapper.column>
                                    <x-form.display-text name="invoice.attachment.holder_name" label="Atas Nama"
                                                         isGroup/>
                                </x-wrapper.column>
                                <x-wrapper.column>
                                    <x-form.display-text name="attachment" label="Bukti Pembayaran" isGroup>
                                        <x-wrapper.image name="invoice-image"
                                                         src="{{\App\Supports\FormSupport::getFormData('invoice.attachment_url')}}"/>
                                    </x-form.display-text>
                                </x-wrapper.column>
                            </x-wrapper.form>
                        @endif

                    </div>
                @endif
            @show
            @section("actions")
                <div class="d-flex flex-column" style="gap: 1rem">
                    @if(\App\Supports\FormSupport::getFormData('invoice.status') === \App\Models\Transaction\Invoice\Invoice::INVOICE_STATUS_WAITING_CONFIRMATION)
                        <x-form.button :isSubmit="false" fullWidth data-toggle="modal"
                                       data-target="#paymentConfirmation">
                            {{__('messages.invoice.payment.confirmation.title')}}
                        </x-form.button>
                        <x-wrapper.modal name="paymentConfirmation"
                                         title="{{__('messages.invoice.payment.confirmation.title')}}">
                            {!!__('messages.invoice.payment.confirmation',['invoice'=>\App\Supports\FormSupport::getFormData('invoice.id')])!!}

                            <x-slot name="footer">
                                <form method="POST"
                                      action="{{route('admin.invoice.payment.confirmation',['invoice'=>\App\Supports\FormSupport::getFormData('invoice.id')])}}">
                                    @csrf
                                    <x-form.button :isSubmit="false" data-dismiss="modal"
                                                   type="{{\App\View\Components\Form\Button::TYPE_DANGER}}" outline>
                                        {{__('messages.form.submit.cancel')}}
                                    </x-form.button>
                                    <x-form.button :isSubmit="true">
                                        {{__('messages.form.submit.confirm')}}
                                    </x-form.button>
                                </form>
                            </x-slot>
                        </x-wrapper.modal>
                    @endif
                </div>
            @show
        </div>


    </x-wrapper.card>
@endsection
