<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;

class WalletController extends Controller
{

    public function create()
    {
        return view('create_wallet');
    }


    public function store(StoreWalletRequest $request)
    {
        $wallet = Wallet::create([
            'user_id' => session('user_id'),
            'sheba' => $request->input('sheba'),
            'balance' => $request->input('balance'),
        ]);

        return redirect()->route('dashboard', session('user_id'))->with('success', 'کیف پول با موفقیت ایجاد شد.');
    }

}
