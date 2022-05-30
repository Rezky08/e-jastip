@php
    /** @var $data \Illuminate\Pagination\LengthAwarePaginator */
@endphp
@extends("layouts.sprinter.template")
@section("main")
    <div class="d-flex flex-column" style="gap: 1rem">

        @forelse($data as $item)
            @php
                /** @var \App\Models\Transaction\Transaction $item */
            @endphp
            <template>
                <incoming-card :amount="{{$item->invoice->calculated['total']??0}}"
                               token="{{$item->token}}" university-name="{{$item->university->name}}"/>
            </template>
        @empty
            <x-display.empty-data/>
        @endforelse

    </div>
@endsection
@section("footer")
    <div class="d-flex justify-content-center">
        {!! $data->links() !!}
    </div>
    @parent
@endsection

