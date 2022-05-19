<x-wrapper.form-group name="{{$name}}" label="{{$label}}" :isGroup="$isGroup">
    <div class="d-block">
        {{\App\Supports\FormSupport::getFormData($name)}}
    </div>
</x-wrapper.form-group>
