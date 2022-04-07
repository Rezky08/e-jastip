@if($isGroup)
    <div class="form-group">
        <label>{{$label}}</label>
        {{$slot}}
        @if($helper)
            <small id="{{$name}}-help" class="form-text text-muted">{{$helper}}</small>
        @endif
        @if($error)
            <small id="{{$name}}-error" class="form-text text-danger">{{$error}}</small>
        @endif
    </div>
@else
    {{$slot}}
    @if($helper)
        <small id="{{$name}}-help" class="form-text text-muted">{{$helper}}</small>
    @endif
    @if($error)
        <small id="{{$name}}-error" class="form-text text-danger">{{$error}}</small>
    @endif
@endif
