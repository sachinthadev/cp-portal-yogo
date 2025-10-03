import {fetchPost} from './request.js';
import {
    loading,
    stopLoading,
    notification,
    refreshSession,
    getOneDateBeforeCurrentDate,
    getThirtyDaysBackFromCurrentDate
} from "./util.js";

let routeTable
window.onload = function () {

    refreshSession()

    $('#shuttleServiceManagementNav').addClass('active');
    $('#routeAttendanceManageNav').addClass('active');
    $('#shuttleServiceManagementList').addClass('collapse in');

    const dateToday = new Date();
    $('#datePicker').datetimepicker({
        format: 'YYYY-MM-DD',
        minDate: dateToday,
        showClear: true
    });


    // //table button click
    // $('#tripsTable tbody').on('click', 'button', function () {
    //     var data = tripsTable.row($(this).parents('tr')).data();
    //     window.open( `../view/trip-detail.php?id=${data[0]}`);
    // });

    getEmployees()

}


const getEmployees = async () => {
    const load = loading("#mainPanel");
    $("#routeTable").show();
    const data = {};
    let result = await fetchPost('../service/get-employees.php', data);
    stopLoading(load);//stop loading
    if (result.status === 0) {
        if (result.data.status === 0) {
            const employeData = result.data.data;
            console.log(employeData)
            if (routeTable) {//destroy the current table
                routeTable.destroy();
            }

            routeTable = $('#routeTable').DataTable({
                data: employeData,
                responsive: true,
                searching: false,
                info: false,
                columnDefs: [
                    {
                        width: "25%",
                        targets: -2,
                        defaultContent: '<td><select id="vehicleTypeSelect" name="vehicleTypeSelect"\n' +
                            '                                    class="form-control show-tick">\n' +
                            '                                <option value="0" selected disabled>-- Pickup Route Select --</option>\n' +
                            '                                <option value="1">9.30am Kottawa Pickup</option>\n' +
                            '                                <option value="2">11.00am Kottawa Pickup</option>\n' +
                            '                            </select></td>'
                    }, {
                        width: "25%",
                        targets: -1,
                        defaultContent: '<td><select id="vehicleTypeSelect" name="vehicleTypeSelect"\n' +
                            '                                    class="form-control show-tick" >\n' +
                            '                                <option value="0" selected disabled>--  Drop Off Route Select --</option>\n' +
                            '                                <option value="1"> 7.30PM Kottawa Drop</option>\n' +
                            '                                <option value="2">11.00PM Kottawa Drop</option>\n' +
                            '                            </select></td>'
                    },
                ],
                aaSorting: []

            });

            new $.fn.dataTable.FixedHeader(routeTable);

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