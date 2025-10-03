import {fetchPost} from './request.js';
import {
    loading,
    stopLoading,
    notification,
} from "./util.js";

window.onload = function () {
    getProfileDetails()
}


const getProfileDetails = async () => {
    const load = loading("#mainPanel");
    const data = {};
    let result = await fetchPost('../service/get-profile-details.php', data);
    stopLoading(load);//stop loading
    if (result.status === 0) {
        if (result.data.status === 0) {
            const profileDetails = result.data.data;
            document.getElementById("emailDiv").innerHTML = profileDetails.email
            document.getElementById("mobileDiv").innerHTML = profileDetails.phone_no
            document.getElementById("departmentDiv").innerHTML = profileDetails.department_name
            document.getElementById("employeeIdDiv").innerHTML = profileDetails.employee_id

            document.getElementById("creditLimitDiv").innerHTML = `Rs ${profileDetails.credit_limit}.00`
            document.getElementById("totalBalanceDiv").innerHTML = `Rs ${profileDetails.credit_balance}.00`
            document.getElementById("outstandingDiv").innerHTML = `Rs ${profileDetails.outstanding}.00`

            document.getElementById("profileDiv").style.display = 'block';

        } else if (result.data.status === 1) {
            window.location.href = "../view/440.php";
        } else if (result.data.status === 2) {
            notification('error', 'ERROR', result.data.message);
        }
    } else {
        notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
        console.error(result.data);
    }
};