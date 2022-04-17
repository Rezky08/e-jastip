<button type="{{$isSubmit ? "submit": "button"}}" {{$attributes->class(["btn",$type,$variant,$size,"btn-block"=>$fullWidth])}}>{{$slot}}</button>
