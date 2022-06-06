@extends('pages.admin.pengajuan-legalisir.ijazah.detail.index')
@include('layouts.sprinter.script')
@section("payment")
@endsection
@section("actions")
    <div class="py-3">
        <x-form.button fullWidth type="{{\App\View\Components\Form\Button::TYPE_INFO}}">
            {{__('messages.sprinter.form.submit.to_university')}}
        </x-form.button>
    </div>
@endsection
