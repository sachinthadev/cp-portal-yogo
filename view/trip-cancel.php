<?php
include_once('header.php');
?>
<link href="../style/table-mobile.css" rel="stylesheet"/>
<section class="content">
    <div class="page-heading">
        <h1>CANCEL TRIPS</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="javascript:void(0);">Trip Management</a></li>
            <li class="active">Cancel Trips</li>
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
                            <th>Trip Start Location</th>
                            <th>Trip End Location</th>
                            <th>Trip Start Time</th>
                            <th>Trip Distance</th>
                            <th>Passenger</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Cancel</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Booking ID</th>
                            <th>Trip Start Location</th>
                            <th>Trip End Location</th>
                            <th>Trip Start Time</th>
                            <th>Trip Distance</th>
                            <th>Passenger</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Cancel</th>
                        </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tripCancelModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel2">Cancel Booking</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group" >
                            <div class="col-sm-6">
                                <label>Booking Id</label>
                                <input type="text" id="bookingId" name="bookingId" class="form-control"
                                       placeholder="Enter booking id" required/>
                            </div>
                            <div class="col-sm-6" hidden>
                                <label>Confirm Booking Id</label>
                                <input type="text" id="confirmBookingId" name="confirmBookingId" class="form-control"
                                       placeholder="Enter booking id" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Why do you want to cancel the booking ?</label>
                                <textarea id="reason" name="reason" class="form-control no-resize" cols="8" rows="3"
                                          placeholder="Enter the reason for cancel the booking." required></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cancelBtn" class="btn btn-link">Submit</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once('default-imports.php');
?>
<!-- Custom js -->
<script src="../js/trip-cancel.js" type="module"></script>
</body>

</html>

