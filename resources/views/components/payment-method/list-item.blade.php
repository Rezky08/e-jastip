@forelse($paymentMethods as $paymentMethod)
    <x-wrapper.collapse :isCard="false">
        <x-slot name="toggle">
            <h6 class="text-muted">{{$paymentMethod['label']}}</h6>
        </x-slot>

        @forelse($paymentMethod['payment_methods'] as $item)
            <x-payment-method.item name="{{$name}}" value="{{$item['code']}}" icon="{{$item['icon']}}" :isActive="$item['isActive']??false">
                {!! $item['label'] !!}
            </x-payment-method.item>
        @empty
        @endforelse

    </x-wrapper.collapse>

    @empty
    <span>
        Tidak ada metode pembayaran yang dapat dipilih
    </span>
@endforelse
