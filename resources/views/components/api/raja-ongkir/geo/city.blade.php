<x-form.select name="kota" label="Kota" isGroup/>
@push("stack-script")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const getCity = ({cityId, provinceId}) => {
                API_RAJA_ONGKIR.city(cityId,provinceId).then(({rajaongkir}) => {
                    const kotaSelector = document.querySelector("select[name='kota']");
                    const optionElement = (item) => `<option value="${item['city_id']}">${item['city_name']}</option>`;
                    const data = rajaongkir?.results ?? []
                    let optionElementHtml = ""
                    data?.map((item) => optionElementHtml += `${optionElement(item)}\n`)
                    kotaSelector.innerHTML = optionElementHtml
                })
            }
            const provinsiSelector = document.querySelector("select[name='provinsi']")
            provinsiSelector?.addEventListener("change",(e)=>{
                const provinceId = e.target.value
                getCity({provinceId})
            })
        })
    </script>
@endpush
