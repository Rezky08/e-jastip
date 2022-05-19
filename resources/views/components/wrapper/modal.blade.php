<div class="modal fade" id="{{$name}}" tabindex="-1" aria-labelledby="{{$name}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                @if(!empty($title))
                    <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{$body}}
            </div>
            @if(!empty($footer))
                <div class="modal-footer">
                    {{$footer}}
                </div>
            @endif
        </div>
    </div>
</div>
