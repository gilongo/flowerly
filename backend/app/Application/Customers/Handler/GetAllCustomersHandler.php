<?php 

namespace App\Application\Customers\Handler;

use App\Application\Customers\DTO\CustomerDTO;
use App\Application\Customers\Query\GetAllCustomersQuery;
use App\Domain\Customers\Repositories\CustomerRepositoryInterface;

class GetAllCustomersHandler
{
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function handle(GetAllCustomersQuery $query): array
    {
        $customers = $this->customerRepository->findAll();
       
        $customerDTOs = array_map(function ($customer) {
            return new CustomerDTO(
                $customer->getId()->getId(), 
                $customer->getFirstName()->getFirstName(), 
                $customer->getLastName()->getLastName(), 
                $customer->getAddress()->getAddress(), 
                $customer->getEmail()->getEmail(), 
                $customer->getPhone()->getPhone()
            );
        }, $customers);

        return $customerDTOs;
    }
}