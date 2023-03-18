<?php
include'../../template/client/header.default.php';
?>
<script>
    var counter = 0;
    var myVar = setTimeout(function() {
        myTimer()
    }, 3000);

    function myTimer() {
        counter += 4;
        if (counter <= 92)
        {
            document.getElementById('progress_bar').style.width = counter + "%";
            document.getElementById("progressbar_information").innerHTML = "Backup On Progress&nbsp;" + counter + " % - Reading Values";
            setTimeout(function() {
                myTimer()
            }, 1000);
        } else if (counter == 96)
        {
            document.getElementById('progress_bar').style.width = counter + "%";
            document.getElementById("progressbar_information").innerHTML = "Backup On Progress&nbsp;" + counter + " % - Creating Backup File";
            setTimeout(function() {
                myTimer()
            }, 1000);
        } else if (counter == 100)
        {
            document.getElementById('progress_bar').style.width = counter + "%";
            document.getElementById("progressbar_information").innerHTML = "Backup Completed&nbsp;" + counter + " % - Backup File Created Successfully";
        }
    }
</script>
<aside class="right-side strech">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Backup Database
        </h1>
        <div class="client_name_head"><?PHP echo validate(CLIENTNAME); ?></div>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">Setting</li>
            <li class="active">Backup Database</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div style="height:50px"></div>
                    <div class="progress sm progress-striped active" style="height:30px; width:90%; margin:auto;">
                        <div class="progress-bar progress-bar-success" id="progress_bar" role="progressbar" aria-valuenow="100" " aria-valuemin="0" aria-valuemax="100" style="width:1%;"></div>
                    </div>
                    <div id="progressbar_information">Backup On Progress 1 % - Initializing Database</div>
                    <div style="height:50px"></div>
                    <?php
                    $backup_database_name = $_REQUEST["database_name"];
                    function_backup_tables($backup_database_name, $commonvar_dbbackup_savepath)
                    ?>

                </div><!-- /.box-body -->
            </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<?php include'../../template/common/footer.default.php'; ?>