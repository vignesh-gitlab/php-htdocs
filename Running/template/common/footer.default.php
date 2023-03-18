</div><!-- ./wrapper -->


<!-- jQuery 2.0.2 -->
<script language="JavaScript" src="../../theme/js/jquery202.min.js" type="text/JavaScript"></script>
<script src="../../theme/js/chosen.jquery.js" type="text/javascript"></script>
<!-- jQuery UI 1.10.3 -->
<script src="../../theme/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="../../theme/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="../../theme/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="../../theme/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="../../theme/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- fullCalendar -->
<script src="../../theme/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="../../theme/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="../../theme/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="../../theme/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../theme/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="../../theme/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="../../theme/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="../../theme/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="../../theme/js/plugins/datatables/TableTools/js/dataTables.tableTools.js"></script>
<!-- bootstrap time picker -->
<script src="../../theme/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="../../theme/js/AdminLTE/app.js" type="text/javascript"></script>
<!--date picker -->
<script type="text/javascript" src="../../theme/js/jsDatePick.min.1.3.js"></script>

<!-- page script -->
<script type="text/javascript">
    $(function () {
        $("#example1").dataTable();

        /************************************Start of Example2****************************/

        //common for All Pages whith out button
        $('#example2').DataTable({
            "lengthMenu": [[-1], ["All"]],
            dom: 'T<"clear">lfrtip',
            "oTableTools": {
                "sSwfPath": "../../theme/js/plugins/datatables/TableTools/swf/copy_csv_xls_pdf.swf",
                "sRowSelect": "multi",
                "aButtons": [
                    {
                        "sExtends": "csv",
                        "bSelectedOnly": true,
                        "sFileName": "csv_export.csv",
                        "fnComplete": function (nButton, oConfig, oFlash, sFlash) {
                            var oTT = TableTools.fnGetInstance('example2');
                            var nRow = $('#example2 tbody tr');
                            oTT.fnDeselect(nRow);
                        }
                    },
                    {
                        "sExtends": "pdf",
                        "bSelectedOnly": true,
                        "sFileName": "pdf_export.pdf",
                        "fnComplete": function (nButton, oConfig, oFlash, sFlash) {
                            var oTT = TableTools.fnGetInstance('example2');
                            var nRow = $('#example2 tbody tr');
                            oTT.fnDeselect(nRow);
                        },
                        "sPdfOrientation": "landscape",
                        "sPdfMessage": " " + ($('div.dataTables_filter input').length > 0 ? " Filter: " + $('div.dataTables_filter input').val() : "")
                    },
                ]
            },
        });

        $('a.DTTT_button_csv').mousedown(function () {
            var oTT = TableTools.fnGetInstance('example2');
            var nRow = $('#example2 tbody tr');
            oTT.fnSelect(nRow);
        });
        $('a.DTTT_button_pdf').mousedown(function () {
            var oTT = TableTools.fnGetInstance('example2');
            var nRow = $('#example2 tbody tr');
            oTT.fnSelect(nRow);
        });
        // Setup - add a text input to each footer cell
        $('#example2 tfoot th').each(function () {
            var title = $('#example2 thead th').eq($(this).index()).text();
            $(this).html('<input type="text" style="width:100%;" placeholder="' + title + '" />');
        });
        // DataTable
        var table = $('#example2').DataTable();
        // Apply the search
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on('keyup change', function () {
                that
                        .search(this.value)
                        .draw();
            });
        });

        /************************************End of Example2 ****************************/

        /************************************Start of Example3 ****************************/

        //Datatable with button - To hide first coloum in export

        $('#example3').DataTable({
            "lengthMenu": [[-1], ["All"]],
            dom: 'T<"clear">lfrtip',
            "oTableTools": {
                "sSwfPath": "../../theme/js/plugins/datatables/TableTools/swf/copy_csv_xls_pdf.swf",
                "sRowSelect": "multi",
                "aButtons": [
                    {
                        "sExtends": "csv",
                        "bSelectedOnly": true,
                        "sFileName": "csv_export.csv",
                        //displays only the selected coloums
                        "mColumns": [1, 2, 3, 4, 5, 6, 7, 8],
                        "fnComplete": function (nButton, oConfig, oFlash, sFlash) {
                            var oTT = TableTools.fnGetInstance('example3');
                            var nRow = $('#example3 tbody tr');
                            oTT.fnDeselect(nRow);
                        }
                    },
                    {
                        "sExtends": "pdf",
                        "bSelectedOnly": true,
                        "sFileName": "pdf_export.pdf",
                        //displays only the selected coloums
                        "mColumns": [1, 2, 3, 4, 5, 6, 7, 8],
                        "fnComplete": function (nButton, oConfig, oFlash, sFlash) {
                            var oTT = TableTools.fnGetInstance('example3');
                            var nRow = $('#example3 tbody tr');
                            oTT.fnDeselect(nRow);
                        },
                        "sPdfOrientation": "landscape",
                        "sPdfMessage": " " + ($('div.dataTables_filter input').length > 0 ? " Filter: " + $('div.dataTables_filter input').val() : "")
                    },
                ]
            },
        });

        $('a.DTTT_button_csv').mousedown(function () {
            var oTT = TableTools.fnGetInstance('example3');
            var nRow = $('#example3 tbody tr');
            oTT.fnSelect(nRow);
        });
        $('a.DTTT_button_pdf').mousedown(function () {
            var oTT = TableTools.fnGetInstance('example3');
            var nRow = $('#example3 tbody tr');
            oTT.fnSelect(nRow);
        });
        // Setup - add a text input to each footer cell
        $('#example3 tfoot th').each(function () {
            var title = $('#example3 thead th').eq($(this).index()).text();
            $(this).html('<input type="text" style="width:100%;" placeholder="' + title + '" />');
        });
        // DataTable
        var table = $('#example3').DataTable();
        // Apply the search
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on('keyup change', function () {
                that
                        .search(this.value)
                        .draw();
            });
        });

        /************************************End of Example3 ****************************/

    });

    $(window).load(function ()
    {
        document.getElementById("ajaxloader").style.display = "none";
    });

