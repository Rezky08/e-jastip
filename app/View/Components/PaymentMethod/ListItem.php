<?php

namespace App\View\Components\PaymentMethod;

use Illuminate\View\Component;

class ListItem extends Component
{
    public array $paymentMethods;
    public string $name;

    /**
     * Create a new component instance.
     *
     * @param array $data
     */
    public function __construct($name = "payment_method")
    {
        $data = [
            'transfer' => [
                'label' => 'Transfer',
                'paymentMethod' => [
                    [
                        'value' => 'bca',
                        'icon' => 'img/bca.svg',
                        'label' => 'Bank Central Asia (BCA)',
                        'isActive' => true
                    ],
                    [
                        'value' => 'mandiri',
                        'icon' => 'img/mandiri.svg',
                        'label' => 'Mandiri',
                        'isActive' => true
                    ],
                    [
                        'value' => 'bri',
                        'icon' => 'img/bri.svg',
                        'label' => 'Bank Rakyat Indonesia (BRI)',
                        'isActive' => true
                    ],
                    [
                        'value' => 'bni',
                        'icon' => 'img/bni.svg',
                        'label' => 'Bank Negara Indonesia (BNI)',
                        'isActive' => true
                    ],
                ]
            ],
            'qris' => [
                'label' => 'QRIS',
                'paymentMethod' => [
                    [
                        'value' => 'shopee',
                        'icon' => 'img/shopee.svg',
                        'label' => 'Shopee Pay',
                        'isActive' => true
                    ],
                    [
                        'value' => 'gopay',
                        'icon' => 'img/gopay.svg',
                        'label' => 'Gopay',
                        'isActive' => true
                    ],
                    [
                        'value' => 'ovo',
                        'icon' => 'img/ovo.svg',
                        'label' => 'OVO',
                        'isActive' => true
                    ],
                    [
                        'value' => 'dana',
                        'icon' => 'img/dana.svg',
                        'label' => 'DANA',
                        'isActive' => true
                    ],
                ]
            ],
            'other' => [
                'label' => 'QRIS',
                'paymentMethod' => [
                    [
                        'value' => 'indomaret',
                        'icon' => 'img/indomaret.svg',
                        'label' => 'Indomaret',
                        'isActive' => true
                    ],
                    [
                        'value' => 'alfamart',
                        'icon' => 'img/alfamart.svg',
                        'label' => 'Alfamart',
                        'isActive' => true
                    ],
                ]
            ]
        ];

        $this->paymentMethods = $data;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.payment-method.list-item');
    }
}
