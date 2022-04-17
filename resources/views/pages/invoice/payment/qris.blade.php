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
                       Nomor Invoice <strong>#{{$invoiceNumber??""}}</strong>
                   </div>
               </div>

               {{--Gambar QR dari QRIS--}}
               <div class="row justify-content-center text-center">
                   <div class="col-12">
                       <span class="font-weight-bold">{{$methodName??""}}</span>
                   </div>
                   <div class="col-6">
                       <img src="{{asset($qrPath??"")}}" class="img-fluid w-100"/>
                   </div>
                   <div class="col-12">
                       <span class="font-weight-bold">{{$holderName??""}}</span>
                   </div>
               </div>
               <x-wrapper.collapse>
                   <x-slot name="toggle">
                       <span class="font-weight-bold">
                           Cara Pembayaran
                       </span>
                   </x-slot>
                   <div class="d-flex flex-column">
                       <span>1</span>
                       <span>2</span>
                       <span>3</span>
                       <span>4</span>
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
