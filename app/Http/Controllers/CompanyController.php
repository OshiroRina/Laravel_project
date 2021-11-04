<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * 会社一覧
     * @return view
     */
    public function companyList()
    {
        $companies = Company::all();
        return view('companyList');
        // return view('product.list',['companies' => $companies]); 
       
           
    }
}
