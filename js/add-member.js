import { fetchPost } from './request.js';
import { loading, stopLoading, notification } from "./util.js";

window.onload = function () {

    $('#teamManagementNav').addClass('active');
    $('#addNewDriverRegistrationNav').addClass('active');
    $('#driverRegistrationList').addClass('collapse in');

    /**
     * load select data on form load
     */
    getDepartmentDetailsForSelect();
    getBranchDetailsForSelect();

    /**
     * form submission
     */
    $("#memberRegisterForm").submit(async function (event) {
        event.preventDefault();

        // Collect form values
        let employeeNo   = document.getElementById("employeeNo").value;
        let title        = document.getElementById("titleSelect").value;
        let employeeName = document.getElementById("employeeName").value;
        let callName     = document.getElementById("callName").value;
        let phoneNo      = document.getElementById("phoneNo").value;
        let email        = document.getElementById("email").value;
        let departmentId = document.getElementById("departmentSelect").value;
        let branchId     = document.getElementById("branchSelect").value;
        let userType     = document.getElementById("userTypeSelect").value;
        let creditLimit  = document.getElementById("creditLimit").value;
        let active       = document.getElementById("active").checked;
        let signup       = document.getElementById("signup").checked;

        // Build request data
        const data = {
            employee_id: "", // new record → empty
            department_id: departmentId,
            branch_id: branchId,
            employee_no: employeeNo,
            title: title,
            employee_name: employeeName,
            call_name: callName,
            phone_no: phoneNo,
            email: email,
            user_type: userType,
            credit_limit: creditLimit,
            active: active,
            signup: signup
        };

        // Call backend PHP API
        let result = await fetchPost('../service/submit-member-registration-details.php', data);

        if (result.status === 0) {
            if (result.data.status === 0) {
                notification('success', 'SUCCESSFULLY SAVED', 'Member is registered successfully');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            } else if (result.data.status === 1) {
                // Unauthorized → redirect
                window.location.href = "../view/440.php";
            } else if (result.data.status === 2) {
                notification('error', 'ERROR', result.data.message);
            }
        } else {
            notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
            console.error(result.data);
        }
    });
};






// --- Select helpers ---
function populateSelect(selector, data, valueField, textField) {
    let $select = $(selector);
    $select.empty();
    $select.append(`<option value="" disabled selected>-- Please select --</option>`);
    data.forEach(item => {
        $select.append(`<option value="${item[valueField]}">${item[textField]}</option>`);
    });
    // Refresh Bootstrap Select
    if ($select.hasClass('show-tick')) $select.selectpicker('refresh');
}



// --- Fetch & populate selects ---
export const getBranchDetailsForSelect = async () => {
    const load = loading("#mainPanel");
    let result = await fetchPost('../service/get-branch-details-for-select.php', {});
    stopLoading(load);

    if (result.status === 0 && result.data.status === 0) {
        const innerData = Array.isArray(result.data.data) ? result.data.data : result.data.data?.data || [];
        populateSelect('#branchSelect', innerData, 'branch_id', 'branch_name');
    } else if (result.data.status === 1) {
        window.location.href = "../view/440.php";
    } else {
        notification('error', 'ERROR', result.data.message || 'Failed to load branches');
    }
};

export const getDepartmentDetailsForSelect = async () => {
    const load = loading("#mainPanel");
    let result = await fetchPost('../service/get-department-details-for-select.php', {});
    stopLoading(load);

    if (result.status === 0 && result.data.status === 0) {
        const innerData = Array.isArray(result.data.data) ? result.data.data : result.data.data?.data || [];
        populateSelect('#departmentSelect', innerData, 'department_id', 'department_name');
    } else if (result.data.status === 1) {
        window.location.href = "../view/440.php";
    } else {
        notification('error', 'ERROR', result.data.message || 'Failed to load departments');
    }
};
