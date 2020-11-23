<?php

namespace App\Interfaces;
Use App\Currency;

interface CurrencyInterface
{
    public function all();
    public function store(array $data);
    public function delete(int $id);
    public function update(array $data, $id);
    public function setDefaultCurrency(int $account_id, int $id);
}
