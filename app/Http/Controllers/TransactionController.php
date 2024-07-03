<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return view('layouts.transaction', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'type' => 'required|in:Deposit,Withdraw,Transfer,Payment',
            'amount' => 'required|numeric',
            'category' => 'required|in:Income,Transport,Shopping,Food',
            'description' => 'nullable|string',
        ]);

        $datetime = $request->date . '' . $request->time;

        Transaction::create([
            'date' => $datetime,
            'type' => $request->type,
            'amount' => $request->amount,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('transaction')->with('success', 'Transaction created successfully');
    }

    public function deleteTransaction(Request $request)
    {
        $transactionId = $request->input('transaction_id');
    
        try {
            // Find the transaction by ID and delete it
            $transaction = Transaction::findOrFail($transactionId);
            $transaction->delete();
    
            return redirect()->route('transaction')->with('success', 'Transaction deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('transaction')->with('failed', 'Failed to delete transaction.');
        }
    }
    
    
}
