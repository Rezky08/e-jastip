<x-form.select id="cost" name="{{$name}}" label="{{$label}}" :isGroup="$isGroup" error="{{$name}}_code"/>
<input type="hidden" name="{{$name}}_code" value="">
<input type="hidden" name="{{$name}}_service" value="">
<input type="hidden" name="{{$name}}_price" value="">
<input type="hidden" name="{{$name}}_etd" value="">
@push("stack-script")
    <script>
        $(document).ready(function () {
            const originName = "<?=$origin ?? ""?>"
            const destinationName = "<?=$destination ?? ""?>"
            const weightName = "<?=$weight ?? ""?>"
            const costName = "<?=$name ?? ""?>"
            const originSelector = $(`[name='${originName}']`)
            const destinationSelector = $(`[name='${destinationName}']`)
            const weightSelector = $(`[name='${weightName}']`)
            const costCssSelector = `#cost[name='${costName}']`;
            const costSelector = $(costCssSelector)
            let postValues = {}

            const getValue = () => ({
                origin: originSelector?.val(),
                destination: destinationSelector?.val(),
                weight: weightSelector?.val() ?? 1,
            })

            const getCost = (changeItem) => {
                const filter = getValue();
                let optionElementHtml = [
                    {
                        id: "",
                        text: "-- PILIH --",
                        disabled: true,
                        selected: true
                    }
                ]
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
                            optionElementHtml.push({
                                id: displayCode,
                                text: `[${displayCode.toUpperCase()}] ${costPrice?.etd} Hari (${number_format(costPrice?.value)})`
                            });
                        })
                    })
                    form.select.optionData(costCssSelector, optionElementHtml)
                })
            }

            costSelector.on("change", e => {
                const selected = e.target.value;
                const postValue = postValues[selected]
                Object.entries(postValue)?.map(([key, value]) => {
                    const selector = document.querySelector(`input[type='hidden'][name='${costName}_${key}']`)
                    selector.value = value
                });
            })

            originSelector?.on("change", (e) => {
                getCost("origin")
            })
            destinationSelector?.on("change", (e) => {
                getCost("destination")
            })
            weightSelector?.on("change", (e) => {
                getCost("weight")
            })
        })
    </script>
@endpush
