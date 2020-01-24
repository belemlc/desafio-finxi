<?php

namespace App\Http\Controllers;

use App\Services\PecaService;

class HomeController extends Controller
{
    protected $pecaService;

    public function __construct(PecaService $pecaService)
    {
        $this->middleware('auth');
        $this->pecaService = $pecaService;
    }


    public function index()
    {
        $pecas = $this->pecaService->all();
        return view('home', ['pecas' => $pecas]);
    }
}
