<x-form.select id="cost" name="{{$name}}" label="{{$label}}" :isGroup="$isGroup"/>
<input type="hidden" name="{{$name}}_code" value="">
<input type="hidden" name="{{$name}}_service" value="">
<input type="hidden" name="{{$name}}_price" value="">
<input type="hidden" name="{{$name}}_etd" value="">
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
            let postValues = {}

            const getValue = () => ({
                origin: originSelector?.value,
                destination: destinationSelector?.value,
                weight: weightSelector?.value ?? 1,
            })

            const getCost = (changeItem) => {
                const filter = getValue();
                let optionElementHtml = `${form.select.optionElement({
                    label: "Pilih Pengiriman",
                    disabled: "disabled",
                    selected: true
                })}\n`
                raja_ongkir.getCost(filter).then(({data}) => {
                    data?.map((partner) => {
                        partner?.costs?.map((cost) => {
                            const displayCode = `${partner?.code}-${cost?.service}`
                            const costPrice = cost?.cost[0]
                            const postValue = {
                                code: partner?.code,
                                service: cost?.service,
                                price: costPrice?.value,
                                etd: costPrice?.etd
                            }
                            postValues[displayCode] = postValue
                            optionElementHtml += `${form.select.optionElement({
                                value: displayCode,
                                label: `[${displayCode.toUpperCase()}] ${costPrice?.etd} Hari (${number_format(costPrice?.value)})`
                            })}\n`
                        })
                    })
                    costSelector.innerHTML = optionElementHtml
                })
            }

            costSelector.addEventListener("change", e => {
                const selected = e.target.value;
                const postValue = postValues[selected]
                Object.entries(postValue)?.map(([key, value]) => {
                    const selector = document.querySelector(`input[type='hidden'][name='${costName}_${key}']`)
                    selector.value = value
                });
            })

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
