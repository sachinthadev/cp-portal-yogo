import {fetchPost} from './request.js';
import {loading, stopLoading, notification} from "./util.js";

let teamListTable
window.onload = function () {

    $('#teamManagementNav').addClass('active');
    $('#driverRegistrationListNav').addClass('active');
    $('#driverRegistrationList').addClass('collapse in');

    getTeamList();

    //table button click
    $('#teamListTable tbody').on('click', 'button', function () {
        var data = teamListTable.row($(this).parents('tr')).data();
        window.open( `../view/edit-member.php?id=${data[0]}`);
    });
}

const getTeamList = async () => {
    const load = loading("#mainPanel");
    const data = {};
    let result = await fetchPost('../service/get-team-details.php', data);
    stopLoading(load);//stop loading
    if (result.status === 0) {
        if (result.data.status === 0) {
            const teamList = result.data.data;
            $("#teamListTable").show();
            console.log(teamList)
            if (teamListTable) {//destroy the current table
                teamListTable.destroy();
            }

           teamListTable = $('#teamListTable').DataTable({
    data: teamList,
    responsive: true,
    aaSorting: [],
    columns: [
        { data: 'employee_id', title: "ID" },
        { data: 'employee_name', title: "Name" },
        { data: 'email', title: "Email" },
        { data: 'phone_no', title: "Contact No" },
        { data: 'department_name', title: "Department" },
        { data: 'credit_limit', title: "Credit Limit" },
       
        {
            data: null,
            defaultContent: '<button type="button" class="btn btn-circle btn-outline btn-warning"><i class="fa fa-edit"></i></button>',
            orderable: false
        }
    ]
});

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