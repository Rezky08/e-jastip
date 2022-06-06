@extends('pages.admin.pengajuan-legalisir.ijazah.detail.index')
@include('layouts.sprinter.script')
@section("payment")
@endsection
@section("destination-address")
@endsection
@section("courier-document")
@endsection

@section("actions")
    <div class="py-3">
        <x-modal.document-modal :isServerSide="true" name="documentTable" attachmentUri="sprinter.attachment">
            <form method="POST" action="{{route('sprinter.order.ongoing.print',\Illuminate\Support\Facades\Route::current()->parameters)}}" enctype="multipart/form-data">
                @csrf
                <x-form.file id="file" name="file[]" label="Bukti Cetak Dokumen" isGroup isMultiple/>
                <x-form.text-area name="remark" label="Catatan" isGroup/>
                <x-form.button isSubmit fullWidth outline>
                    {{__('messages.sprinter.form.submit.printed')}}
                </x-form.button>
            </form>
        </x-modal.document-modal>
        <x-form.button fullWidth data-toggle="modal" data-target="#documentTable">
            {{__('messages.sprinter.form.submit.print')}}
        </x-form.button>
    </div>
@endsection
