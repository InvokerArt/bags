<?php

namespace App\Http\Controllers\Wap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
    public function show(Company $company)
    {
        return view('wap.companies.show', compact('company'));
    }
}
