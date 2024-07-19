<?php 

namespace App\Application\Customers\Handler;

use App\Application\Customers\Command\CreateCustomerCommand;
use App\Domain\Customers\Entities\Customer;
use App\Domain\Customers\Repositories\CustomerRepositoryInterface;
use App\Domain\Customers\ValueObjects\CustomerId;
use App\Domain\Customers\ValueObjects\CustomerFirstName;
use App\Domain\Customers\ValueObjects\CustomerLastName;
use App\Domain\Customers\ValueObjects\CustomerAddress;
use App\Domain\Customers\ValueObjects\CustomerEmail;
use App\Domain\Customers\ValueObjects\CustomerPhone;

class CreateCustomerHandler
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(CreateCustomerCommand $command): CustomerId
    {
        $customer = new Customer(
            CustomerId::generate(),
            new CustomerFirstName($command->firstName),
            new CustomerLastName($command->lastName),
            new CustomerAddress($command->address),
            new CustomerEmail($command->email),
            new CustomerPhone($command->phone)
        );

        $this->customerRepository->save($customer);
        return $customer->getId();
    }
}