import {fetchPost} from './request.js';
import {loading, stopLoading, notification} from "./util.js";

window.onload = function () {
    /**
     *  form submission
     */

    $("#passwordResetForm").submit(async function () {
        // we stoped it
        event.preventDefault();

        document.getElementById("resetPasswordBtn").disabled = true;

        //get the text field data
        let currentPassword = document.getElementById("currentPassword").value;
        let newPassword = document.getElementById("newPassword").value;
        let confirmPassword = document.getElementById("confirmPassword").value;

        if (newPassword === confirmPassword) {

            //array init
            const data = {
                currentpassword : currentPassword,
                newpassword: newPassword,
                confirmpassword: confirmPassword,
            };

            let result = await fetchPost('../service/submit-password-change.php', data);

            if (result.status === 0) {
                if (result.data.status === 0) {
                    notification('success', 'PASSWORD UPDATED SUCCESSFULLY', 'Password was updated successfully, Login for authentication');
                    setTimeout(() => {
                        window.location.href = "../view/log-out.php";
                    }, 3000);
                } else if (result.data.status === 1) {
                    window.location.href = "../view/440.php";
                } else if (result.data.status === 2) {
                    notification('error', 'ERROR', result.data.message);
                    document.getElementById("resetPasswordBtn").disabled = false;
                }
            } else {
                notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
                document.getElementById("resetPasswordBtn").disabled = false;
                console.error(result.data);
            }

        }else {
            notification('error', 'ERROR', 'Passwords do not match with each other. Please check again and submit');
            document.getElementById("resetPasswordBtn").disabled = false;
        }
    });

};



