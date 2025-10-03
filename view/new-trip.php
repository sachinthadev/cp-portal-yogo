<?php
include('header.php');
?>
<section class="content">
    <div class="page-heading">
        <h1>NEW TRIP</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li class="active">New Trip</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Trip Details
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="newTripForm" method="post">
                    <!--Member Details Begin-->
                   <h3 class="panel-inside-title">Member Details</h3>
    <div class="form-group">
        <div class="col-sm-4">
            <label>Department</label>
            <select id="departmentSelect" name="departmentSelect"
                    class="form-control show-tick"
                    data-live-search="true" required>
            </select>
        </div>
        <div class="col-sm-4">
            <label>Member</label>
            <select id="memberSelect" name="memberSelect"
                    class="form-control show-tick"
                    data-live-search="true" required>
            </select>
        </div>
        <div class="col-sm-4">
            <label>Branch</label>
            <select id="branchSelect" name="branchSelect"
                    class="form-control show-tick"
                    data-live-search="true" required>
            </select>
        </div>
    </div>
                    <!-- <div class="form-group" hidden>
                        <div class="col-sm-6">
                            <label>Member Mobile No</label>
                            <input type="text" id="mobileNo" name="mobileNo" class="form-control"
                                   placeholder="Enter member mobile number" pattern="[0-9]{10,10}"
                                   title="Land phone number should be included 10 digits starting from zero"
                                   maxlength="10" />
                            <div class="help-info">Ex: 0770000000</div>
                        </div>
                    </div> -->
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
    <h3 class="panel-inside-title">Trip Info</h3>
    <div class="form-group">
        <div class="col-sm-4">
            <label>Estimate Trip Time (min)</label>
            <input type="text" id="estimateTripTime" readonly class="form-control"/>
        </div>
        <div class="col-sm-4">
            <label>Estimate Trip Distance (Km)</label>
            <input type="text" id="estimateTripDistance" readonly class="form-control"/>
        </div>
        <div class="col-sm-4">
            <label>Estimate Trip Amount (LKR)</label>
            <input type="text" id="estimateTripAmount" readonly class="form-control"/>
        </div>
    </div>
    <input type="hidden" id="estimateId" name="estimateId" />

    <div id="gmapLive" class="gmap-new-trip"></div>
</form>
            </div>
        </div>
    </div>
</section>
<?php
include('default-imports.php');
?>

<!--Google Map-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDm9xhaVNxiJb1HkdnQ-PUCHphqu42f8PU&libraries=places"></script>
<!-- Custom js -->
<script src="../js/new-trip.js" type="module"></script>


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

<script>
    window.sessionData = {
        company_id: "<?php echo $_SESSION['company_id']; ?>",
        employee_id: "<?php echo $_SESSION['employee_id']; ?>",
        email: "<?php echo $_SESSION['email']; ?>"
    };
</script>
</body>

</html>