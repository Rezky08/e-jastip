@push("stack-script")
    <script src="https://cdn.jsdelivr.net/npm/rajaongkir-jquery@1.1.2/src/rajaongkir.min.js"></script>
    <script>
        const API_RAJA_ONGKIR = $().RajaOngkir('starter',"<?=$ApiRajaOngkir['key'] ?? ''?>");
    </script>
@endpush
