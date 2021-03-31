<?php

require 'Rates.php';


echo("=================================================================================================== \r\n");
echo("    ::: Welcome to the Gross Monthly pay calculator. Please enter all the required values ::: \r\n");
echo("=================================================================================================== \r\n");
$paye = readline("Enter your PAYE : \r\n");
$relief = readline("Enter your total Reliefs : \r\n");
$allowances = readline("Enter your total Allowances : \r\n");

    // Check to see if relief is empty or null and set it to zero as relief can be zero
    if(empty($relief) || is_null($relief))
    {
        $relief = 0;
    }

    // Check to confirm that all required inputs are present are numeric
    if(!(is_numeric($paye) && is_numeric($relief) && is_numeric($allowances)))
    {
        echo("\r\n");
        echo("\r\n");
        echo("=================================================================================================== \r\n");
        echo("          ::: Task Breaked - An error occured ::: \r\n");
        echo("=================================================================================================== \r\n");

        // Break the program incase one or more of the required fields is(are) not numeric
        exit("All the values must be integers! Please restart the program. \r\n");
    }
    // Calculate the gross tax value that is displayed at the end of calculation
    $grossTaxFinal = $paye + $relief;
    // Calculate the gross tax that will be used by the various defined functions to compute Gross Income
    $grossTax = $paye + $relief;

    // Calculate the amount that is taxable for every tier
    $taxed1 = TIER1 * 0.1;
    $taxed2 = TIER2 * 0.25;
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
        $grossIncomeCalc += calculateIncomeFromTier1();
        //Reduce the taxable income for next step
        $grossTax -= $taxed1;

        if($grossTax <= $taxed2)
        {
            $grossIncomeCalc += $grossTax / 0.25;
        }
        else if ($grossTax > $taxed2)
        {
            // Call the method for Tier 2 calculation
            $grossIncomeCalc += calculateIncomeFromTier2();
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

    echo("\r\n");
    echo("\r\n");
    echo("=================================================================================================== \r\n");
    echo("          ::: Task Completed ::: \r\n");
    echo("=================================================================================================== \r\n");
    echo("Your gross tax is : Ksh." . $grossTaxFinal . "\r\n");
    echo("Your basic salary is : Ksh." . $basicSalary . "\r\n");
    echo("Your gross income is : Ksh." . $grossIncomeCalc . "\r\n");