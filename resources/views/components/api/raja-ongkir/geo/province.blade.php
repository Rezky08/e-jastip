<x-form.select name="provinsi" label="Provinsi" isGroup/>
@push("stack-script")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // API_RAJA_ONGKIR.getProvince().then((data) => {
            //     console.log(data)
            //     // const provinsiSelector = document.querySelector("select[name='provinsi']");
            //     // const optionElement = (item) => `<option value="${item['province_id']}">${item['province']}</option>`;
            //     // const data = rajaongkir?.results ?? []
            //     // let optionElementHtml = ""
            //     // data?.map((item) => optionElementHtml += `${optionElement(item)}\n`)
            //     // provinsiSelector.innerHTML = optionElementHtml
            // })
        })
    </script>
@endpush
