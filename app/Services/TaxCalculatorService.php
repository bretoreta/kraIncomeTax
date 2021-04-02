<?php

namespace App\Services;

use Illuminate\Http\Request;

class TaxCalculatorService {
    // Define the upperclass boundaries for the tiers
    const TIER1 = 24000.00;
    const TIER2 = 32333.00;

    //Function for calculation of income from tier One
    protected function calculateIncomeFromTier1()
    {
        $grossIncome = 0;
        $grossIncome += self::TIER1;

        return $grossIncome;
    }

    //Function for calculation of income from tier Two
    protected function calculateIncomeFromTier2()
    {
        $grossIncome = 0;
        $grossIncome += self::TIER2;

        return $grossIncome;
    }
    
    // Perform the calculations from the data provided from controller
    public function calculate(Request $request)
    {
        // Assign the valies from the form request to variables we can work with
        $paye = $request->input('paye');
        $reliefs = $request->input('reliefs');
        $allowances = $request->input('allowances');
        
        // Calculate the gross tax value that will be returned at the end of calculation
        $grossTaxFinal = $paye + $reliefs;
        // Calculate the gross tax that will be used by the various defined functions to compute Gross Income
        $grossTax = $paye + $reliefs;

        // Calculate the amount that is taxable for every tier
        $taxed1 = self::TIER1 * 0.1;
        $taxed2 = self::TIER2 * 0.25;
        $grossIncomeCalc = 0;

        // Check if value of gross tax is smaller than taxed in Tier1
        if($grossTax <= $taxed1)
        {
            $grossIncomeCalc += $grossTax / 0.1;
        }

        // Check if value of gross tax is bigger than taxed in Tier1
        else if($grossTax > $taxed1)
        {
            // Call the method for Tier 1 calculation
            $grossIncomeCalc += $this->calculateIncomeFromTier1();
            //Reduce the taxable income for next step
            $grossTax -= $taxed1;

            if($grossTax <= $taxed2)
            {
                $grossIncomeCalc += $grossTax / 0.25;
            }
            else if ($grossTax > $taxed2)
            {
                // Call the method for Tier 2 calculation
                $grossIncomeCalc += $this->calculateIncomeFromTier2();
                //Reduce the taxable income for next step
                $grossTax -= $taxed2;

                if($grossTax > $taxed2)
                {
                    $grossIncomeCalc += $grossTax / 0.30;
                }
            }
        }

        //Calculate the basic salary given the gross salary and allowances
        $basicSalary = $grossIncomeCalc - $allowances;

        // Merge the calculated values into an array to be able to be passed to view
        $data = [
            'grossTax' => $grossTaxFinal,
            'basicSalary' => $basicSalary,
            'grossIncome' => $grossIncomeCalc,
        ];

        return $data;
    }
}