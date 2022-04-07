<select class="custom-select">
    @foreach($options as $option)
        <option value="{{$option['value']}}" {{$isSelected($option['value']) ? "selected='selected'":''}}>{{$option['label']}}</option>
    @endforeach
</select>
