<?php
include_once('header.php');
?>
<section class="content">
    <div class="page-heading">
        <h1>DASHBOARD</h1>
    </div>

    <div class="page-body">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box infobox-type-5">
                    <a href="quick-trip.php">
                    <div class="icon"><i class="material-icons col-warning">directions_run</i></div>
                    <div class="content">
                        <div class="text">Shortcut</div>
                        <div class="number">QUICK BOOKING</div>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="info-box infobox-type-5">
                    <a href="my-trips.php">
                        <div class="icon"><i class="material-icons col-warning">person_pin</i></div>
                        <div class="content">
                            <div class="text">Shortcut</div>
                            <div class="number">MY TRIPS</div>
                        </div>
                    </a>
                </div>
            </div>
<!--            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">-->
<!--                <div class="info-box infobox-type-5">-->
<!--                    <a href="#">-->
<!--                        <div class="icon"><i class="material-icons col-success">add</i></div>-->
<!--                        <div class="content">-->
<!--                            <div class="text">Shortcut</div>-->
<!--                            <div class="number">UNDEFINED</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">-->
<!--                <div class="info-box infobox-type-5">-->
<!--                    <a href="#">-->
<!--                        <div class="icon"><i class="material-icons col-success">add</i></div>-->
<!--                        <div class="content">-->
<!--                            <div class="text">Shortcut</div>-->
<!--                            <div class="number">UNDEFINED</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">-->
<!--                <div class="info-box infobox-type-5">-->
<!--                    <a href="#">-->
<!--                        <div class="icon"><i class="material-icons col-success">add</i></div>-->
<!--                        <div class="content">-->
<!--                            <div class="text">Shortcut</div>-->
<!--                            <div class="number">UNDEFINED</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">-->
<!--                <div class="info-box infobox-type-5">-->
<!--                    <a href="#">-->
<!--                        <div class="icon"><i class="material-icons col-success">add</i></div>-->
<!--                        <div class="content">-->
<!--                            <div class="text">Shortcut</div>-->
<!--                            <div class="number">UNDEFINED</div>-->
<!--                        </div>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</section>

<?php
include_once('default-imports.php');
?>
<!-- Custom js -->
<script src="../js/dashboard.js"></script>


<script>
    window.sessionData = {
        company_id: "<?php echo $_SESSION['company_id']; ?>",
        employee_id: "<?php echo $_SESSION['employee_id']; ?>",
        email: "<?php echo $_SESSION['email']; ?>"
    };
</script>

</body>

</html>
