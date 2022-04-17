@extends("layouts.user.template")
@section("main")
   <div class="d-flex justify-content-center row">
       <div class="col-md-6 col-12">
           <x-wrapper.card>
               <h3>
                   Pembayaran #{{$invoiceNumber??""}}
               </h3>
               <hr/>

               {{--Gambar QR dari QRIS--}}

               <div class="pt-3">
                   <x-form.button fullWidth>
                       Lanjutkan Pembayaran
                   </x-form.button>
               </div>
           </x-wrapper.card>
       </div>
   </div>
@endsection
