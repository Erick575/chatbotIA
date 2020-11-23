<?php

namespace App\Repositories;
Use App\Currency;
Use App\Account;
Use App\Interfaces\CurrencyInterface;

class CurrencyRepository implements CurrencyInterface
{
    protected $model;

    public function __construct(Currency $model)
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
        $currency = $this->model->findOrFail($id);
        return $currency->delete();
    }


    public function update(array $data, $id)
    {
        $currency = $this->model->findOrFail($id);
        return $currency->update($data);
    }

    public function setDefaultCurrency( $account,$currency) {
        $account = Account::findOrFail($account);
        $account->currency_id = $currency;
        $account->save();
    }

 
}
