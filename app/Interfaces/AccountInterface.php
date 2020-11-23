<?php

namespace App\Interfaces;
Use App\Currency;

interface AccountInterface
{
    public function all();
    public function store(array $data);
    public function delete(int $id);
    public function update(array $data, $id);
    public function checkBalance(int $id);
    public function deposit(int $account, string $from, float $amount);
    public function withdraw(int $account, string $from, float $amount);
}