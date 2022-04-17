@extends("layouts.user.template")
@section("main")
   <div class="d-flex justify-content-center row">
       <div class="col-md-6 col-sm-12">
           <x-wrapper.card>
               <h3>
                   Detail Biaya
               </h3>
               <hr/>
               {{-- Detail Biaya yang harus dibayar--}}
               <x-invoice.price-item name="Biaya Operasional" :price="10000"/>
               <x-invoice.price-item name="Biaya Kirim" :price="10000000000"/>
               <hr/>
               {{-- Total Biaya yang harus dibayar--}}
               <x-invoice.price-item name="Potongan Biaya Kirim" :price="1000" isDiscount/>
               <x-invoice.price-item name="Total" :price="10000"/>

               <x-wrapper.card>
                   <x-payment-method.list-item/>
               </x-wrapper.card>

               <div class="pt-3">
                   <x-form.button fullWidth>
                       Lanjutkan Pembayaran
                   </x-form.button>
               </div>
           </x-wrapper.card>
       </div>
   </div>
@endsection
