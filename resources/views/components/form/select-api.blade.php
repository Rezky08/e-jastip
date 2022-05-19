<x-form.select id="{{$getPrefixId()}}{{$name}}" label="{{$label}}" name="{{$name}}" error="{{$error}}"
               helper="{{$helper}}"
               :isGroup="$isGroup"
               :disabled="$disabled"
/>
@push('stack-script')
    <script>
        $(document).ready(function () {
            const value = "<?=old($name, \Illuminate\Support\Facades\Session::get('form.' . $name))?>";
            const id = "<?=$getPrefixId . $name?>"
            const url = "<?=$url?>"
            const isLocalhost = <?=json_encode($isLocalhost)?>;
            const requestUrl = isLocalhost ? `${window.location.origin}${url}` : url
            let additionalParams = <?=json_encode($params)?>;
            const chainCssSelector = "<?=$chainSelector?>"

            if (chainCssSelector) {
                const chainSelector = $(chainCssSelector)
                chainSelector
                    .on("change", function (item) {
                        additionalParams = {...additionalParams, chainValue: item?.target?.value}
                        form.select.optionApi(requestUrl, id, additionalParams);
                        if (value) {
                            form.select.preOptionApi(requestUrl, id, {...additionalParams, id: value});
                        }
                    })
            } else {

                form.select.optionApi(requestUrl, id, additionalParams);
                if (value) {
                    form.select.preOptionApi(requestUrl, id, {...additionalParams, id: value});
                }
            }


        });
    </script>
@endpush
