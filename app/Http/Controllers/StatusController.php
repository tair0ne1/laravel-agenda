<?php

namespace App\Http\Controllers;

use App\Contracts\Status\StatusContract;

class StatusController extends Controller
{
    protected $statusRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(StatusContract $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->statusRepository->getAll();
    }
}
