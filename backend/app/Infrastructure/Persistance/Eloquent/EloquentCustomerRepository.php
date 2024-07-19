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
        $eloquentCustomer = EloquentCustomer::find($id->getId());
        if($eloquentCustomer){
            return new Customer(
                new CustomerId($id->getId()),
                new CustomerFirstName($eloquentCustomer->first_name),
                new CustomerLastName($eloquentCustomer->last_name),
                new CustomerAddress($eloquentCustomer->address),
                new CustomerEmail($eloquentCustomer->email),
                new CustomerPhone($eloquentCustomer->phone)
            );
        }

        return null;
    }

    public function findAll(): array
    {
        $eloquentCustomers = EloquentCustomer::all();
        $customers = array_map(function ($customer)  {
            return new Customer(
                new CustomerId($customer['id']),
                new CustomerFirstName($customer['first_name']),
                new CustomerLastName($customer['last_name']),
                new CustomerAddress($customer['address']),
                new CustomerEmail($customer['email']),
                new CustomerPhone($customer['phone'])
            );
        }, $eloquentCustomers->toArray());
        return $customers;
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