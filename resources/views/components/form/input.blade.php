<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <input name="{{$name}}"
           type="{{$type}}"
           placeholder="{{$placeholder ?? $label ?? $name ?? $name ?? ""}}"
           {{$attributes->class(["form-control","form-control-rounded"=>$rounded])}}
           value="{{old(\App\Supports\StringSupport::convertArrayIntoDotKey($name),\App\Supports\FormSupport::getFormData($name)) ?? $value ?? null}}"
    >
</x-wrapper.form-group>
