<button
    type="{{$isSubmit ? "submit": "button"}}" {{$attributes->class(["btn",$type,$variant,$size,"btn-block"=>$fullWidth,'btn-rounded'=>$rounded])}}>{{$slot}}</button>
