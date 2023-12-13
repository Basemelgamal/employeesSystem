<?php

namespace App\Http\Controllers;

use App\Models\employeeManagerDepartment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $input = [
            'tasks'         => auth()->user()->tasks,
            'is_employee'   => auth()->user()->isEmployee(),
        ];

        return view('home', $input);
    }
}
