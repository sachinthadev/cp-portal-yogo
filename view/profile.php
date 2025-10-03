<?php
include_once('header.php');
?>
<section class="content">
    <div class="page-body profile-page">
        <div class="cover-holder">
            <div class="cover-img"></div>
            <div class="profile-info">
                <img src="../template/images/avatar.png" alt="User Image"/>
                <div class="sub">
                    <div class="name"> <?php
                        echo $_SESSION["employee_name"]
                        ?></div>
                    <div class="detail">
                        <i class="fa fa-building m-r-5"></i> <?php
                        echo $_SESSION["company_name"]
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-t-15 clearfix" id="profileDiv" hidden>
            <div class="col-sm-7 col-xs-12">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="info-box infobox-type-4 bg-success">
                        <div class="icon"><i class="material-icons">attach_money</i></div>
                        <div class="content">
                            <div class="text">Credit Limit</div>
                            <div class="number count-to" id="creditLimitDiv"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="info-box infobox-type-4 bg-primary">
                        <div class="icon"><i class="material-icons">account_balance</i></div>
                        <div class="content">
                            <div class="text">Total Balance</div>
                            <div class="number count-to" id="totalBalanceDiv"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="info-box infobox-type-4 bg-warning">
                        <div class="icon"><i class="material-icons">trending_up</i></div>
                        <div class="content">
                            <div class="text">Outstanding</div>
                            <div class="number count-to" id="outstandingDiv"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 col-xs-12">
                <div class="panel panel-default" data-panel-close="false" data-panel-fullscreen="false">
                    <div class="panel-heading">GENERAL INFORMATION</div>
                    <div class="panel-body">
                        <div class="info-content">
                            <div class="info-line">
                                <div class="info-title">Email</div>
                                <div class="info-detail" id="emailDiv"></div>
                            </div>
                            <div class="info-line">
                                <div class="info-title">Mobile Number</div>
                                <div class="info-detail" id="mobileDiv"></div>
                            </div>
                            <div class="info-line">
                                <div class="info-title">Department</div>
                                <div class="info-detail" id="departmentDiv"></div>
                            </div>
                            <div class="info-line">
                                <div class="info-title">Employee Id</div>
                                <div class="info-detail" id="employeeIdDiv"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include('default-imports.php');
?>
<script src="../js/profile.js" type="module"></script>

</body>

</html>
