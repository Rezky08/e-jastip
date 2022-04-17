@forelse($paymentMethods as $type => $paymentMethod)
    <h6 class="text-muted">{{$paymentMethod['label']}}</h6>
    @forelse($paymentMethod['paymentMethod'] as $item)
        <x-payment-method.item name="{{$name}}" value="{{$item['value']}}" icon="{{$item['icon']}}" :isActive="$item['isActive']">
            {!! $item['label'] !!}
        </x-payment-method.item>
    @empty

    @endforelse
    @empty
    <span>
        Tidak ada data
    </span>
@endforelse
