<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DailyTransactionsController extends Controller
{
    public function index()
    {
        return view('admin.transactions.daily');
    }
}
