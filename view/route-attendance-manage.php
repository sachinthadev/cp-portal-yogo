<?php
include_once('header.php');
?>
<link href="../style/table-mobile.css" rel="stylesheet"/>
<section class="content">
    <div class="page-heading">
        <h1>MANAGE ATTENDANCE</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="javascript:void(0);">Shuttle Service</a></li>
            <li class="active">Manage Attendance</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Attendance List
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group has-feedback">
                        <div class="col-sm-4">
                            <label>Select Date</label>
                            <input type="text" placeholder="Please choose a date..." data-format="YYYY-MM-DD"
                                   class="form-control js-dtp" id="datePicker"/>
                            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                        </div>
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-6">
                            <label>Department</label>
                            <select id="departmentSelect" name="departmentSelect"
                                    class="form-control selectpicker show-tick" data-live-search="true" required>
                                <option value="" selected disabled>-- Please select department--</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table id="routeTable" class="table table-striped table-hover dataTable" width="100%" hidden>
                        <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Pickup Route</th>
                            <th>Drop Off Route</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Pickup Route</th>
                            <th>Drop Off Route</th>
                        </tr>
                        </tfoot>

                    </table>
                </div>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <button type="submit" id="saveManageAttendanceBtn" class="btn btn-block btn-success">SUBMIT
                            </button>
                        </div>
                        <div class="col-xs-6">
                            <button type="reset" id="manageAttendanceResetBtn" class="btn btn-block btn-danger">RESET</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once('default-imports.php');
?>
<!-- Custom js -->
<script src="../js/route-attendance-manage.js" type="module"></script>
</body>

</html>

