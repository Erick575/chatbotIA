<?php

namespace App\Repositories;

Use App\Account;
Use App\Log;

use App\Interfaces\AccountInterface;
use App\Helpers\CurrencyExchangeHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\Repository;

class AccountRepository implements AccountInterface
{
    protected $model;

    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function delete($id)
    {
        $account = $this->model->findOrFail($id);
        return $account->delete();
    }

    public function update(array $data, $id)
    {
        $account = $this->model->findOrFail($id);
        return $account->update($data);
    }

    public function checkBalance($id)
    {
        $account = $this->model->findOrFail($id);
        return $account->amount;
    }

    public function deposit($account_id, $from, $amount)
    {
        $account = $this->model->findOrFail($account_id);

        $transactionType = 'deposit';
        $defaultCurrency = $account->currency->slug;

        //Handling currency code in the cache
        $cacheKey = $from . '_' . $defaultCurrency;
        $cachedValue = Cache::get($cacheKey);
        if ( $cachedValue != null )
        {
            $currency_amount = $amount * floatval($cachedValue);
        } else {
            $currency_amount = CurrencyExchangeHelper::convert($from, $defaultCurrency, $amount);
            $expireAt = now()->addMinutes(1400);
            $cache = Cache::add($cacheKey,$currency_amount, $expireAt);
        }


        DB::beginTransaction();

        try {
            if( $currency_amount > 0 ) {
                $account->amount += $currency_amount;
                $resp = $account->save();

                if ($resp) {
                    $log = Log::create([
                        'user_id' => $account->user_id,
                        'currency_from'    => $from,
                        'currency_to'      => $defaultCurrency,
                        'amount_from'      => $amount,
                        'amount_to'        => $currency_amount,
                        'transaction_type' => $transactionType
                    ]);
                }
            }
            $msg = "Transaction Made";
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $msg = "Transaction could not be carried out";
        }

        return $msg;

    }

    public function withdraw($account_id, $from, $amount)
    {
        $account = $this->model->findOrFail($account_id);
        $transactionType = 'withdraw';
        $defaultCurrency = $account->currency->slug;
        //Handling currency code in the cache
        $cacheKey = $from . '_' . $defaultCurrency;

        $cachedValue = Cache::get($cacheKey);
        if ( $cachedValue != null )
        {
            $currency_amount = $amount * floatval($cachedValue);
        } else {
            $currency_amount = CurrencyExchangeHelper::convert($from, $defaultCurrency, $amount);
            $expireAt = now()->addMinutes(1400);
            $cache = Cache::add($cacheKey,$currency_amount, $expireAt);
        }

        DB::beginTransaction();

        try {

            if( $currency_amount > $account->amount ) {
                return "Insufficient Balance";
            }

            $account->amount -= $currency_amount;
            $resp = $account->save();

            if ($resp) {
                $log = Log::create([
                    'user_id' => $account->user_id,
                    'currency_from'    => $from,
                    'currency_to'      => $defaultCurrency,
                    'amount_from'      => $amount,
                    'amount_to'        => $currency_amount,
                    'transaction_type' => $transactionType
                ]);
            }

            $msg = "Transaction Made";
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $msg = "Transaction could not be carried out";
        }


        return $msg;
    }
}
