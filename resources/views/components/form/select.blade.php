<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <select class="custom-select" name="{{$name}}">
        @forelse($options as $option)
            <option
                value="{{$option['value']}}" {{$isSelected($option['value']) ? "selected='selected'":''}}>{{$option['label']}}</option>
        @empty
            <option value="">--Pilih--</option>
        @endforelse
    </select>
</x-wrapper.form-group>
