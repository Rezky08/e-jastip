<x-form.select name="{{$name}}" label="{{$label}}" isGroup/>
@push("stack-script")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const getDistrict = ({cityId, districtId}) => {
                raja_ongkir.getDistrict({id:districtId, city_id:cityId}).then(({data}) => {
                    const name = "<?=$name?>"
                    const kecamatanSelector = document.querySelector(`select[name='${name}']`);
                    let optionElementHtml = `${form.select.optionElement({label:"Pilih Kecamatan",disabled:"disabled",selected:true})}\n`
                    data?.map((item) => optionElementHtml += `${form.select.optionElement({value:item?.district_id,label:item?.district_name})}\n`)
                    kecamatanSelector.innerHTML = optionElementHtml
                })
            }
            const parentName = "<?=$parentName?>"
            const kotaSelector = document.querySelector(`select[name='${parentName}']`);
            kotaSelector?.addEventListener("change",(e)=>{
                const cityId = e.target.value
                getDistrict({cityId})
            })
        })
    </script>
@endpush
