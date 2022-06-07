@extends("layouts.user.template")
@section("main")
    <x-wrapper.card>
        @forelse($logGroups as $date => $logItems)
            <x-wrapper.collapse :isCard="false">
                <x-slot name="toggle">
                    <span>
                        {{\Carbon\Carbon::createFromFormat('Y-m-d',$date)->toFormattedDateString()}}
                    </span>
                </x-slot>
                <div class="d-flex flex-column" style="gap: 1rem">
                    @php
                        /** @var \App\Models\Pivot\Transaction\TransactionLogablePivot $item */
                    @endphp

                    @forelse($logItems as $index => $item)
                        <div class="">
                            <div class="row">
                                <div class="col-1 d-flex justify-content-center position-relative">
                                    <span class="position-absolute" style="bottom: 0">
                                        <i class="fa fa-circle" aria-hidden="true"></i>
                                    </span>

                                    <div class="border-left h-50"></div>
                                </div>
                                <div class="col-11">
                                    <p>
                                        {{$item->remark}}
                                    </p>
                                    <hr/>

                                </div>
                            </div>
                        </div>

                    @empty
                    @endforelse
                </div>
            </x-wrapper.collapse>
            <hr/>
        @empty
        @endforelse
    </x-wrapper.card>
@endsection
