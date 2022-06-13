<?php

namespace App\View\Components\Badges;

use App\Models\Transaction\Order;
use App\View\Components\Wrapper\Badge;


class OrderStatus extends Badge
{
    public function __construct(string $variant = "", string $type = null, string $size = null, bool $pill = true, $status = Order::ORDER_STATUS_TAKEN)
    {
        parent::__construct($variant, $type, $size, $pill);
        $this->content = Order::getAvailableStatus()[$status];
        switch (true) {
            case in_array($status, [
                Order::ORDER_STATUS_LEGAL_PROCESSING,
                Order::ORDER_STATUS_PACKING,
                Order::ORDER_STATUS_SHIPPING,
                Order::ORDER_STATUS_TO_UNIVERSITY
            ]):
                $this->type = self::TYPE_WARNING;
                break;
            case in_array($status, [Order::ORDER_STATUS_TAKEN, Order::ORDER_STATUS_PRINT]):
                $this->type = self::TYPE_INFO;
                break;
            case in_array($status, [
                Order::ORDER_STATUS_ARRIVED_UNIVERSITY,
                Order::ORDER_STATUS_LEGAL_PROCESSED,
                Order::ORDER_STATUS_PACKED,
                Order::ORDER_STATUS_RECEIVED,
                Order::ORDER_STATUS_DONE
            ]):
                $this->type = self::TYPE_SUCCESS;
                break;
            default:
                $this->type = self::TYPE_INFO;
                break;
        }
        $this->type = $this->getType()[$this->type];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.wrapper.badge');
    }
}
