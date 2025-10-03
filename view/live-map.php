<?php
include_once('header.php');
?>
<link href="../style/table-mobile.css" rel="stylesheet"/>
<section class="content">
    <div class="page-heading">
        <h1>LIVE MAP</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="javascript:void(0);">Trip Management</a></li>
            <li class="active">Live Map</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Live Trips (Automatically updates in one minute)
            </div>
            <div class="panel-body">
                <div id="gmapLive" class="gmap"></div>
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
<script src="../js/live-map.js" type="module"></script>

</body>

</html>

