<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $accounts = Account::with('user')->paginate(10);
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        // Create an empty account object with default values
        $account = new \App\Models\Account();
        $account->available_balance = 0;
        $account->active_deposit = 0;
        $account->total_earnings = 0;
        $account->total_withdrawal = 0;
        $account->currency = 'USD';
        $account->kyc_status = 'Pending';
        $account->account_type = 'Basic';
        
        return view('accounts.create', compact('account'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'available_balance' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'active_deposit' => 'required|numeric|min:0',
            'total_earnings' => 'required|numeric|min:0',
            'total_withdrawal' => 'required|numeric|min:0',
            'kyc_status' => 'required',
            'account_type' => 'required',
        ]);

        $validated['user_id'] = Auth::id();
        Account::create($validated);

        return redirect()->route('accounts.index')->with('success', 'Account created successfully!');
    }

    public function show(Account $account)
    {
        return view('accounts.show', compact('account'));
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        $validated = $request->validate([
            'available_balance' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'active_deposit' => 'required|numeric|min:0',
            'total_earnings' => 'required|numeric|min:0',
            'total_withdrawal' => 'required|numeric|min:0',
            'kyc_status' => 'required|in:Pending,Verified,Rejected',
            'account_type' => 'required|in:Basic,Premium,VIP',
        ]);

        $account->update($validated);

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully!');
    }

    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully!');
    }
}