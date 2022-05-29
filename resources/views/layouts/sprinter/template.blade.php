@extends("layouts.general.index")

@push("stack-script")
    <script>
        $(document).ready(function () {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
            if ($(".sidebar").hasClass("toggled")) {
                $('.sidebar .collapse').collapse('hide');
            };
        })
    </script>
@endpush
