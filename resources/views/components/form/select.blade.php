<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <select id="{{$id}}" class="custom-select form-control" name="{{$name}}"
            select-autocomplete="{{$autocomplete?'true':'false'}}" {{$disabled?"disabled":null}}>
        @forelse($options as $option)
            <option
                value="{{$option['value']}}" {{$isSelected($option['value']) ? "selected='selected'":''}}>{{$option['label']}}</option>
        @empty
            <option value="">--Pilih--</option>
        @endforelse
    </select>
</x-wrapper.form-group>
