<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <div class="custom-file">
        <input name="{{$name}}" type="file" class="custom-file-input" id="{{$name}}"
               aria-describedby="{{$name}}" {{$isMultiple ? "multiple" : null}}>
        <label class="custom-file-label" for="{{$name}}">{{$placeholder ?? $label ?? "Choose file"}}</label>
    </div>
    <div id="{{$name}}-preview" class="custom-file-preview">

    </div>
</x-wrapper.form-group>
