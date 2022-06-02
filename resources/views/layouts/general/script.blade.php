@section("script")

    <script src="{{asset("/js/manifest.js")}}"></script>
    {{--        <script src="{{asset("/js/vendor.js")}}"></script>--}}
    <script src="{{asset("/js/app.js")}}" defer></script>
    <script type="text/javascript">window.laravel = @json($laravelJs);</script>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset("vendor/jquery/jquery.min.js")}}"></script>
    <script src="{{asset("vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset("vendor/jquery-easing/jquery.easing.min.js")}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset("js/sb-admin-2.min.js")}}"></script>
    <script src="{{asset("js/select2.min.js")}}"></script>
    <script src="{{asset("js/datatables.min.js")}}"></script>
    <script src="{{asset("js/clipboard.min.js")}}"></script>
    {{--    <script src="{{asset("js/plugins/piexif.js")}}" type="text/javascript"></script>--}}
    {{--    <script src="{{asset("js/plugins/sortable.js")}}" type="text/javascript"></script>--}}
    {{--    <script src="{{asset("js/fileinput.js")}}" type="text/javascript"></script>--}}


    <!-- Page level plugins -->
    <script src="{{asset("vendor/chart.js/Chart.min.js")}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset("js/demo/chart-area-demo.js")}}"></script>
    <script src="{{asset("js/demo/chart-pie-demo.js")}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const API = axios.create({
            baseURL: window.location.base,
            headers: {"Content-Type": "application/json"}
        });
    </script>
    <script>
        const phpJsonVar = "<?=json_encode($json ?? [])?>"
    </script>

    <script>
        $(document).ready(function () {
            $("select[select-autocomplete='true']").select2({
                theme: 'bootstrap4',
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const formWrapperResponsive = () => {
                document.querySelectorAll("#wrapper-form.is-responsive.is-row").forEach(function (item) {
                    const breakpoint = window.getBreakPoint()
                    if (["xs", "sm"].includes(breakpoint)) {
                        if (item.classList.contains("form-row")) {
                            item.classList.remove("form-row")
                            item.classList.add("form")
                        }
                    } else {
                        if (!item.classList.contains("form-row")) {
                            item.classList.remove("form")
                            item.classList.add("form-row")
                        }
                    }
                })
            }
            formWrapperResponsive()
            window.addEventListener("resize", function () {
                formWrapperResponsive()
            })
        })
    </script>

    <script>
        new ClipboardJS('#copy');
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({delay: {"show": 100, "hide": 100}})
        })
        $(document).ready(function () {
            $(".toast").toast('show');
        });
    </script>

    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            // initialize plugin with defaults--}}
    {{--            $("input[type=file]").fileinput();--}}
    {{--        })--}}
    {{--    </script>--}}
@endsection
