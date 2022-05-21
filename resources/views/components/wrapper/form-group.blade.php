@if($isGroup)
    <div class="form-group">
        <label class="font-weight-bold">{!! $label !!}</label>
        {{$slot}}
        @if($helper)
            <small id="{{$name}}-help" class="form-text text-muted">{{$helper}}</small>
        @endif
        @php
        $errorName = \App\Supports\StringSupport::convertArrayIntoDotKey($name);
        @endphp
        @error($errorName)
        <small id="{{$errorName}}-error" class="form-text text-danger">{{$message}}</small>
        @enderror
        @php
            $errorNames = new \Illuminate\Support\Collection(explode(',',$error));
            $errorNames = $errorNames->filter(fn($value)=>$value !== "")->toArray();
        @endphp
        @forelse($errorNames as $errorName)
            @error($errorName)
            <small id="{{$errorName}}-error" class="form-text text-danger">{{$message}}</small>
            @enderror
        @empty
        @endforelse
    </div>
@else
    {{$slot}}
    @if($helper)
        <small id="{{$name}}-help" class="form-text text-muted">{{$helper}}</small>
    @endif
    @error($name)
    <small id="{{$name}}-error" class="form-text text-danger">{{$message}}</small>
    @enderror
    @php
        $errorNames = new \Illuminate\Support\Collection(explode(',',$error));
        $errorNames = $errorNames->filter(fn($value)=>$value !== "")->toArray();
    @endphp
    @forelse($errorNames as $errorName)
        @error($errorName)
        <small id="{{$errorName}}-error" class="form-text text-danger">{{$message}}</small>
        @enderror
    @empty
    @endforelse
@endif
