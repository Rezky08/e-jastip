<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="{{$name}}" aria-describedby="{{$name}}">
        <label class="custom-file-label" for="{{$name}}">{{$placeholder ?? $label ?? "Choose file"}}</label>
    </div>
</x-wrapper.form-group>
