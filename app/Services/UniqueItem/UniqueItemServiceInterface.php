<?php

namespace App\Services\UniqueItem;

interface UniqueItemServiceInterface
{
    public function sync(array $result): void;
}
