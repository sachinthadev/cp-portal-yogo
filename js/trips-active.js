import { fetchPost } from './request.js';
import {
    loading,
    stopLoading,
    notification,
    refreshSession,
    showModal,
    closeModal
} from "./util.js";

let tripsTable;
let tripListData;

window.onload = function () {
     getTripsList();
    refreshSession();

    // Activate menu
    $('#tripManagementNav').addClass('active');
    $('#activeTripsNav').addClass('active');
    $('#tripManagementList').addClass('collapse in');

    // // Load trips
    // getTripsList();

    // Cancel button inside table (Action col)
    $('#tripsTable tbody').on('click', 'button.cancel-btn', function () {
        let data = tripsTable.row($(this).parents('tr')).data();
        const bookingId = data[0]; // booking_id is first col

        // Fill modal fields
        const confirmInput = document.getElementById("confirmBookingId");
        const bookingInput = document.getElementById("bookingId");

        if (confirmInput) confirmInput.value = bookingId;
        if (bookingInput) bookingInput.value = bookingId;

        showModal('tripCancelModal');
    });

    // Cancel submit in modal
    $("#cancelBtn").click(async function () {
        const bookingInput   = document.getElementById("bookingId");
        const reasonSelect   = document.getElementById("selectreason");
        const remarkTextarea = document.getElementById("remark");

        if (!bookingInput || !reasonSelect || !remarkTextarea) {
            console.error("Cancel modal elements not found in DOM!");
            notification('error', 'ERROR', 'Something went wrong. Please refresh and try again.');
            return;
        }

        let bookingID    = bookingInput.value;
        let cancelReason = reasonSelect.value;
        let remarks      = remarkTextarea.value;

        if (bookingID && cancelReason) {
            const data = {
                booking_id: bookingID,
                cancel_reason: cancelReason,
                remarks: remarks || ""
            };

            try {
                let result = await fetchPost('../service/submit-cancel-trip.php', data);

                if (result.status === 0) {
                    if (result.data.status === 0) {
                        notification('success', 'SUCCESSFULLY CANCELED', 'The booking is canceled successfully');
                        setTimeout(() => {
                            getTripsList();
                            closeModal('tripCancelModal');
                        }, 2000);
                    } else if (result.data.status === 1) {
                        window.location.href = "../view/440.php";
                    } else if (result.data.status === 2) {
                        notification('error', 'ERROR', result.data.message);
                    }
                } else {
                    notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
                    console.error(result.data);
                }
            } catch (err) {
                console.error("Cancel API Error:", err);
                notification('error', 'ERROR', 'Request failed, please try again later.');
            }
        } else {
            notification('error', 'ERROR', 'Please select a cancel reason before submitting');
        }
    });
};










// =======================
// Fetch trips list
// =======================
const getTripsList = async () => {
    const load = loading("#mainPanel");

    try {
        let result = await fetchPost('../service/get-active-trips.php', {});
        stopLoading(load);

        console.log("API Response (Active Trips):", result);

        if (result.status === 0) {
            if (result.data.status === 0) {
                // ✅ Extract trips safely
                tripListData = Array.isArray(result.data.data) ? result.data.data : [];

                // ✅ Always initialize tableData
                let tableData = [];
                
                if (tripListData.length > 0) {
                    tableData = tripListData.map(trip => [
                        trip.booking_id,
                        trip.pickup_address,
                        trip.drop_address,
                        trip.employee_name,
                        trip.start_time ?? "N/A",
                        trip.status,
                        trip.remarks ?? "",
                        null
                    ]);
                }
                console.log("Table data (Active Trips):", tableData);
                // ✅ Destroy old DataTable if exists
                if ($.fn.DataTable.isDataTable('#tripsTable')) {
                    $('#tripsTable').DataTable().clear().destroy();
                    $('#tripsTable tbody').empty();
                }

                if (tableData.length === 0) {
                    notification('info', 'No Active Trips', 'There are currently no active trips.');
                    $('#tripsTable').attr("hidden", true);
                    return;
                }

                // ✅ Init DataTable
                tripsTable = $('#tripsTable').DataTable({
                    data: tableData,
                    responsive: true,
                    columns: [
                        { title: "Booking ID" },
                        { title: "Pickup Address" },
                        { title: "Drop Address" },
                        { title: "Employee Name" },
                        { title: "Start Time" },
                        { title: "Status" },
                        { title: "Remarks" },
                        {
                            title: "Action",
                            data: null,
                            render: function () {
                                return `
                                    <button type="button" class="btn btn-sm btn-danger cancel-btn">
                                        <i class="fa fa-close"></i> Cancel
                                    </button>
                                `;
                            }
                        }
                    ],
                    aaSorting: []
                });

                $('#tripsTable').removeAttr("hidden");

            } else if (result.data.status === 1) {
                // 🔒 Session expired
                window.location.href = "../view/440.php";
            } else if (result.data.status === 2) {
                notification('error', 'ERROR', result.data.message);
            }
        } else {
            notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
            console.error(result.data);
        }
    } catch (err) {
        stopLoading(load);
        console.error("Active Trips API Error:", err);
        notification('error', 'ERROR', 'Request failed, please try again later.');
    }
};
