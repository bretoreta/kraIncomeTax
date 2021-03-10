<?php

require 'Rates.php';

// $grossIncomeCalc = calculateIncomeFromTier1(40000);

echo("::: Welcome to the Gross Monthly pay calculator. Please enter all the required values ::: \r\n");
echo("=================================================================================================== \r\n");
$paye = readline("Enter your PAYE : \r\n");
$relief = readline("Enter your total Reliefs : \r\n");
$allowances = readline("Enter your total Allowances : \r\n");

    if(empty($relief) || is_null($relief))
    {
        $relief = 0;
    }
    if(!(is_numeric($paye) && is_numeric($relief) && is_numeric($allowances)))
    {
        echo("\r\n");
        echo("\r\n");
        echo("::: Task Breaked - An error occured ::: \r\n");
        echo("=================================================================================================== \r\n");

        exit("All the values must be integers! Please restart the program. \r\n");
    }

    $grossTax = $paye + $relief;

    if($grossTax < TIER1)
    {
        $grossIncomeCalc = calculateIncomeFromTier1($grossTax);
    }
    else
    {
        if($grossTax < TIER2)
        {
            $one = calculateIncomeFromTier1($grossTax);
            $two = calculateIncomeFromTier2($grossTax);

            $grossIncomeCalc = $one + $two;
        }

        if($grossTax < TIER3)
        {
            $one = calculateIncomeFromTier1($grossTax);
            $two = calculateIncomeFromTier2($grossTax);
            $three = calculateIncomeFromTier3($grossTax);
            
            $grossIncomeCalc = $one + $two + $three;
        }

        if($grossTax > TIER3)
        {
            $one = calculateIncomeFromTier1($grossTax);
            $two = calculateIncomeFromTier2($grossTax);
            $three = calculateIncomeFromTier3($grossTax);
            $four = calculateIncomeFromTier4($grossTax);
            
            $grossIncomeCalc = $one + $two + $three + $four;
        }
    }

    $finalGrossIncome = $grossIncomeCalc + $allowances;

echo("\r\n");
echo("\r\n");
echo("::: Task Completed ::: \r\n");
echo("======================================================================================= \r\n");
echo("Your gross tax is : Ksh." . $grossTax . "\r\n");
echo("Your gross income is : Ksh." . $finalGrossIncome . "\r\n");