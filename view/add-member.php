<?php
include('header.php');
?>
<section class="content">
    <div class="page-heading">
        <h1>ADD NEW MEMBER</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="javascript:void(0);">Team Management</a></li>
            <li class="active">Add New Member</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Member Details
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="memberRegisterForm" method="post">
    <!-- Personal Details -->
    <h3 class="panel-inside-title">Personal Details</h3>
    <div class="form-group">
        <div class="col-sm-4">
            <label>Employee No</label>
            <input type="text" id="employeeNo" name="employee_no" class="form-control"
                   placeholder="Enter employee no" required/>
        </div>
        <div class="col-sm-2">
            <label>Title</label>
            <select id="titleSelect" name="title" class="form-control selectpicker show-tick" required>
                <option value="">-- Select --</option>
                <option value="Ven.">Ven.</option>
                <option value="Mr.">Mr.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Ms.">Ms.</option>
                <option value="Dr.">Dr.</option>
                <option value="Prof.">Prof.</option>
            </select>
        </div>
        <div class="col-sm-6">
            <label>Full Name</label>
            <input type="text" id="employeeName" name="employee_name" class="form-control"
                   placeholder="Enter employee name" required/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-6">
            <label>Call Name</label>
            <input type="text" id="callName" name="call_name" class="form-control"
                   placeholder="Enter call name" required/>
        </div>
        <div class="col-sm-6">
            <label>Contact No</label>
            <input type="text" id="phoneNo" name="phone_no" class="form-control"
                   placeholder="Enter contact No" pattern="[0-9]{10}"
                   title="Phone number should have 10 digits" maxlength="10" required/>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12">
            <label>Email</label>
            <input type="email" id="email" name="email" class="form-control"
                   placeholder="Enter email address"/>
        </div>
    </div>

    <!-- Department & Branch -->
    <h3 class="panel-inside-title">Department & Branch</h3>
    <div class="form-group">
        <div class="col-sm-6">
            <label>Department</label>
            <select id="departmentSelect" name="department_id"
                    class="form-control selectpicker show-tick" required>
                <option value="">-- Select Department --</option>
                <!-- populate dynamically -->
            </select>
        </div>
        <div class="col-sm-6">
            <label>Branch</label>
            <select id="branchSelect" name="branch_id"
                    class="form-control selectpicker show-tick" required>
                <option value="">-- Select Branch --</option>
                <!-- populate dynamically -->
            </select>
        </div>
    </div>

    <!-- Permissions -->
    <h3 class="panel-inside-title">User Details</h3>
    <div class="form-group">
        <div class="col-sm-6">
            <label>User Type</label>
            <select id="userTypeSelect" name="user_type"
                    class="form-control selectpicker show-tick" required>
                <option value="">-- Select User Type --</option>
                <option value="1">Administrator</option>
                <option value="2">Department Head</option>
                <option value="3">Employee</option>
            </select>
        </div>
        <div class="col-sm-6">
            <label>Credit Limit (Rs)</label>
            <input type="number" id="creditLimit" name="credit_limit" class="form-control"
                   placeholder="Enter credit limit" required/>
        </div>
    </div>

    <!-- Status -->
    <div class="form-group">
        <div class="col-sm-6">
            <label>
                <input type="checkbox" id="active" name="active" value="true"/> Active
            </label>
        </div>
        <div class="col-sm-6">
            <label>
                <input type="checkbox" id="signup" name="signup" value="true"/> Signup
            </label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-6">
            <button type="submit" id="registerSubmitBtn" class="btn btn-block btn-success">SUBMIT</button>
        </div>
        <div class="col-xs-6">
            <button type="reset" id="registerResetBtn" class="btn btn-block btn-danger">RESET</button>
        </div>
    </div>
</form>

            </div>
        </div>
    </div>
</section>
<?php
include('default-imports.php');
?>
<!-- Custom js -->
<script src="../js/add-member.js" type="module"></script>
</body>

</html>