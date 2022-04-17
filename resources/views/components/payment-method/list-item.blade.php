@forelse($paymentMethods as $type => $paymentMethod)

    <x-wrapper.collapse :isCard="false">
        <x-slot name="toggle">
            <h6 class="text-muted">{{$paymentMethod['label']}}</h6>
        </x-slot>

        @forelse($paymentMethod['paymentMethod'] as $item)
            <x-payment-method.item name="{{$name}}" value="{{$item['value']}}" icon="{{$item['icon']}}" :isActive="$item['isActive']">
                {!! $item['label'] !!}
            </x-payment-method.item>
        @empty
        @endforelse

    </x-wrapper.collapse>

    @empty
    <span>
        Tidak ada data
    </span>
@endforelse
