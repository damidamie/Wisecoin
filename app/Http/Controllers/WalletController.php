<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\MonthlyExpense;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $totalBalance = $this->calculateTotalBalance($transactions);
        $targetMonthlyExpense = MonthlyExpense::latest()->first();
        $monthlyExpense = $this->calculateMonthlyExpense($transactions);

        return View::make('layouts.wallet', compact('totalBalance', 'targetMonthlyExpense', 'monthlyExpense'));
    }


    private function calculateTotalBalance($transactions)
    {
        $totalBalance = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->type === 'Deposit') {
                $totalBalance += $transaction->amount;
            } else {
                $totalBalance -= $transaction->amount;
            }
        }

        return $totalBalance;
    }
    private function calculateMonthlyExpense($transactions)
    {
        $monthlyExpense = 0;

        foreach ($transactions as $transaction) {
            if ($transaction->type != 'Deposit') {
                $monthlyExpense += $transaction->amount;
            }
        }

        return $monthlyExpense;
    }


    public function storeMonthlyExpense(Request $request)
    {
        $validatedData = $request->validate([
            'monthly_expense' => 'required|numeric',
        ]);

        // Add 'amount' field to the data before creating the record
        $validatedData['amount'] = $validatedData['monthly_expense'];

        // Remove 'monthly_expense' from the data to avoid 'Field 'monthly_expense' doesn't have a default value' error
        unset($validatedData['monthly_expense']);

        // Create a new MonthlyExpense record
        MonthlyExpense::create($validatedData);

        return redirect()->route('wallet')->with('success', 'Monthly expense has been created.');
    }

    public function updateMonthlyExpense(Request $request)
    {
        $validatedData = $request->validate([
            'monthly_expense' => 'required|numeric'
        ]);

        $monthlyExpense = MonthlyExpense::latest()->first();

        if ($monthlyExpense != null) {
            $monthlyExpense->update(['amount' => $validatedData['monthly_expense']]);

            return redirect()->route('wallet')->with('success', 'Monthly expense updated successfully.');
        }

        return redirect()->route('wallet')->with('failed', 'Failed to update monthly expense.');
    }
}
