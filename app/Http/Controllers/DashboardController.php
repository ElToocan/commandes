<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page' => 'content',
            'title' => 'Dashboard',
        ];
        return view('blank', $data);
    }
}
