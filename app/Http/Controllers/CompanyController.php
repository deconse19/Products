<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public  function index()
    {
        $company = Company::all();

        return response()->json($company);
    }
    public  function add(AddCompanyRequest $request)
    {
        $copmany = Company::create($request->validated());

        return response()->json([

            'message' => 'Success'
        ], 200);
    }
    public  function update(UpdateCompanyRequest $request)
    {
        $compay = Company::find($request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location

        ]);

        return response()->json([

            'message' => 'Success'
        ], 200);
    }

    public function createProduct(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $company = Company::findOrFail($request->company_id);

        $company->products()->attach($product);

        return response()->json([
            'success' => true,
            'message' => 'Product added to company successfully'
        ]);
    }
}
