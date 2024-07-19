<?php 

namespace App\Domain\Customers\Repositories;

use App\Domain\Customers\Entities\Customer;
use App\Domain\Customers\ValueObjects\CustomerId;

interface CustomerRepositoryInterface
{
    public function findById(CustomerId $id): ?Customer;
    public function findAll(): array;
    public function save(Customer $customer): CustomerId;
    public function delete(CustomerId $id): void;
}