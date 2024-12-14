<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        $userCount = User::count();
        $walletCount = Wallet::count();
        $transactionCount = Transaction::count();
        $pendingTransactionCount = Transaction::where('status', 'pending')->count();
        $recentPendingTransactions = Transaction::where('status', 'pending')->with(['senderWallet', 'receiverWallet'])->latest()->take(5)->get();
        return view('panel.admin', compact('userCount', 'walletCount', 'transactionCount', 'pendingTransactionCount', 'recentPendingTransactions'));
    }

    public function userIndex()
    {
        $users = User::all();
        return view('panel.users', compact('users'));
    }

    public function userUpdateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        DB::table('users')->where('id', $user->id)->update(['role' => $request->role]);
        return redirect()->route('admin.users.index')->with('success', "نقش $user->name با موفقیت تغییر کرد.");
    }

    public function userDestroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "کاربر $user->name حذف شد.");
    }

    public function walletIndex()
    {
        $wallets = Wallet::all();

        return view('panel.wallets', compact('wallets'));
    }

    public function transactionIndex()
    {
        $pendingTransactions = Transaction::where('status', 'pending')->with(['senderWallet.user', 'receiverWallet.user'])->get();

        $approvedTransactions = Transaction::where('status', 'approved')->with(['senderWallet.user', 'receiverWallet.user'])->get();

        $rejectedTransactions = Transaction::where('status', 'rejected')->with(['senderWallet.user', 'receiverWallet.user'])->get();

        return view('panel.transactions', compact('pendingTransactions', 'approvedTransactions', 'rejectedTransactions'));
    }

    public function pendingTransactionIndex()
    {
        $pendingTransactions = Transaction::where('status', 'pending')->with(['senderWallet.user', 'receiverWallet.user'])->get();
        return view('panel.pending', compact('pendingTransactions'));
    }

    public function transactionApprove(Transaction $transaction)
    {
        if ($transaction->status === 'pending') {
            $senderWallet = $transaction->senderWallet;
            $receiverWallet = $transaction->receiverWallet;

            $senderWallet->balance -= $transaction->amount;
            $receiverWallet->balance += $transaction->amount;

            $senderWallet->save();
            $receiverWallet->save();

            DB::table('transactions')->where('id', $transaction->id)->update(['status' => 'approved']);
        }

        return redirect()->back()->with('success', 'تراکنش با موفقیت تایید شد.');
    }

    public function transactionReject(Transaction $transaction)
    {
        if ($transaction->status === 'pending') {
            DB::table('transactions')->where('id', $transaction->id)->update(['status' => 'rejected']);
        }

        return redirect()->back()->with('success', 'تراکنش با موفقیت رد شد.');
    }

}
