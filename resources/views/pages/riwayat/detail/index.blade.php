@extends('pages.admin.pengajuan-legalisir.ijazah.detail.index')
@section("actions")
    <div class="d-flex flex-column" style="gap: 1rem">
        @if(\App\Supports\FormSupport::getFormData('status') === \App\Models\Transaction\Transaction::TRANSACTION_STATUS_WAITING_PAYMENT)
            <a class="text-decoration-none" href="{{route('invoice.payment',['invoice'=>\App\Supports\FormSupport::getFormData('invoice.id')])}}">
                <x-form.button :isSubmit="false" fullWidth>
                    Lihat Status Pembayaran
                </x-form.button>
            </a>
        @endif
    </div>
@endsection
