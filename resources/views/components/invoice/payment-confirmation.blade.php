<x-form.button :isSubmit="false" fullWidth data-toggle="modal" data-target="#paymentConfirmation" outline
               type="{{\App\View\Components\Form\Button::TYPE_SUCCESS}}">Konfirmasi
    Pembayaran
</x-form.button>
<x-wrapper.modal title="Konfirmasi Pembayaran" name="paymentConfirmation">
    <form method="POST" action="{{route('invoice.payment.confirmation',['invoice'=>$id??""])}}" enctype="multipart/form-data">
        @csrf
        <x-wrapper.form>
            <x-wrapper.column>
                <x-form.input name="holder_name" label="Nama Pengirim" isGroup/>
            </x-wrapper.column>
            <x-wrapper.column>
                <x-form.file name="file" label="Bukti Pembayaran" isGroup/>
            </x-wrapper.column>
            <x-form.button isSubmit type="{{\App\View\Components\Form\Button::TYPE_SUCCESS}}" fullWidth>
                Konfirmasi
            </x-form.button>
        </x-wrapper.form>
    </form>
</x-wrapper.modal>
