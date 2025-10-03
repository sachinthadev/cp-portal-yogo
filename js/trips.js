import {fetchPost} from './request.js';
import {loading, stopLoading, notification, refreshSession,getOneDateBeforeCurrentDate , getThirtyDaysBackFromCurrentDate } from "./util.js";

let tripsTable
window.onload = function () {

    refreshSession()

    $('#tripManagementNav').addClass('active');
    $('#tripsNav').addClass('active');
    $('#tripManagementList').addClass('collapse in');

    //get current date and one month before
    const currentDate = getOneDateBeforeCurrentDate()
    const oneMonthBefore = getThirtyDaysBackFromCurrentDate()

    $('#tripsDateRange').daterangepicker({
        startDate: oneMonthBefore,
        endDate: currentDate,
        applyClass: "btn-primary",
        locale: {
            format: 'YYYY/MM/DD'
        }
    }, getDateRange);

    getTripsList(oneMonthBefore, currentDate);

    //table button click
    $('#tripsTable tbody').on('click', 'button', function () {
        var data = tripsTable.row($(this).parents('tr')).data();
        window.open( `../view/trip-detail.php?id=${data[0]}`);
    });

    /**
     *  select events
     */

    $('#tripTypeSelect').on('change', async function () {
        let start = $('#tripsDateRange').data('daterangepicker').startDate;
        let end = $('#tripsDateRange').data('daterangepicker').endDate;
        getTripsList(start, end);
    });


}

/**
 * Get the date range of daterange picker
 * */
const getDateRange = (start, end) => {
    getTripsList(start, end);
};


const getTripsList = async (startDate, endDate) => {
    const load = loading("#mainPanel");
    let typeSelect = document.getElementById("tripTypeSelect").value;
    $("#tripsTable").show();
    const data = {
        startDate: startDate.format('YYYY/MM/DD'),
        endDate: endDate.format('YYYY/MM/DD'),
        type: typeSelect
    };
    let result = await fetchPost('../service/get-trip-list-of-company.php', data);
    stopLoading(load);//stop loading
    if (result.status === 0) {
        if (result.data.status === 0) {
            const tripsList = result.data.data;
            console.log(tripsList)
            if (tripsTable) {//destroy the current table
                tripsTable.destroy();
            }

            tripsTable = $('#tripsTable').DataTable({
                data: tripsList,
                responsive: true,
                columnDefs: [{
                    width: "1%",
                    targets: -1,
                    defaultContent: '<button type="button" class="btn btn-circle btn-outline btn-warning" ><i class="fa fa-edit"></i></button>',

                },
                    {responsivePriority: 1, targets: 0},
                    {responsivePriority: 2, targets: 8},
                ],
                aaSorting: []

            });

            new $.fn.dataTable.FixedHeader(tripsTable);

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