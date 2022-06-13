@extends('pages.admin.pengajuan-legalisir.ijazah.detail.index')
@include('layouts.sprinter.script')
@section("payment")
@endsection
@section("destination-address")
@endsection
@section("courier")
@endsection

@section("actions")
    <div class="py-3">
        <x-form.button fullWidth data-toggle="modal" data-target="#documentTable">
            {{__('messages.sprinter.form.submit.print')}}
        </x-form.button>
    </div>
@endsection
