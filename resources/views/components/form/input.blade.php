@if($isGroup)
    <div class="form-group">
        <label>{{$label}}</label>
        <input name="{{$name}}" type="{{$type}}" class="form-control">
        @if($helper)
            <small id="{{$name}}-help" class="form-text text-muted">{{$helper}}</small>
        @endif
        @if($error)
            <small id="{{$name}}-error" class="form-text text-danger">{{$error}}</small>
        @endif
    </div>
@else
    <input name="{{$name}}" type="{{$type}}" class="form-control">
    @if($helper)
        <small id="{{$name}}-help" class="form-text text-muted">{{$helper}}</small>
    @endif
    @if($error)
        <small id="{{$name}}-error" class="form-text text-danger">{{$error}}</small>
    @endif
@endif
