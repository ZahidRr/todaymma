<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Logika pengalihan berdasarkan Role
        if ($user->hasRole('sales')) {
            return redirect()->route('sales.dashboard');
        } 
        
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } 
        
        if ($user->hasRole('teknisi')) {
            return redirect()->route('teknisi.dashboard');
        } 
        
        if ($user->hasRole('manajemen')) {
            return redirect()->route('manager.dashboard');
        }

        return view('dashboard'); 
    }
}