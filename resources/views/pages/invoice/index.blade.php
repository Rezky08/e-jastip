@extends("layouts.user.template")
@section("main")
    <form method="POST">
        @csrf
        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
        <div class="d-flex justify-content-center row">
            <div class="col-md-6 col-12">
                <x-wrapper.card>
                    <h3>
                        Detail Biaya
                    </h3>
                    <hr/>
                    {{-- Detail Biaya yang harus dibayar--}}
                    @forelse($invoiceDetails['items'] as $item)
                        @php
                        /** @var \App\Models\Transaction\Invoice\Detail $item */
                        @endphp
                        <x-invoice.price-item name="{{$item->name}}" :price="$item->price"/>
                    @empty
                    @endforelse
                    {{-- Detail Biaya yang harus dibayar--}}
                    @forelse($invoiceDetails['discounts'] as $item)
                        @php
                            /** @var \App\Models\Transaction\Invoice\Detail $item */
                        @endphp
                        <x-invoice.price-item name="{{$item->name}}" :price="$item->price" isDiscount/>
                    @empty
                    @endforelse
                    <hr/>
                    {{-- Total Biaya yang harus dibayar--}}
                    <x-invoice.price-item name="Total" :price="$invoiceDetails['total']"/>

                    <div class="pt-3">
                        <h6 class="font-weight-bold">
                            Pilih Metode Pembayaran
                        </h6>
                        <x-wrapper.card>
                            <x-payment-method.list-item name="payment_method_account_id" :paymentMethods="$paymentMethods"/>
                        </x-wrapper.card>
                    </div>

                    <div class="pt-3">
                        <x-form.button fullWidth isSubmit>
                            Lanjutkan Pembayaran
                        </x-form.button>
                    </div>
                </x-wrapper.card>
            </div>
        </div>
    </form>
@endsection
