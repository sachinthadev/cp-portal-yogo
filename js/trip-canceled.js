import { loading, stopLoading, notification, refreshSession, getOneDateBeforeCurrentDate, getThirtyDaysBackFromCurrentDate } from "./util.js";

let tripsTable;

window.onload = function () {
    refreshSession();

   $('#tripManagementNav').addClass('active');
    $('#tripCanceledNav').addClass('active');
    $('#tripManagementList').addClass('collapse in');


    const currentDate = getOneDateBeforeCurrentDate();
    const oneMonthBefore = getThirtyDaysBackFromCurrentDate();

    $('#tripsDateRange').daterangepicker({
        startDate: oneMonthBefore,
        endDate: currentDate,
        applyClass: "btn-primary",
        dateLimit: { months: 2, days: -1 },
        locale: { format: 'YYYY-MM-DD' }
    }, getDateRange);

    // Initial load
    getTripsList(oneMonthBefore, currentDate);

    // Table button click
    $('#tripsTable tbody').on('click', 'button', function () {
        const data = tripsTable.row($(this).parents('tr')).data();
        window.open(`../view/trip-detail.php?id=${data.booking_id}`);
    });
};

// Callback from daterangepicker
const getDateRange = (start, end) => {
    getTripsList(start, end);
};

const getTripsList = async (startDate, endDate) => {
    const load = loading("#mainPanel");
    $("#tripsTable").show();

    try {
        // Format dates as YYYY-MM-DD
        const start = startDate.format('YYYY-MM-DD');
        const end = endDate.format('YYYY-MM-DD');

        // GET API call with query params
        const url = `../service/get-cancel-trips.php?start_date=${start}&end_date=${end}&type=3`;

        const response = await fetch(url, {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        // Safely parse JSON
        let result;
        try {
            result = await response.json();
        } catch (e) {
            throw new Error("Invalid JSON response from server");
        }

        stopLoading(load);

        if (result.status === 0) {
            if (result.data.status === 0) {
                const tripsList = result.data.data;

                if (tripsTable) tripsTable.destroy();

                tripsTable = $('#tripsTable').DataTable({
                    dom: 'Bfrtip',
                    data: tripsList,
                    responsive: true,
                    columns: [
                        { data: "booking_id" },
                        { data: "pickup_address" },
                        { data: "drop_address" },
                        { data: "requested_time" },
                        { data: "trip_distance" },
                        { data: "total_amount" },
                        { data: "employee_name" },
                        { data: "remarks" }
                    ],
                    aaSorting: [],
                    buttons: ['csv', 'pdf']
                });

                new $.fn.dataTable.FixedHeader(tripsTable);
            } else if (result.data.status === 1) {
                // Unauthorized → redirect
                window.location.href = "../view/440.php";
            } else {
                notification('error', 'ERROR', result.data.message);
            }
        } else {
            notification('error', 'ERROR', 'Something went wrong, please refresh and try again');
            console.error(result.data);
        }

    } catch (err) {
        stopLoading(load);
        notification('error', 'ERROR', 'Failed to fetch trips data');
        console.error(err);
    }
};
