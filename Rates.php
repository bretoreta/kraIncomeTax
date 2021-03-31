<?php

// Define the upperclass boundaries for the tiers
const TIER1 = 24000.00;
const TIER2 = 32333.00;


//Function for calculation of income from tier One
function calculateIncomeFromTier1()
{
    $grossIncome = 0;
    $grossIncome += TIER1;

    return $grossIncome;
}


//Function for calculation of income from tier Two
function calculateIncomeFromTier2()
{
    $grossIncome = 0;
    $grossIncome += TIER2;

    return $grossIncome;
}