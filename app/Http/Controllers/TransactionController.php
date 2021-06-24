<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Fee;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if($request->paid_amount > $request->remaining_balance) {
            return redirect()->back()->with('warning','Paid amount cannot be greater than remaining balance!'); 
        }

        $fee = Fee::findOrFail($request->fee_id);
        $fee->paid_amount += $request->paid_amount;
        $fee->remaining_balance -= $request->paid_amount;
        $fee->save();

        $transaction = new Transaction;
        $transaction->fee_id = $request->fee_id;
        $transaction->paid_amount = $request->paid_amount;
        $transaction->catered_by = auth()->user()->id;
        $transaction->save();

        return redirect()->back()->with('success','Payment successfully transact!');
    }

    public function show($fee_id)
    {
        $transactions = Transaction::where('fee_id',$fee_id)->get();
        return view('fees._history',compact('transactions'));
    }

    public function edit(Transaction $transaction)
    {
        //
    }

    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function destroy(Transaction $transaction)
    {
        //
    }
}
