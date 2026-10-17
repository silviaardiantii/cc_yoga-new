<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        do {
            $code = 'YOGA-' . strtoupper(Str::random(6));
        } while (
            Customer::where('customer_code', $code)->exists()
        );

        $customer = Customer::create([
            'name' => $request->name,
            'customer_code' => $code,
            'credit_balance' => 0,
        ]);

        return view('customers.created', compact('customer'));
    }
}