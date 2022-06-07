<div style="max-width: {{$width}}rem;max-height: {{$height}}rem">
    <img alt="{{$alt}}" data-target="#{{$name}}" {{$attributes->class(['img-thumbnail img-fluid',$classes])}} data-toggle="modal"
         role="button"
         src="{{$src}}"/>
</div>


<x-wrapper.modal :name="$name">
    <div class="text-center">
        <img src="{{$src}}" alt="{{$alt}}" {{$attributes->class(['img-fluid',$classes])}}/>
    </div>
</x-wrapper.modal>
