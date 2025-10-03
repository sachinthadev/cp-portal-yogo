<?php
include_once('header.php');
?>
<link href="../style/table-mobile.css" rel="stylesheet"/>
<section class="content">
    <div class="page-heading">
        <h1>ACTIVE TRIPS</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="javascript:void(0);">Trip Management</a></li>
            <li class="active">Active Trips</li>
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
                       
                    </div>
                </div>
                <div class="col-sm-12">
                    <table id="tripsTable" class="table table-striped table-hover dataTable" width="100%" hidden>
                        <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Pickup Address</th>
                            <th>Drop Address</th>
                            <th>Employee Name</th>
                            <th>Start Time</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="tripsTableBody">
                        <!-- Filled by trips-active.js -->
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Booking ID</th>
                            <th>Pickup Address</th>
                            <th>Drop Address</th>
                            <th>Employee Name</th>
                            <th>Start Time</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        </tfoot>

                    </table>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="tripCancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h4 class="modal-title" id="cancelModalLabel">Cancel Booking</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form id="tripCancelForm" class="form-horizontal">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="bookingId">Booking ID</label>
                                <input type="text" id="bookingId" name="bookingId" class="form-control" readonly/>
                            </div>
                            <div class="form-group col-sm-6 d-none">
                                <label for="confirmBookingId">Confirm Booking ID</label>
                                <input type="text" id="confirmBookingId" name="confirmBookingId" class="form-control"/>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="selectreason">Select Reason</label>
                                <select id="selectreason" name="selectreason" class="form-control" required>
                                    <option value="">-- Select Reason --</option>
                                    <option value="Driver Delayed">Driver Delayed</option>
                                    <option value="I don't want this ride now">I don't want this ride now</option>
                                    <option value="Personal matter">Personal matter</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="remark">Additional Remark</label>
                            <textarea id="remark" name="remark" class="form-control no-resize" rows="3"
                                      placeholder="Enter more details (optional)"></textarea>
                        </div>
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="cancelBtn" class="btn btn-danger">
                        <i class="fa fa-times"></i> Submit
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-close"></i> Close
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</section>
<?php
include_once('default-imports.php');
?>
<!-- Custom js -->
<script src="../js/trips-active.js" type="module"></script>
</body>

</html>

