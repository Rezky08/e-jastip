@extends("layouts.user.invoice-payment")
@section("account")
    <span id="account">{{$account->account}}</span>
    <x-button.copy-button target="#account"/>
@endsection
