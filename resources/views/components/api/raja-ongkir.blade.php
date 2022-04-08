@push("stack-script")
    <script>
        const API_RAJA_ONGKIR = $().RajaOngkir('starter',"<?=$ApiRajaOngkir['key'] ?? ''?>");
        {{--const API_RAJA_ONGKIR = require('rajaongkir-nodejs').Starter("<?=$ApiRajaOngkir['key'] ?? ''?>");--}}
        API_RAJA_ONGKIR.getProvince()
    </script>
@endpush
