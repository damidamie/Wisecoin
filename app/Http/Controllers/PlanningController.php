<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    function index(){

        $plannings = Planning::all();

        return view('layouts.planning', compact('plannings'));
    }

    function store(Request $request){

        $validatedData = $request->validate([
            'target_date' => 'required|date|after:today',
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Planning::create($validatedData);

        return redirect()->route('planning')->with('success', 'Planning added successfully');
    }
}
