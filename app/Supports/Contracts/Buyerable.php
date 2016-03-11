<?php

namespace App\Supports\Contracts;

interface Buyerable
{
    public function getFirstName();

    public function getLastName();

    public function getEmail();

    public function invoices();
}