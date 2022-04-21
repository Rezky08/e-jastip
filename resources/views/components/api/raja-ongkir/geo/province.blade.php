<x-form.select name="{{$name}}" label="{{$label}}" isGroup/>
@push("stack-script")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            raja_ongkir.getProvince().then(({data}) => {
                const name = "<?=$name?>"
                const provinsiSelector = document.querySelector(`select[name='${name}']`);
                let optionElementHtml = `${form.select.optionElement({label:"Pilih Provinsi",disabled:"disabled",selected:true})}\n`
                data?.map((item) => optionElementHtml += `${form.select.optionElement({label:item?.province,value:item?.province_id})}\n`)
                provinsiSelector.innerHTML = optionElementHtml
            })
        })
    </script>
@endpush
