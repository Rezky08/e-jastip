<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <textarea rows="{{$rows??""}}" name="{{$name}}" type="{{$type}}"
              placeholder="{{$placeholder ?? $label ?? $name ?? $name ?? ""}}" class="form-control"
              style="{{$noResize ? "resize : none" : ""}}">{!! $value ?? null !!}</textarea>
</x-wrapper.form-group>
