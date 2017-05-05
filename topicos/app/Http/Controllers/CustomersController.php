<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminCustomerRequest;
use App\Services\CustomerService;
use App\Repositories\CustomerRepository;

class CustomersController extends Controller
{

    private $repository;
    private $service;

    public function __construct(CustomerRepository $customerRepository, CustomerService $customerService)
    {
        $this->repository = $customerRepository;
        $this->service = $customerService;

    }

    public function index()
    {
        $customers = $this->repository->all();
        return view('admin.customers.index', compact('customers'));
    }

    public function edit($id)
    {
        $customer = $this->repository->find($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(AdminCustomerRequest $request)
    {
        $data = $request->all();

        $this->service->create($data);

        return redirect()->route('admin.customers.index');
    }

    public function update(AdminCustomerRequest $request, $id)
    {
        $data = $request->all();

        $this->repository->update($data,$id);

        return redirect()->route('admin.customers.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.customers.index');
    }

}
