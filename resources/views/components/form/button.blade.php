<button
    type="{{$isSubmit ? "submit": "button"}}" {{$attributes->class(["btn",$type,$variant,$size,"btn-block"=>$fullWidth,'btn-rounded'=>$rounded,'btn-circle'=>$circle])}}>{{$slot}}</button>
