<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\View;

class ExpenseCalendarController extends Controller
{
    public function index()
    {
        // Fetch all transactions from the database
        $transactions = Transaction::all();

        // Format transactions for FullCalendar events
        $events = $transactions->map(function ($transaction) {
            return [
                'title' => $transaction->description,
                'start' => $transaction->date,
                'amount' => $transaction->amount,
            ];
        });

        return View::make('layouts.expenseCalendar', compact('events'));
    }
}
