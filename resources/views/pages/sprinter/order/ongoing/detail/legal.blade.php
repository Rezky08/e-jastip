@extends('pages.admin.pengajuan-legalisir.ijazah.detail.index')
@include('layouts.sprinter.script')
@section("payment")
@endsection
@section("actions")
    <div class="py-3">
        <form method="POST" action="{{route('sprinter.order.ongoing.legal.done',\Illuminate\Support\Facades\Route::current()->parameters)}}">
            @csrf
            <x-form.file id="file" name="file[]" label="Bukti Legalisir" isGroup isMultiple/>
            <x-form.text-area name="remark" label="Catatan" isGroup/>
            <x-form.button isSubmit fullWidth type="{{\App\View\Components\Form\Button::TYPE_SUCCESS}}">
                {{__('messages.sprinter.form.submit.legal_process_done')}}
            </x-form.button>
        </form>
    </div>
@endsection
