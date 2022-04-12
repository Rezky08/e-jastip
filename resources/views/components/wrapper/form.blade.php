<div id="wrapper-form"
     {{$attributes->class([
    "form-row"=>$isRow,
    "is-row"=>$isRow,
    "form"=>!$isRow,
    "is-responsive"=> $isResponsive
    ])}}>
{{$slot}}
<!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
</div>
