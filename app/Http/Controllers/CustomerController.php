<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    protected $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $customers = $this->repository->paginate(config('app.paginate'));
        return view('customers.index', compact('customers'));
    }
}
