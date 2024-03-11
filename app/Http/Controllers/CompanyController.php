<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCompanyRequest;
use App\Http\Requests\CompanyProductRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @group Company management
 *
 * APIs for managing users
 */

class CompanyController extends Controller
{
    
    /**
     * Adds a new company to the database
     *
     * @param AddCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public  function add(AddCompanyRequest $request)
    {
        $copmany = Company::create($request->validated());

        return response()->json([

            'message' => 'Success'
        ], 200);
    }
    /**
     * Updates an existing company in the database
     *
     * @param UpdateCompanyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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
    /**
     * Adds a new product to the specified company
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createProduct(CompanyProductRequest $request)
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
