<?php 

namespace App\Application\Customers\Handler;

use App\Application\Customers\DTO\CustomerDTO;
use App\Application\Customers\Query\GetCustomerQuery;
use App\Domain\Customers\Repositories\CustomerRepositoryInterface;

class GetCustomerHandler
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(GetCustomerQuery $query): CustomerDTO
    {
        $customer = $this->customerRepository->findById($query->getId());
       
        if ($customer === null) {
            throw new \Exception('Customer not found');
        }

        return new CustomerDTO(
            $customer->getId()->getId(), 
            $customer->getFirstName()->getFirstName(), 
            $customer->getLastName()->getLastName(), 
            $customer->getAddress()->getAddress(), 
            $customer->getEmail()->getEmail(), 
            $customer->getPhone()->getPhone()
        );
    }
}