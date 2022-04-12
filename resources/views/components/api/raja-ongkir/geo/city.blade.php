<x-form.select name="kota" label="Kota" isGroup/>
@push("stack-script")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const getCity = ({cityId, provinceId}) => {
                raja_ongkir.getCity({id:cityId, province_id:provinceId}).then(({data}) => {
                    const kotaSelector = document.querySelector("select[name='kota']");
                    let optionElementHtml = `${form.select.optionElement({label:"Pilih Kota",disabled:"disabled",selected:true})}\n`
                    data?.map((item) => optionElementHtml += `${form.select.optionElement({value:item?.city_id,label:`${item?.type} ${item?.city_name}`})}\n`)
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
