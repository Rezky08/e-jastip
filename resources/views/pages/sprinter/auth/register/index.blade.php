@extends("pages.auth.register.index")
@section("additional-fields")
    @php
    $selectParams = [
        'selectionCssClass' => 'form-control-rounded'
    ];
    @endphp
    <x-form.select-api name="university_id" label="Universitas" url="/api/master/university" :initiateParams="$selectParams"/>
@endsection
