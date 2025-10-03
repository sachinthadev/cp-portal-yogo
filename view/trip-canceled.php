<?php
include_once('header.php');
?>
<link href="../style/table-mobile.css" rel="stylesheet"/>
<section class="content">
    <div class="page-heading">
        <h1>TRIP CANCELED</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="javascript:void(0);">Trip Management</a></li>
            <li class="active">Trip Canceled</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Trips
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group has-feedback">
                        <div class="col-sm-6">
                            <label>Select Date Range</label>
                            <input type="text" class="form-control js-daterange-picker" id="tripsDateRange"/>
                            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table id="tripsTable" class="table table-striped table-hover dataTable" width="100%" hidden>
                        <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Requested Start Location</th>
                            <th>Requested End Location</th>
                            <th>Requested Time</th>
                            <th>Trip Distance</th>
                            <th>Total Amount</th>
                            <th>Passenger</th>
                            <th>Remarks</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Booking ID</th>
                            <th>Requested Start Location</th>
                            <th>Requested End Location</th>
                            <th>Requested Time</th>
                            <th>Trip Distance</th>
                            <th>Total Amount</th>
                            <th>Passenger</th>
                            <th>Remarks</th>
                        </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once('default-imports.php');
?>
<!-- Custom js -->
<script src="../js/trip-canceled.js" type="module"></script>
</body>

</html>

