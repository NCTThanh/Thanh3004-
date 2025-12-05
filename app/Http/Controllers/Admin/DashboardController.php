<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\ContactSubmission;
use App\Models\User; 

class DashboardController extends Controller 
{
    public function index()
    {
        
       $totalCars = Car::count();
        $totalSubmissions = ContactSubmission::count(); 
        $totalUsers = User::count();
        $latestSubmissions = ContactSubmission::orderBy('created_at', 'desc')->take(5)->get();
        
        return view('admin.index', compact('totalCars', 'totalSubmissions', 'totalUsers', 'latestSubmissions'));
    }
}