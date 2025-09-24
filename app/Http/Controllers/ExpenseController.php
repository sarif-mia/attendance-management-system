<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Expense;
use Auth;
class ExpenseController extends Controller {
    public function index() {
        $expenses = Expense::where('user_id', Auth::id())->latest()->get();
        return view('admin.expenses', compact('expenses'));
    }
    public function create() {
        return view('admin.create_expense');
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric',
        ]);
        Expense::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('expense.index')->with('success', 'Expense added!');
    }
}
