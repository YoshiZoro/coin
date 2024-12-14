<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::with(['senderWallet.user', 'receiverWallet.user'])
        ->whereHas('senderWallet', fn($query) => $query->where('user_id', session('user_id')))
        ->orWhereHas('receiverWallet', fn($query) => $query->where('user_id', session('user_id')))->latest()->get();

        return view('transaction_history', compact('transactions'));
    }

    public function create()
    {
        $userId = session('user_id');
        $wallet = Wallet::where('user_id', $userId)->first();

        if (!$wallet) {
            return redirect()->route('dashboard')->with('error', 'کیف پولی یافت نشد.');
        }

        return view('transfer', compact('wallet'));
    }

    public function store(StoreTransactionRequest $request)
    {

        $senderWallet = Wallet::where('sheba', $request->from_sheba)->first();
        $receiverWallet = Wallet::where('sheba', $request->to_sheba)->first();

        if ($senderWallet->balance < $request->amount) {
            return redirect()->back()->withErrors(['amount' => 'مبلغ وارد شده بیشتر از موجودی شبا مبدأ است.']);
        }

        Transaction::create([
            'sender_wallet_id' => $senderWallet->id,
            'receiver_wallet_id' => $receiverWallet->id,
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        // ارسال پیام موفقیت
        return redirect()->route('dashboard', session('user_id'))->with('success', 'تراکنش شما ثبت شد و در انتظار تأیید مدیر است.');
    }

}
