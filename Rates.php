<?php

// Get values and assign them to variables
const TIER1 = 24000.00;
const TIER2 = 40666.67;
const TIER3 = 57333.34;


//Function for calculation of income from tier One
function calculateIncomeFromTier1($grossTax)
{
    $grossIncome = 0;

    //Check if value of tax is less than Tier1
    if($grossTax < TIER1)
    {
        $grossIncome += TIER1 - $grossTax;
    }
    if($grossTax >= TIER1)
    {
        $grossIncome += TIER1;
    }

    return $grossIncome;
}


//Function for calculation of income from tier Two
function calculateIncomeFromTier2($grossTax)
{
    $grossIncome = 0;

    //Check if value of tax is less than Tier2
    if($grossTax < TIER2)
    {
        $grossIncome += TIER2 - $grossTax;
    }
    if($grossTax >= TIER2)
    {
        $grossIncome += TIER2;
    }

    return $grossIncome;
}


//Function for calculation of income from tier Three
function calculateIncomeFromTier3($grossTax)
{
    $grossIncome = 0;

    //Check if value of tax is less than Tier3
    if($grossTax < TIER3)
    {
        $grossIncome += TIER3 - $grossTax;
    }
    if($grossTax >= TIER3)
    {
        $grossIncome += TIER3;
    }

    return $grossIncome;
}

//Function for calculation of income from tier Four
function calculateIncomeFromTier4($grossTax)
{

    $grossIncome = 0;

    //Check if value of tax is greater than Tier3
    if($grossTax > TIER3)
    {
        $grossIncome += $grossTax - TIER3;
    }

    return $grossIncome;
}