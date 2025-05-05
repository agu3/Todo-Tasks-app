<?php

namespace App\Http\Controllers;

abstract class Controller
{
    
public function showDashboard() {
    $user = Auth::user(); // Get the authenticated user
    // You can use the user data here to show specific content
    return view('dashboard', compact('user'));
}
}
