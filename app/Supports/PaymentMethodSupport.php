<?php

namespace App\Supports;

use App\Models\Master\Faculty;
use App\Models\PaymentMethod\Account;
use App\Models\PaymentMethod\PaymentMethod;
use App\Models\PaymentMethod\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodSupport
{

    static public function getPaymentMethodTypeQuery(): Builder
    {
        return Type::query();
    }

    static public function getPaymentMethodTypes(): Collection|array
    {
        return self::getPaymentMethodTypeQuery()->get();
    }

    static public function getPaymentMethodListMap(Collection $data){

        return $data->map(function (Type $item){
            return $item->paymentMethods->map(function (PaymentMethod $item){
                /** @var Account $account */
                $account = $item->accounts->first();
                $account = $account->toArray();
                $item->unsetRelation('accounts');
                $item = $item->toArray();
                $item['account'] = $account;
                return $item;
            });
        });

    }

    static public function getPaymentMethodListByFaculty(Faculty $faculty): Collection|\Illuminate\Support\Collection|array
    {
        $query = self::getPaymentMethodTypeQuery()
            ->whereHas('paymentMethods.accounts', function ($query) use ($faculty) {
                $query->where('faculty_id', $faculty->id);
            })
            ->with([
                'paymentMethods' => function ($query) use ($faculty) {
                    $query->whereHas('accounts', function ($query) use ($faculty) {
                        $query->where('faculty_id', $faculty->id);
                    });
                },
                'paymentMethods.accounts' => function ($query) use ($faculty) {
                    $query->where('faculty_id', $faculty->id);
                }
            ]);
        return $query->get();
    }

    static public function getPaymentMethodList(): Collection|array
    {
        return self::getPaymentMethodTypeQuery()->get();
    }


}
