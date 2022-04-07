<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <input name="{{$name}}" type="{{$type}}" placeholder="{{$placeholder ?? $label ?? $name ?? $name ?? ""}}" class="form-control">
</x-wrapper.form-group>
