<span {{$attributes->class(["badge",$type,$variant,$size,"badge-pill"=>$pill])}}>
    @if($slot->isNotEmpty())
        {{$slot}}
    @else
        {{$content}}
    @endif
</span>
