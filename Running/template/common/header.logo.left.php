<body <?php
echo SELECTEDSKIN;
echo CONTEXTMENU;
?>>
    <!-- header logo: style can be found in header.less -->
    <header class="header">
        <a href="<?php echo validate(PRODUCTURL) ?>" class="logo" onclick="refreshpage()">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            <img src="../../theme/img/logo_left.png" alt="Logo"/>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
