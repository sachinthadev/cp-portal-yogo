<?php
include('header.php');
$tripID = null;
$showBreakDown = null;
if (isset($_GET['id'])) {
    $tripID = $_GET['id'];
}

if (isset($_GET['showBreakDown'])) {
    $showBreakDown = $_GET['showBreakDown'];
}
?>
?>
<section class="content">
    <div class="page-heading">
        <h1>TRIP DETAIL OF BOOKING ID : <?php echo $tripID; ?></h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li class="active">Trip Detail</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Trip Details
            </div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="alert align-center" role="alert">
                            </div>
                        </div>
                    </div>
                    <h3 class="panel-inside-title">Passenger Details</h3>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Passenger Name</label>
                            <input type="text" id="passengerName" name="passengerName" class="form-control" readonly="readonly" />
                        </div>
                        <div class="col-sm-4">
                            <label>Passenger Contact No</label>
                            <input type="text" id="passengerContactNo" name="passengerContactNo" class="form-control" readonly="readonly" />
                        </div>
                        <div class="col-sm-4">
                            <label>Department</label>
                            <input type="text" id="department" name="department" class="form-control" readonly="readonly" />
                        </div>
                    </div>
                    <h3 class="panel-inside-title">Trip Details</h3>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Booking ID</label>
                            <input type="text" id="bookingId" name="bookingId" class="form-control" <?php
                                                                                                    echo 'value="' . $tripID . '"';
                                                                                                    ?> readonly="readonly" />
                        </div>
                        <div class="col-sm-6">
                            <label>Vehicle No</label>
                            <input type="text" id="vehicleNo" name="vehicleNo" class="form-control" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Trip Started Time</label>
                            <input type="text" id="tripStartTime" name="tripStartTime" class="form-control" readonly="readonly" />
                        </div>
                        <div class="col-sm-6">
                            <label>Trip End Time</label>
                            <input type="text" id="tripEndTime" name="tripEndTime" class="form-control" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label>Trip Start Location</label>
                            <input type="text" id="tripStartLoc" name="tripStartLoc" class="form-control" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label>Trip End Location</label>
                            <input type="text" id="tripEndLoc" name="tripEndLoc" class="form-control" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Trip Distance (Km)</label>
                            <input type="text" id="tripDistance" name="tripDistance" class="form-control set-text-right" readonly="readonly" />
                        </div>
                        <div class="col-sm-4">
                            <label>Base Fare</label>
                            <input type="text" id="baseFare" name="baseFare" class="form-control set-text-right" readonly="readonly" />
                        </div>
                        <div class="col-sm-4">
                            <label>Additional Distance Fare</label>
                            <input type="text" id="additionalDistanceFare" name="additionalDistanceFare" class="form-control set-text-right" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Waiting Minutes (s)</label>
                            <input type="text" id="waitingMin" name="waitingMin" class="form-control set-text-right" readonly="readonly" />
                        </div>
                        <div class="col-sm-4">
                            <label>Waiting Time Charge</label>
                            <input type="text" id="waitingTimeCharge" name="waitingTimeCharge" class="form-control set-text-right" readonly="readonly" />
                        </div>
                    </div>
                    <br />
                    <h3 class="panel-inside-title">Charge Summary</h3>
                    <div class="form-group" >
                        <div class="col-sm-12">
                            <table id="additionalChargesTable" class="table table-striped table-hover dataTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>Charge Description</th>
                                        <th>Charge Cost (Rs)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Charge Description</th>
                                        <th>Charge Cost (Rs)</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label id="extraChargeInvoice1">Extra Charge (Rs)</label>
                            <input type="text" id="extraChargeInvoice" name="extraChargeInvoice" class="form-control set-text-right" readonly="readonly" />
                        </div>
                        <div class="col-sm-4">
                            <label id="hireAmount1">Hire Charge (Rs)</label>
                            <input type="text" id="hireAmount" name="hireAmount" class="form-control set-text-right" readonly="readonly" />
                        </div>
                        <div class="col-sm-4">
                            <label>Trip Total Amount (Rs)</label>
                            <input type="text" id="invoiceTotalAmount" name="invoiceTotalAmount" class="form-control set-text-right" readonly="readonly" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="button" id="tripRouteBtn" class="btn btn-block btn-warning">Draw Trip Route
                            </button>
                        </div>
                        <!--                        <div class="col-sm-12">-->
                        <!--                            <button type="button" id="cancelTripBtn" class="btn btn-block btn-danger" >Cancel Trip-->
                        <!--                            </button>-->
                        <!--                        </div>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script> 
const sessionCompanyId = <?php echo $_SESSION["YogoCorpCompanyId"] ?>
</script>
<?php
include('default-imports.php');

?>
<script src="../js/trip-detail.js" type="module"></script>
</body>

</html>