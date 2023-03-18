<?php

$systemexpire_amcexpire_status = False;
$systemexpire_registrationexpire_status = False;
$systemexpire_demoexpire_status = False;
$systemexpire_liveexpire_status = False;
$systemexpire_totalerror_count = 0;
$current_date = date_create(date('d-m-Y'));
$amc_end_date = date_create(validate(AMCEND));
$registration_type = validate(ACTIVATIONMODE);
$registration_end_date = date_create(validate(ACTIVATIONEND));
$amc_expiration = date_diff($current_date, $amc_end_date);
$amc_expiration_status = $amc_expiration->format('%R%D');

if ($amc_expiration_status < 0) {
    $systemexpire_amcexpire_status = True;
    $systemexpire_totalerror_count = $systemexpire_totalerror_count + 1;
}

$reigstration_expiration = date_diff($current_date, $registration_end_date);
$reigstration_expiration_status = $reigstration_expiration->format('%R%D');


if ($reigstration_expiration_status < 0) {
    $systemexpire_registrationexpire_status = True;
    if ($registration_type == "LIVETESTING") {
        $systemexpire_liveexpire_status = True;
        $systemexpire_totalerror_count = $systemexpire_totalerror_count + 1;
    }
    if ($registration_type == "DEMO") {
        $systemexpire_demoexpire_status = True;
        $systemexpire_totalerror_count = $systemexpire_totalerror_count + 1;
    }
}
?>