import {fetchPost} from './request.js';
import {
    loading,
    stopLoading,
    notification,
    refreshSession,
    showModal,
    closeModal,
    getOneDateBeforeCurrentDate,
    getThirtyDaysBackFromCurrentDate
} from "./util.js";

let tripsTable
window.onload = function () {

    refreshSession()

    $('#tripManagementNav').addClass('active');
    $('#tripCancelNav').addClass('active');
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
        document.getElementById("confirmBookingId").value = data[0];
        showModal('tripCancelModal')
    });


    /**
     * Modal Button Click
     */
    $("#cancelBtn").click(async function () {
        //get the text field data
        //get the text field data
        let conformBookingId = document.getElementById("confirmBookingId").value;
        let bookingID = document.getElementById("bookingId").value;
        let reason = document.getElementById("reason").value;

        if (bookingID && reason) {
            if (conformBookingId == bookingID) {
                //array init
                const data = {
                    reason: reason,
                    bookingid: bookingID
                };

                let result = await fetchPost('../service/submit-cancel-trip.php', data);

                if (result.status === 0) {
                    if (result.data.status === 0) {
                        notification('success', 'SUCCESSFULLY CANCELED', 'The booking is canceled successfully');
                        setTimeout(() => {
                            getTripsList(oneMonthBefore, currentDate);
                            closeModal('tripCancelModal')
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
            } else {
                notification('error', 'ERROR', 'Entered booking id is not valid');
            }
        }else {
            notification('error', 'ERROR', 'Fill all the fields before submit');
        }
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
    $("#tripsTable").show();
    const data = {
        startDate: startDate.format('YYYY/MM/DD'),
        endDate: endDate.format('YYYY/MM/DD'),
        type: 1
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
                    defaultContent: '<button type="button" class="btn btn-circle btn-outline btn-danger" ><i class="fa fa-close"></i></button>',

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