</script>

<script type="text/javascript" language="javascript" class="init">


    $(document).ready(function () {
        //general datatable with multi coloum filter
        $('#example').DataTable({
        });
        // Setup - add a text input to each footer cell
        var oTable1 = $('#example tfoot th').each(function () {
            var title = $('#example thead th').eq($(this).index()).text();
            $(this).html('<input type="text" style="width:100%;" placeholder="' + title + '" />');
        });
        // DataTable
        var table = $('#example').DataTable();
        // Apply the search
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on('keyup change', function () {
                that
                        .search(this.value)
                        .draw();
            });
        });

    });

    oTable1.fnSetColumnVis(0, false);
    //document.getElementById("ajaxloader_naren").style.display = "none";

</script>

<style>
    .footer_row {
        display: table-header-group;
    }
</style>

<script type="text/javascript">
    var config = {
        '.chosen-select': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>

<script type="text/javascript">
    function pick_date(id) {
        new JsDatePick({
            useMode: 2,
            target: id,
            dateFormat: "%d-%m-%Y",
            yearsRange: [1975, 2025],
            limitToToday: false,
            cellColorScheme: "torqoise",
            weekStartDay: 1
        });
    }
    ;

    $(function () {
        //Timepicker
        $(".timepicker").timepicker({
            //showInputs: false
        });
    });
</script>

<script type="text/javascript">
    /*Disable TOop Menu on Mobile Screen */
    function hide_top_menu()
    {
        var bro_width = Number(document.body.offsetWidth);
        if ((document.body.offsetWidth) < 1150)
        {
            $('#nav1').css('display', 'none');
            $('.sidebar-toggle').css('display', 'block');

        } else
        {
            $('.sidebar-toggle').css('display', 'none');
            $('#nav1').css('display', 'block');
        }
    }
    hide_top_menu();
    setInterval(hide_top_menu, 1000);

    $(".knob").knob({
        /*change : function (value) {
         //console.log("change : " + value);
         },
         release : function (value) {
         console.log("release : " + value);
         },
         cancel : function () {
         console.log("cancel : " + this.value);
         },*/
        draw: function () {

            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv)  // Angle
                        , sa = this.startAngle          // Previous start angle
                        , sat = this.startAngle         // Start angle
                        , ea                            // Previous end angle
                        , eat = sat + a                 // End angle
                        , r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor
                        && (sat = eat - 0.3)
                        && (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor
                            && (sa = ea - 0.3)
                            && (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function () {
        var $this = $(this);
        $this.sparkline('html', $this.data());
    });

    // Bar charts using inline values
    $('.sparkbar').sparkline('html', {type: 'bar'});

</script>

</body>
</html>