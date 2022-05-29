@php
    /** @var $data \Illuminate\Pagination\LengthAwarePaginator */
@endphp
@extends("layouts.sprinter.template")
@section("main")
    <div class="d-flex flex-column" style="gap: 1rem">
        @forelse($data as $item)
            <x-sprinter.order.incoming-card :transaction="$item"/>

        @empty
        @endforelse


    </div>
@endsection
@section("footer")
    <div class="d-flex justify-content-center">
        {!! $data->links() !!}
    </div>
    @parent
@endsection
