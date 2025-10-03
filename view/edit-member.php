<?php
include('header.php');
$memberId = null;
if (isset($_GET['id'])) {
    $memberId = $_GET['id'];
}
?>
<section class="content">
    <div class="page-heading">
        <h1>EDIT MEMBER</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="javascript:void(0);">Team Management</a></li>
            <li class="active">Edit Member</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Member Details
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="memberRegisterForm" method="post">
                    <!--Personal Details-->
                    <h3 class="panel-inside-title">Personal Details</h3>
                    <div class="form-group" hidden>
                        <div class="col-sm-10">
                            <label>id</label>
                            <input type="text" id="memberId" name="memberId" class="form-control"
                                <?php
                                echo 'value="' . $memberId . '"';
                                ?>
                                   readonly="readonly"
                                   placeholder="Enter members's id" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label>Title</label>
                            <select id="titleSelect" name="titleSelect"
                                    class="form-control selectpicker show-tick" data-live-search="true" required>
                                <option value="">-- Please select --</option>
                                <option value="Ven">Ven.</option>
                                <option value="Mr">Mr.</option>
                                <option value="Mrs">Mrs.</option>
                                <option value="Ms">Ms.</option>
                                <option value="Dr">Dr.</option>
                                <option value="Prof">Prof.</option>
                            </select>
                        </div>
                        <div class="col-sm-10">
                            <label>Name</label>
                            <input type="text" id="teamMemberName" name="teamMemberName" class="form-control"
                                   placeholder="Enter members's name" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Contact No</label>
                            <input type="text" id="teamMemberMobileNo" name="teamMemberMobileNo" class="form-control"
                                   placeholder="Enter member's contact No" pattern="[0-9]{10,10}"
                                   title="Land phone number should be included 10 digits starting from zero"
                                   maxlength="10" required/>
                            <div class="help-info">Ex: 0770000000</div>
                        </div>
                        <div class="col-sm-6">
                            <label>Email</label>
                            <input type="email" id="teamMemberEmail" name="teamMemberEmail" class="form-control"
                                   placeholder="Enter member's email"/>
                        </div>
                    </div>
                    <!--Department & Permission Details -->
                    <h3 class="panel-inside-title">Department & Permission Details</h3>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Department</label>
                            <select id="departmentSelect" name="departmentSelect"
                                    class="form-control selectpicker show-tick" data-live-search="true" required>
                                <option value="">-- Please select --</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Designation</label>
                            <select id="designationSelect" name="designationSelect"
                                    class="form-control selectpicker show-tick" data-live-search="true" required>
                                <option value="">-- Please select --</option>
                                <option value="1">Managing Director</option>
                                <option value="2">Chief Operation Officer</option>
                                <option value="3">Head Of Department</option>
                                <option value="4">Secretary</option>
                                <option value="5">Manager</option>
                                <option value="6">Assistant Manager</option>
                                <option value="7">Senior Executive</option>
                                <option value="8">Executive</option>
                                <option value="9">Officer</option>
                                <option value="10">Junior Executive</option>
                                <option value="11">Assistant</option>
                                <option value="12">Messengers</option>
                                <option value="13">Driver</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>User Type</label>
                            <select id="userTypeSelect" name="userTypeSelect"
                                    class="form-control selectpicker show-tick" data-live-search="true" required>
                                <option value="">-- Please select --</option>
                                <option value="3">Employee</option>
                                <option value="2">Department Head</option>
                                <option value="1">Administrator</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Credit Limit (Rs)</label>
                            <input type="number" id="teamMemberCreditLimit" name="teamMemberCreditLimit"
                                   class="form-control"
                                   placeholder="Enter member credit limit" required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <button type="submit" id="registerSubmitBtn" class="btn btn-block btn-success">SUBMIT
                            </button>
                        </div>
                        <div class="col-xs-6">
                            <button type="reset" id="registerResetBtn" class="btn btn-block btn-danger">RESET</button>
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
<script src="../js/edit-member.js" type="module"></script>
</body>

</html>