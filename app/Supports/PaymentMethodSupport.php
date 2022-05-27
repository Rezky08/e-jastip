<?php

namespace App\Supports;

use App\Contracts\PaymentMethodAccountableContract;
use App\Models\Master\Faculty;
use App\Models\Master\University;
use App\Models\PaymentMethod\Account;
use App\Models\PaymentMethod\PaymentMethod;
use App\Models\PaymentMethod\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Rezky\LaravelResponseFormatter\Exception\Error;
use Rezky\LaravelResponseFormatter\Http\Code;

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

    static public function getPaymentMethodListMap(Collection $data)
    {

        return $data->map(function (Type $item) {
            return $item->paymentMethods->map(function (PaymentMethod $item) {
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

    static public function getPaymentMethodListByClass(PaymentMethodAccountableContract $paymentMethodAccountable, $relationName = ''): Builder
    {
        $class = $paymentMethodAccountable::class;
        $keyName = $paymentMethodAccountable->getKeyName();
        $query = self::getPaymentMethodTypeQuery()
            ->whereHas('paymentMethods', function ($query) use ($paymentMethodAccountable, $relationName, $class, $keyName) {
                $query->whereHas('accounts', function ($query) use ($paymentMethodAccountable, $relationName, $class, $keyName) {
                    $query->where('isActive', true);
                    $query->whereHas($relationName, function (Builder $query) use ($paymentMethodAccountable, $relationName, $class, $keyName) {
                        $query->where($class::getTableName() . '.' . $class::getInstance()->getKeyName(), $paymentMethodAccountable->$keyName);
                    });
                });
            })
            ->with([
                'paymentMethods' => function ($query) use ($paymentMethodAccountable, $relationName, $class, $keyName) {
                    $query->whereHas('accounts', function ($query) use ($paymentMethodAccountable, $relationName, $class, $keyName) {
                        $query->where('isActive', true);
                        $query->whereHas($relationName, function (Builder $query) use ($paymentMethodAccountable, $relationName, $class, $keyName) {
                            $query->where($class::getTableName() . '.' . $class::getInstance()->getKeyName(), $paymentMethodAccountable->$keyName);
                        });
                    });
                },
                'paymentMethods.accounts' => function ($query) use ($paymentMethodAccountable, $relationName, $class, $keyName) {
                    $query->where('isActive', true);
                    $query->whereHas($relationName, function (Builder $query) use ($paymentMethodAccountable, $relationName, $class, $keyName) {
                        $query->where($class::getTableName() . '.' . $class::getInstance()->getKeyName(), $paymentMethodAccountable->$keyName);
                    });
                }
            ]);
        return $query;
    }

    static public function getPaymentMethodListByUniversity(University $university): Collection|\Illuminate\Support\Collection|array
    {
        $query = self::getPaymentMethodListByClass($university, 'universities');
        return $query->get();
    }

    static public function getPaymentMethodListByGeneral(): Collection|\Illuminate\Support\Collection|array
    {
        $query = self::getPaymentMethodTypeQuery()
            ->whereHas('paymentMethods', function ($query) {
                $query->whereHas('accounts', function ($query) {
                    $query->where('isActive', true);
                });
            })
            ->with([
                'paymentMethods' => function ($query) {
                    $query->whereHas('accounts', function ($query) {
                        $query->where('isActive', true);
                    });
                },
                'paymentMethods.accounts' => function ($query) {
                    $query->where('isActive', true);
                }
            ]);
        return $query->get();
    }

//    static public function getPaymentMethodListByUniversity(University $university): Collection|\Illuminate\Support\Collection|array
//    {
//        $query = self::getPaymentMethodTypeQuery()
//            ->whereHas('paymentMethods.accounts', function ($query) use ($university) {
//                $query->whereHas('universities', function ($query) use ($university) {
//                    $query->where(University::getTableName() . '.' . University::getInstance()->getKeyName(), $university->id);
//                });
//            })
//            ->with([
//                'paymentMethods' => function ($query) use ($university) {
//                    $query->whereHas('accounts', function ($query) use ($university) {
//                        $query->whereHas('universities', function ($query) use ($university) {
//                            $query->where(University::getTableName() . '.' . University::getInstance()->getKeyName(), $university->id);
//                        });
//                    });
//                },
//                'paymentMethods.accounts' => function ($query) use ($university) {
//                    $query->whereHas('universities', function ($query) use ($university) {
//                        $query->where(University::getTableName() . '.' . University::getInstance()->getKeyName(), $university->id);
//                    });
//                }
//            ]);
//        return $query->get();
//    }

    static public function getPaymentMethodList(): Collection|array
    {
        return self::getPaymentMethodTypeQuery()->get();
    }


}
