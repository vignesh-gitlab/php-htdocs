<?php

class Database {

    var $Host = HOSTNAME;
    var $Database = DATABASE;
    var $User = USERNAME;
    var $Password = PASSWORD;
    var $Link_ID = 0;  // Result of mysql_connect().
    var $Query_ID = 0;  // Result of most recent mysql_query().
    var $Record = array();  // current mysql_fetch_array()-result.
    var $Row;           // current row number.
    var $LoginError = "";
    var $Errno = 0;  // error state of query...
    var $Error = "";

//-------------------------------------------
//    Connects to the database
//-------------------------------------------
    function connect() {
        if (0 == $this->Link_ID)
            $this->Link_ID = mysql_connect(validate($this->Host), validate($this->User), validate($this->Password));
        if (!$this->Link_ID)
            $this->halt("Link-ID == false, connect failed");
        if (!mysql_query(sprintf("use %s", validate($this->Database)), $this->Link_ID))
            $this->halt("cannot use database " . validate($this->Database));
    }

// end function connect
//-------------------------------------------
//    Queries the database
//-------------------------------------------
    function query($Query_String) {
        $this->connect();
        $this->Query_ID = mysql_query($Query_String, $this->Link_ID);
        $this->Row = 0;
        $this->Errno = mysql_errno();
        $this->Error = mysql_error();
        if (!$this->Query_ID)
            $this->halt("Invalid SQL: " . $Query_String);
        return $this->Query_ID;
    }

// end function query
//-------------------------------------------
//    If error, halts the program
//-------------------------------------------
    function halt($msg) {
        printf("</td></tr></table><b>Database error:</b> %s<br>n", $msg);
        printf("<b>MySQL Error</b>: %s (%s)<br>", $this->Errno, $this->Error);
        die("Session Halted.");
    }

// end function halt
//-------------------------------------------
//    Retrieves the next record in a recordset
//-------------------------------------------
    function Singlecoloumn() {
        @ $this->Record = mysql_fetch_array($this->Query_ID);
        $this->Row += 1;
        $this->Errno = mysql_errno();
        $this->Error = mysql_error();
        $stat = is_array($this->Record);
        if (!$stat) {
            @ mysql_free_result($this->Query_ID);
            $this->Query_ID = 0;
        }
        return $stat;
    }

// end function Singlecoloumn
//-------------------------------------------
//    Retrieves a single record
//-------------------------------------------
    function singleRecord() {
        $this->Record = mysql_fetch_array($this->Query_ID);
        $stat = is_array($this->Record);
        return $stat;
    }

// end function singleRecord
//-------------------------------------------
//    Returns the number of rows  in a recordset
//-------------------------------------------
    function numRows() {
        return mysql_num_rows($this->Query_ID);
    }

// end function numRows	        

    function Multicoloums() {
        while (@ $this->Record = mysql_fetch_assoc($this->Query_ID)) {
            $this->Row += 1;
            $this->Errno = mysql_errno();
            $this->Error = mysql_error();
            $stat = is_array($this->Record);
            if (!$stat) {
                @ mysql_free_result($this->Query_ID);
                $this->Query_ID = 0;
            }
            return $stat;
        }
    }

// end function Multicoloums

    function Generalselect() {
        @ $this->Record = mysql_fetch_array($this->Query_ID);
        $this->Row += 1;
        $this->Errno = mysql_errno();
        $this->Error = mysql_error();
        $stat = is_array($this->Record);
        if (!$stat) {
            @ mysql_free_result($this->Query_ID);
            $this->Query_ID = 0;
        }
        return $this->Record[0];
    }

//end of function general id
}

// end class Database
?> 