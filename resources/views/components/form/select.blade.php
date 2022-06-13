<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <select id="{{$id}}"
            {{$attributes->class(["custom-select","form-control","form-control-rounded"=>$rounded])}} name="{{$name}}"
            select-autocomplete="{{$autocomplete?'true':'false'}}" {{$disabled?"disabled":null}}>
        @forelse($options as $option)
            <option
                value="{{$option['value']}}" {{$isSelected($option['value']) ? "selected='selected'":''}}>{{$option['label']}}</option>
        @empty
            <option value="" selected disabled>{{$placeholder??$label??$name}}</option>
        @endforelse
    </select>
</x-wrapper.form-group>
