<x-wrapper.form-group name="{{$name}}" label="{{$label}}" :isGroup="$isGroup">
    <div class="d-block">
        @if($slot->isNotEmpty())
            {{$slot}}
        @else
            {{\App\Supports\FormSupport::getFormData($name)}}
        @endif
    </div>
</x-wrapper.form-group>
