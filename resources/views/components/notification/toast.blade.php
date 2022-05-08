<div id="notif-toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
    <div class="toast-header">
        <img src="{{$img??""}}" class="rounded mr-2" alt="{{$altImg??""}}">
        <strong class="mr-auto">{{$title}}</strong>
        <small class="text-muted">{{$datetime}}</small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        {{$slot}}
    </div>
</div>
