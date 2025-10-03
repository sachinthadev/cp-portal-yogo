<?php
include('header.php');
?>
<section class="content">
    <div class="page-heading">
        <h1>QUICK TRIP</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li class="active">Quick Trip</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Trip Details
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="newQuickTripForm" method="post">
                   <!-- Trip Details -->
    <h3 class="panel-inside-title">Trip Details</h3>
    <div class="form-group">
        <div class="col-sm-6">
            <label>Vehicle Type</label>
            <select id="vehicleTypeSelect" name="vehicleTypeSelect"
                    class="form-control show-tick"
                    data-live-search="true" required>
            </select>
        </div>

        <div class="col-sm-6">
            <label for="requiredTimeSelect">Required Time</label>
            <select id="requiredTimeSelect" name="requiredTimeSelect" class="form-control">
                <option value="1" selected>Immediate</option>
                <option value="2">Scheduled</option>
            </select>
        </div>
    </div>

    <div class="form-group" id="dateTimeDiv" style="display: none;">
        <div class="col-sm-6">
            <label for="tripDateTime">Scheduled Trip Date & Time</label>
            <input type="text" id="tripDateTime" name="tripDateTime"
                   class="form-control"
                   placeholder="YYYY-MM-DD HH:mm"/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6">
            <label>Pickup Location</label>
            <input type="text" id="pickupLocation" name="pickupLocation" class="form-control"
                   placeholder="Enter pickup location"/>
        </div>
        <div class="col-sm-6">
            <label>Drop Location</label>
            <input type="text" id="dropLocation" name="dropLocation" class="form-control"
                   placeholder="Enter drop location"/>
        </div>
    </div>

    <!-- Hidden Lat/Lng -->
    <input type="hidden" id="pickupLocationLat" name="pickupLocationLat"/>
    <input type="hidden" id="pickupLocationLng" name="pickupLocationLng"/>
    <input type="hidden" id="dropLocationLat" name="dropLocationLat"/>
    <input type="hidden" id="dropLocationLng" name="dropLocationLng"/>

    <div class="form-group">
        <div class="col-sm-12">
            <label>Remarks</label>
            <textarea id="remarks" name="remarks" class="form-control no-resize"
                      placeholder="Enter remarks"></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-6">
            <button type="submit" id="tripSubmitBtn" class="btn btn-block btn-success">SUBMIT</button>
        </div>
        <div class="col-xs-6">
            <button type="reset" id="tripResetBtn" class="btn btn-block btn-danger">RESET</button>
        </div>
    </div>

    <hr/>
    <input type="hidden" id="estimateId" name="estimateId" />

                </form>
            </div>
        </div>
    </div>
</section>
<?php
include('default-imports.php');
?>

<!--Google Map-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDNwCv-VFlb6sKsDpbt8ptidHZOS_ETuI&libraries=places"></script>
<script src="../js/quick-trip.js" type="module"></script>



<!-- Flatpickr CSS + JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
$(function () {
   flatpickr("#tripDateTime", {
    enableTime: true,
    time_24hr: true,
    enableSeconds: false,   
    dateFormat: "Y-m-d H:i", 
    defaultDate: new Date()
});


    // Show/hide Scheduled Date/Time based on dropdown
    $('#requiredTimeSelect').on('change', function () {
        $('#dateTimeDiv').toggle(this.value === "2");
    }).trigger('change');
});
</script>

</body>

</html>