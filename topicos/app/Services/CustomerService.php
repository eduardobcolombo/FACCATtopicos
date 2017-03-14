<?php
namespace App\Services;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Auth;

class CustomerService
{

    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $user_id = Auth::user();
            $data['user_id'] = $user_id->id;
            $customer = $this->customerRepository->create($data);
            $customer->save();
            \DB::commit();
            return $customer;
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }
}