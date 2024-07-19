<?php 

namespace App\Infrastructure\Persistance\Eloquent;

use App\Domain\Customers\Entities\Customer;
use App\Domain\Customers\Repositories\CustomerRepositoryInterface;
use App\Domain\Customers\ValueObjects\CustomerId;
use App\Domain\Customers\ValueObjects\CustomerFirstName;
use App\Domain\Customers\ValueObjects\CustomerLastName;
use App\Domain\Customers\ValueObjects\CustomerAddress;
use App\Domain\Customers\ValueObjects\CustomerEmail;
use App\Domain\Customers\ValueObjects\CustomerPhone;
use App\Models\Customer as EloquentCustomer;

class EloquentCustomerRepository implements CustomerRepositoryInterface
{
    public function findById(CustomerId $id): ?Customer
    {
        //
    }

    public function findAll(): array
    {
        //
    }

    public function save(Customer $customer): CustomerId
    {
        $eloquentCustomer = EloquentCustomer::updateOrCreate(
            ['id' => $customer->getId()->getId()],
            [
                'first_name' => $customer->getFirstName()->getFirstName(),
                'last_name' => $customer->getLastName()->getLastName(),
                'address' => $customer->getAddress()->getAddress(),
                'email' => $customer->getEmail()->getEmail(),
                'phone' => $customer->getPhone()->getPhone()
            ]
        );

        return new CustomerId($eloquentCustomer->id);
    }

    public function delete(CustomerId $id): void
    {
        // TODO: Implement delete() method.
    }
}