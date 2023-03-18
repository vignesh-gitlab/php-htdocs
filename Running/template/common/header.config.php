<?php

include'../../settings/config.theme.php';
include '../../functions/general/general.php';
include'../../settings/config.product.php';
include '../../settings/config.srinfosoft.php';
include '../../settings/config.db.php';
include '../../settings/config.sms.php';
include '../../class/database.inc.php';
$DB = new Database;
$DB1 = new Database;
$DB2 = new Database;
include '../../class/function.inc.php';
$FN = new Functions;

$FN->disable_error();
$FN->session_enable();
$FN->set_timezone();

include'../../functions/general/number_to_word.php';
include'../../functions/general/db_backup.php';

$delete_page = '../common/grid_record_delete.php';
?>
