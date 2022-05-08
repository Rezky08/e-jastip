@extends("layouts.user.invoice-payment")
@section("account")
    <img src="{{asset($qrPath??"")}}" class="img-fluid w-100"/>
@endsection
