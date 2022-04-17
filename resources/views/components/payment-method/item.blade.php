<x-form.radio-card name="{{$name}}" value="{{$value}}">
    <div class="row align-items-center">
        <div class="col-2">
            <img src="{{asset($icon)}}" class="img-fluid w-100">
        </div>
        <div class="col-auto">
            {{$slot}}
        </div>
    </div>
</x-form.radio-card>
