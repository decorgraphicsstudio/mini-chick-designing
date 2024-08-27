<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment_form');
    }

    public function store(Request $request)
    {

        $today = Carbon::today();

        $request->validate([
            'paymentDate' => ['required', 'date', 'before_or_equal:' . $today->toDateString()],
            'paymentAmount' => 'required|numeric',
        ]);
    
        Payment::create([
            'payment_date' => $request->input('paymentDate'),
            'payment_amount' => $request->input('paymentAmount'),
        ]);

        return redirect()->back()->with('success', 'Payment recorded successfully!');
    }

    public function index()
    {
        $payments = Payment::all(); // Retrieve all payments from the database
        return view('payments.index', compact('payments'));
    }
}
