<x-form.select name="{{$name}}" label="{{$label}}" isGroup/>
@push("stack-script")
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const originName = "<?=$origin ?? ""?>"
            const destinationName = "<?=$destination ?? ""?>"
            const weightName = "<?=$weight ?? ""?>"
            const originSelector = document.querySelector(`[name='${originName}']`)
            const destinationSelector = document.querySelector(`[name='${destinationName}']`)
            const weightSelector = document.querySelector(`[name='${weightName}']`)

            const getValue = () => ({
                origin: originSelector?.value,
                destination: destinationSelector?.value,
                weight: weightSelector?.value ?? 1,
            })

            const getCost = (changeItem)=>{
                const filter = getValue();
                raja_ongkir.getCost(filter).then(({data})=>{
                    console.log(data)
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
