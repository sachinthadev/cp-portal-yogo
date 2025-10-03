<?php
include_once('header.php');
$tripID = null;
if (isset($_GET['id'])) {
    $tripID = $_GET['id'];
}
?>
<link href="../style/table-mobile.css" rel="stylesheet"/>
<section class="content">
    <div class="page-heading">
        <h1>TRIP ROUTE</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="javascript:void(0);">Trip Detail</a></li>
            <li class="active">Trip Route</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Trip Route
            </div>
            <div class="panel-body">
                <div class="form-group" hidden>
                    <div class="col-sm-4">
                        <label>Booking ID</label>
                        <input type="text" id="bookingId" name="bookingId" class="form-control"
                            <?php
                            echo 'value="' . $tripID . '"';
                            ?>
                               readonly="readonly"/>
                    </div>
                </div>
                <div id="gmapRoute" class="gmap"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-col-danger">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel2">ERROR</h4>
                </div>
                <div class="modal-body">
                    The trip details are not available, Please contact the YOGO support
                </div>
                <div class="modal-footer">
                    <button id="backModalBtn" type="button" class="btn btn-link">BACK</button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once('default-imports.php');
?>

<!--Google Map-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDNwCv-VFlb6sKsDpbt8ptidHZOS_ETuI&libraries=places"></script>
<!-- Custom js -->
<script src="../js/trip-route.js" type="module"></script>

</body>

</html>

