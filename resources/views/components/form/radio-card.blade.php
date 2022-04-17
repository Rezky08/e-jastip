<div class="input-group">
    <label for="{{"$name-$value"}}" {{$attributes->class(['w-100'=>$fullWidth])}}>
        <x-wrapper.card>
            {{$slot}}
        </x-wrapper.card>
    </label>
    <input class="d-none" id="{{"$name-$value"}}" type="radio" name="{{$name}}" value="{{$value}}" onchange="(()=>{
        const name = `<?=$name?>`;

        const checkedCard = (selector,checked=false)=>{
        const parentSelector = selector?.parentNode?.querySelector('label > *')
        if (!parentSelector.classList.contains('card-checked') && checked){
        parentSelector.classList.add('card-checked')
        }else if (parentSelector.classList.contains('card-checked') && !checked){
        parentSelector.classList.remove('card-checked')
        }
        }

        const allSelector = document.querySelectorAll(`input[name='${name}']`)
        allSelector.forEach((selector)=>{
            checkedCard(selector)
        })
        const inputSelector  = document.querySelector(`input[name='${name}']:checked`)
        checkedCard(inputSelector,true)
        })()">
</div>
