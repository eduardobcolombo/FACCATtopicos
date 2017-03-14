<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminCalorieRequest;
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
        return view('admin.customers.index');
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(AdminCalorieRequest $request)
    {
        $data = $request->all();

        $this->service->create($data);

        return redirect()->route('admin.customers.index');
    }

}
