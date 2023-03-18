<?php

function number_to_words($number) {
    if ($number > 999999999) {
        throw new Exception("Number is out of range");
    }

    $Gn = floor($number / 1000000);  /* Millions (giga) */
    $number -= $Gn * 1000000;

    $ln = floor($number / 100000);  /* lakh */
    $number -= $ln * 100000;

    $kn = floor($number / 1000);     /* Thousands (kilo) */
    $number -= $kn * 1000;

    $Hn = floor($number / 100);      /* Hundreds (hecto) */
    $number -= $Hn * 100;

    $Dn = floor($number / 10);       /* Tens (deca) */
    $n = $number % 10;
    /* Ones */
    $cn = round(($number - floor($number)) * 100); /* Cents */
    $result = "";

    if ($Gn) {
        $result .= number_to_words($Gn) . " Crore";
    }

    if ($ln) {
        $result .= number_to_words($ln) . " Lakh";
    }

    if ($kn) {
        $result .= (empty($result) ? "" : " ") . number_to_words($kn) . " Thousand";
    }

    if ($Hn) {
        $result .= (empty($result) ? "" : " ") . number_to_words($Hn) . " Hundred";
    }

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
        "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
        "Seventy", "Eigthy", "Ninety");

    if ($Dn || $n) {
        if (!empty($result)) {
            $result .= " and ";
        }

        if ($Dn < 2) {
            $result .= $ones[$Dn * 10 + $n];
        } else {
            $result .= $tens[$Dn];
            if ($n) {
                $result .= "-" . $ones[$n];
            }
        }
    }

    if ($cn) {
        if (!empty($result)) {
            $result .= ' and ';
        }
        $title = $cn == 1 ? 'Paise ' : 'Paise';
        $result .= strtolower(number_to_words($cn)) . ' ' . $title;
    }

    if (empty($result)) {
        $result = "zero";
    }

    return $result;
}

?>