<script>
    function refreshpage() {
        location.reload();
    }
</script>
<div class="user-panel">
    <div class="pull-left image">
        <img src="../../theme/img/srinfosoft_icon.png" class="img-rounded" alt="User Image" onclick="refreshpage()" />
    </div>
    <div class="pull-left info" style="padding:7px 0px 0px 5px;">
        <p><a href="<?php echo validate(COMPANYURL) ?>" style="color:#000000;" target="_blank"><?php echo validate(SYSTEMNAME) . " " . validate(VERSION) ?></a></p>
        <a href="<?php echo validate(COMPANYURL) ?>" style="color:#000000;" target="_blank">Powerd by : <?php echo validate(COMPANYNAME) ?></a>
    </div>
</div>
</section>
<!-- /.sidebar -->
</aside>