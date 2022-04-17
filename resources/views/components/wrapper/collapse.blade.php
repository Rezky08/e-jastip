@switch($component)
    @case("button")
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#{{$name}}" aria-expanded="false" aria-controls="{{$name}}">
        {{$toggle}}
    </button>
    @break
    @case("a")
    <a data-toggle="collapse" data-target="#{{$name}}" aria-expanded="false" aria-controls="{{$name}}">
        {{$toggle}}
    </a>
    @break
    @case("div")
    <div class="row justify-content-between w-100 my-2" role="button" data-toggle="collapse" data-target="#{{$name}}" aria-expanded="false" aria-controls="{{$name}}">
        <div class="col-auto">
            {{$toggle}}
        </div>
        <div class="col-1">
            <i class="fa fa-chevron-down" aria-hidden="true"></i>
        </div>
    </div>
    @break
@endswitch
<div class="collapse" id="{{$name}}">
    @if($isCard)
        <div class="card card-body">
            {{$slot}}
        </div>
    @else
        {{$slot}}
    @endif
</div>
