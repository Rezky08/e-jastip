<x-form.select id="cost" name="{{$name}}" label="{{$label}}" isGroup/>
@push("stack-script")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const originName = "<?=$origin ?? ""?>"
            const destinationName = "<?=$destination ?? ""?>"
            const weightName = "<?=$weight ?? ""?>"
            const costName = "<?=$name ?? ""?>"
            const originSelector = document.querySelector(`[name='${originName}']`)
            const destinationSelector = document.querySelector(`[name='${destinationName}']`)
            const weightSelector = document.querySelector(`[name='${weightName}']`)
            const costSelector = document.querySelector(`#cost[name='${costName}']`)

            const getValue = () => ({
                origin: originSelector?.value,
                destination: destinationSelector?.value,
                weight: weightSelector?.value ?? 1,
            })

            const getCost = (changeItem)=>{
                const filter = getValue();
                let optionElementHtml = `${form.select.optionElement({label:"Pilih Pengiriman",disabled:"disabled",selected:true})}\n`
                raja_ongkir.getCost(filter).then(({data})=>{
                    data?.map((partner)=>{
                        partner?.costs?.map((cost)=>{
                            const displayCode = `${partner?.code}-${cost?.service}`
                            const costPrice = cost?.cost[0]
                            optionElementHtml += `${form.select.optionElement({value:displayCode,label:`[${displayCode.toUpperCase()}] ${costPrice?.etd} Hari (${number_format(costPrice?.value)})`})}\n`
                        })
                    })
                    costSelector.innerHTML = optionElementHtml
                })
            }

            originSelector?.addEventListener("change", (e) => {
                getCost("origin")
            })
            destinationSelector?.addEventListener("change", (e) => {
                getCost("destination")
            })
            weightSelector?.addEventListener("change", (e) => {
                getCost("weight")
            })
        })
    </script>
@endpush
