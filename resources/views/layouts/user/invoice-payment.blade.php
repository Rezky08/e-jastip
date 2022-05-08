@extends("layouts.user.template")
@section("main")
    <div class="d-flex justify-content-center row">
        <div class="col-md-6 col-12">
            <x-wrapper.card>
                <h5>
                    Pembayaran
                </h5>
                <hr/>

                <div class="row">
                    <div class="col-12">
                        Nomor Invoice <strong>#{{$invoice->id??""}}</strong>
                    </div>
                </div>

                <div class="row justify-content-center text-center">
                    <div class="col-12 font-weight-bold">
                        <span>{{($type->label??"")}}</span>
                        <div class="d-flex justify-content-center align-items-center">
                            <div style="width: 3rem">
                                <img class="img-fluid" src="{{asset($paymentMethod->icon)}}"
                                     alt="{{$paymentMethod->label}}"/>
                            </div>
                            <span>
                                {{$paymentMethod->label}}
                            </span>
                        </div>
                    </div>

                    <div class="col-6">
                        @yield("account")
                    </div>
                    <div class="col-12">
                        <span class="font-weight-bold">{{$account->name??""}}</span>
                    </div>
                </div>
                <x-wrapper.collapse>
                    <x-slot name="toggle">
                       <span class="font-weight-bold">
                           Cara Pembayaran
                       </span>
                    </x-slot>
                    <div class="d-flex flex-column">
                        @section("step")
                            <span>1</span>
                            <span>2</span>
                            <span>3</span>
                            <span>4</span>
                        @show
                    </div>
                </x-wrapper.collapse>

                <div class="pt-3">
                    <x-form.button fullWidth>
                        Cek Status Pembayaran
                    </x-form.button>
                </div>
            </x-wrapper.card>
        </div>
    </div>
@endsection
