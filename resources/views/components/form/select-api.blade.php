<x-form.select id="select-api" label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}"
               :isGroup="$isGroup"/>
@push('stack-script')
    <script>
        $(document).ready(function () {
            const name = "<?=$name?>"
            const url = "<?=$url?>"
            const isLocalhost = <?=json_encode($isLocalhost)?>;
            const requestUrl = isLocalhost ? `${window.location.origin}${url}` : url
            const additionalParams = <?=json_encode($params)?>;
            $(`#select-api[name='${name}']`).select2({
                theme:"bootstrap4",
                ajax: {
                    url: requestUrl,
                    data: function (params) {
                        var query = {
                            search: params.term,
                            ...additionalParams
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    }
                }
            });
        });
    </script>
@endpush
