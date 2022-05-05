<x-wrapper.form-group label="{{$label}}" name="{{$name}}" error="{{$error}}" helper="{{$helper}}" :isGroup="$isGroup">
    <input name="{{$name}}"
           type="{{$type}}"
           placeholder="{{$placeholder ?? $label ?? $name ?? $name ?? ""}}"
           {{$attributes->class(["form-control","form-control-rounded"=>$rounded])}}
           value="{{old($name,\Illuminate\Support\Facades\Session::get('form.'.$name))}}"
    >
</x-wrapper.form-group>
