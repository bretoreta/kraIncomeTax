<?php

namespace App\Http\Controllers;

use App\Services\TaxCalculatorService;
use Illuminate\Http\Request;

class TaxCalculatorController extends Controller
{
    // Public function called from the controller
    public function index(Request $request)
    {
        // Use Laravel's inbuilt validator function to validate the data received
        $request->validate([
            'paye' => ['required','numeric'],
            'reliefs' => ['required','numeric'],
            'allowances' => ['required','numeric'],
        ]);

        // Use the TaxCalculatorService to work on the data and return the results
        return (new TaxCalculatorService())->calculate($request);
    }
}
