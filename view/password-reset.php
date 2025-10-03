<?php
include_once('header.php');
?>
<section class="content">
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="passwordChangePanel">
            <div class="panel-heading">
                PASSWORD RESET
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="passwordResetForm" method="post">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <label>Current Password</label>
                            <input type="password" id="currentPassword" name="currentPassword" class="form-control"
                                   minlength="4"
                                   placeholder="Enter current password" required/>
                        </div>
                        <div class="col-sm-4">
                            <label>New Password</label>
                            <input type="password" id="newPassword" name="newPassword" class="form-control"
                                   minlength="4"
                                   placeholder="Enter new password" required/>
                        </div>
                        <div class="col-sm-4">
                            <label>Confirm Password</label>
                            <input type="password" id="confirmPassword" name="confirmPassword" minlength="4"
                                   class="form-control"
                                   placeholder="Enter confirm password" required/>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" id="resetPasswordBtn" class="btn btn-block btn-success">RESET</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
include_once('default-imports.php');
?>
<!-- Custom js -->
<script src="../js/password-reset.js" type="module"></script>
</body>

</html>

