<x-form.select name="{{$name}}" label="{{$label}}" isGroup/>
@push("stack-script")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const getCity = ({cityId, provinceId}) => {
                raja_ongkir.getCity({id:cityId, province_id:provinceId}).then(({data}) => {
                    const name = "<?=$name?>"
                    const kotaSelector = document.querySelector(`select[name='${name}']`);
                    let optionElementHtml = `${form.select.optionElement({label:"Pilih Kota",disabled:"disabled",selected:true})}\n`
                    data?.map((item) => optionElementHtml += `${form.select.optionElement({value:item?.city_id,label:`${item?.type} ${item?.city_name}`})}\n`)
                    kotaSelector.innerHTML = optionElementHtml
                })
            }
            const parentName = "<?=$parentName?>"
            const provinsiSelector = document.querySelector(`select[name='${parentName}']`);
            provinsiSelector?.addEventListener("change",(e)=>{
                const provinceId = e.target.value
                getCity({provinceId})
            })
        })
    </script>
@endpush
