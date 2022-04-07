<x-form.select name="kecamatan" label="Kecamatan" isGroup/>
@push("stack-script")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const getSubdistrict = ({subdistrictId, cityId}) => {
                API_RAJA_ONGKIR.subdistrict(subdistrictId,cityId).then(({rajaongkir}) => {
                    const kecamatanSelector = document.querySelector("select[name='kecamatan']");
                    const optionElement = (item) => `<option value="${item['subdistrict_id']}">${item['subdistrict_name']}</option>`;
                    const data = rajaongkir?.results ?? []
                    let optionElementHtml = ""
                    data?.map((item) => optionElementHtml += `${optionElement(item)}\n`)
                    kecamatanSelector.innerHTML = optionElementHtml
                })
            }
            const kotaSelector = document.querySelector("select[name='kota']")
            kotaSelector?.addEventListener("change",(e)=>{
                const cityId = e.target.value
                getSubdistrict({cityId})
            })
        })
    </script>
@endpush
