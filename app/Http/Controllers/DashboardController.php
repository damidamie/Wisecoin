<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function dashboardMostExpensiveTransaction()
    {
        // Retrieve the most expensive transaction
        $mostExpensiveTransaction = Transaction::orderBy('amount')->first();

        // Pass the data to the view
        return view('index', compact('mostExpensiveTransaction'));
    }
}
