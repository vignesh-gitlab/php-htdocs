<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo validate(PRODUCTNAME) ?></title>
        <!-- favicon -->
        <link rel="icon" type="image/png" href="../../theme/img/favicon.png" />
        <!--meta-->
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Top Menu -->
        <link href="../../theme/css/menustyle.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap 3.0.2 -->
        <link href="../../theme/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../theme/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../theme/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../../theme/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../../theme/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="../../theme/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../../theme/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../../theme/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../theme/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="../../theme/js/plugins/datatables/TableTools/css/dataTables.tableTools.css">
        <!-- Bootstrap time Picker -->
        <link href="../../theme/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="../../theme/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../../theme/css/srinfosoft.css" rel="stylesheet" type="text/css" />
        <link href="../../theme/css/print.css" rel="stylesheet" type="text/css" />
        <!--datepicker -->
        <link rel="stylesheet" type="text/css" media="all" href="../../theme/css/jsDatePick_ltr.min.css" />

        <link rel="stylesheet" type="text/css" media="all" href="../../theme/css/chosen.css" />
        <!-- Google Charts -->
        <script type="text/javascript" src="../../theme/js/gstatic_loader.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
            function submit_form()
            {
                submit_but.style.display = 'none';
                clear_but.style.display = 'none';
                submit_loader.style.display = 'block';
                ajax_load.style.display = 'block';
                alert("Hello");
            }
        </script>
    </head>