import {fetchPost} from './request.js';
import {loading, stopLoading, notification} from "./util.js";

window.onload = function () {

    $('#teamManagementNav').addClass('active');
    $('#addNewDriverRegistrationNav').addClass('active');
    $('#driverRegistrationList').addClass('collapse in');

    /**
     * select data load in form load
     */
    getDepartmentDetailsForSelect();

    /**
     * get member details
     */
    let memberId = document.getElementById("memberId").value;
    loadMemberDetailsForEdit(memberId)

    /**
     *  form submission
     */

    $("#memberRegisterForm").submit(async function () {
        // we stoped it
        event.preventDefault();

        //get the text field data
        let memberId = document.getElementById("memberId").value;
        let teamMemberName = document.getElementById("teamMemberName").value;
        let teamMemberMobileNo = document.getElementById("teamMemberMobileNo").value;
        let teamMemberEmail = document.getElementById("teamMemberEmail").value;
        let departmentSelect = document.getElementById("departmentSelect").value;
        let designationSelect = document.getElementById("designationSelect").value;
        let userTypeSelect = document.getElementById("userTypeSelect").value;
        let teamMemberCreditLimit = document.getElementById("teamMemberCreditLimit").value;
        let titleSelect = document.getElementById("titleSelect").value;


        //array init
        const data = {
            employeeid: memberId,
            teammembername: teamMemberName,
            teammembermobileno: teamMemberMobileNo,
            teammemberemail: teamMemberEmail,
            departmentselect: departmentSelect,
            designationselect: designationSelect,
            usertypeselect: userTypeSelect,
            teammembercreditlimit: teamMemberCreditLimit,
            titleselect: titleSelect
        };

        let result = await fetchPost('../service/submit-member-registration-details.php', data);

        if (result.status === 0) {
            if (result.data.status === 0) {
                notification('success', 'SUCCESSFULLY SAVED', 'Member is registered successfully');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            } else if (result.data.status === 1) {
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


const getDepartmentDetailsForSelect = async () => {
    const load = loading("#mainPanel");
    $("#teamListTable").show();
    const data = {};
    let result = await fetchPost('../service/get-department-details-for-select.php', data);
    stopLoading(load);//stop loading
    if (result.status === 0) {
        if (result.data.status === 0) {
            //set data to drop down
            $("#departmentSelect")
                .html(result.data.data)
                .selectpicker('refresh');

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


/**
 * Load all driver details for edit
 * @param id
 * @returns {Promise<void>}
 */
const loadMemberDetailsForEdit = async (id) => {
    const load = loading("#mainPanel");
    const data = {
        employeeid: id
    };
    let result = await fetchPost('../service/get-member-details.php', data);


    if (result.status === 0) {
        if (result.data.status === 0) {

            const memberDetails = result.data.data;

            document.getElementById("teamMemberName").value = memberDetails.employee_name;
            document.getElementById("teamMemberMobileNo").value = memberDetails.phone_no;
            document.getElementById("teamMemberEmail").value = memberDetails.email;
            document.getElementById("teamMemberCreditLimit").value = memberDetails.credit_limit;

            $('#departmentSelect').val(memberDetails.department_id).selectpicker('refresh');
            $('#designationSelect').val(memberDetails.designation_id).selectpicker('refresh');
            $('#userTypeSelect').val(memberDetails.user_type).selectpicker('refresh');
            $('#titleSelect').val(memberDetails.title).selectpicker('refresh');


        } else if (result.data.status === 1) {

            window.location.href = "../view/440.php";
        } else if (result.data.status === 2) {
            notification('error', 'ERROR', 'Transfer details are not found');
        }
    } else {
        notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
        console.error(result.data);
    }

    stopLoading(load);//stop loading
}


