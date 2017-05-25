<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $customer = $this->repository->create($data);
//            throw new \Exception('Error: this e-mail is used already.');
            return response()
                ->json([
                    'msg' => 'Thanks!'
                ])
                ->setStatusCode(Response::HTTP_CREATED, Response::$statusTexts[Response::HTTP_CREATED]);
        } catch (\Exception $e) {

            return response()
                ->json([
                    'msg' => 'Erro: ' . $e->getMessage()
                ])
                ->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);
        }
    }

}
