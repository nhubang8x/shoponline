<?php if(!isset($_SESSION['admin'])) header("Location: .");?>
<section id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php navadmin();?>
    </nav>
    <section id="page-wrapper">
        <?php contentadmin();?>
    </section>
    <!-- /#page-wrapper -->
</section>