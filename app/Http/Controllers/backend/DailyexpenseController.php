<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Company;
use App\Models\backend\DailyExpenses;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DailyexpenseController extends Controller
{
    public function index(Request $request)
    {


        $expenses = DailyExpenses::orderBy('dailyexpenses_id', 'desc');

        if (isset($request->company_id) && $request->company_id != '') {
            $expenses->where('company_id', $request->company_id);
        }
        if (isset($request->start_date) && isset($request->end_date)) {

            $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
            // dd($startDate,$request->start_date);
            $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);

            $expenses->whereDate('dated', '>=', $startDate)->whereDate('dated', '<=', $endDate);
        }
        $daily_expenses =  $expenses->get();

        // $daily_expenses = DailyExpenses::orderBy('dailyexpenses_id', 'desc')->get();

        $company_name = Company::pluck('company_name', 'company_id');
        return view('backend.expenses.index', compact('daily_expenses', 'company_name'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'employee_name' => 'required|required|regex:/^[a-zA-Z\s]*$/',
            'expenses_name' => 'required',
            'dated' => 'required|before:50 years',
            'amount_paid' => 'required|numeric|min:0',
            'payment_mode' => 'required',


        ]);

        $daily_expenses = new DailyExpenses;
        $daily_expenses->fill($request->all());
        $daily_expenses->save();

        return redirect()->to('admin/dailyexpenses')->with('success', 'Expense Added successfully');
    }
    public function delete($id)
    {
        $daily_expenses = DailyExpenses::findOrfail($id);
        if ($daily_expenses) {
            $daily_expenses->delete();
            return redirect()->to('admin/dailyexpenses')->with('error', 'Expense Deleted successfully');
        }
    }
}
