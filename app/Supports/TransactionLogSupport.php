<?php

namespace App\Supports;

use App\Models\Pivot\Transaction\TransactionLogablePivot;
use App\Models\Transaction\Transaction;
use Carbon\Carbon;

class TransactionLogSupport
{

    public static function getLogTypeByClass($logableType)
    {
        return TransactionLogablePivot::getAvailableTypes()[$logableType] ?? $logableType;
    }

    public static function generateLogMessage($logableType, $status, $message, $datetime = null)
    {
        if (empty($datetime)) {
            $datetime = Carbon::now();
        }

        $logableType = self::getLogTypeByClass($logableType);

        return __('logs.template', [
            'logable' => $logableType,
            'status' => $status,
            'message' => $message,
            'datetime' => $datetime->toDateTimeString()
        ]);

    }
}
