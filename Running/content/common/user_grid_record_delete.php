<?php

include'../../template/common/header.default_action.php';
$Query = "delete from " . $_REQUEST["tablename"] . " where id=" . $_REQUEST["id"];
$UDB->query($Query);
$FN->page_redirect($_REQUEST["returnpage"]);
?>