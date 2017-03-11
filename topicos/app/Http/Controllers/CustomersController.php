<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomersController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        return view('admin.customers.index');
    }

}
