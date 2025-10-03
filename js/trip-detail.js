import { fetchPost } from './request.js';
import { loading, stopLoading, notification, pageAlert } from "./util.js";

let additionalChargesTable
window.onload = function () {
    let bookingId = document.getElementById("bookingId").value;
    loadBookingDetails(bookingId);
    /**
     * Button Click
     */
    $("#tripRouteBtn").click(function () {
        window.location.href = `../view/trip-route.php?id=${bookingId}`
    });
}

const loadBookingDetails = async (bookingId) => {
    const load = loading("#mainPanel");
    const data = {
        bookingid: bookingId
    };
    let result = await fetchPost('../service/get-booking-details.php', data);
    if (result.status === 0) {
        if (result.data.status === 0) {
            const bookingDetails = result.data.data;
            console.log(bookingDetails);
            //get the text field data
            document.getElementById("passengerName").value = (bookingDetails.passenger_name == "" || bookingDetails.passenger_name == "null") ? 'n/a' : bookingDetails.passenger_name;
            document.getElementById("passengerContactNo").value = (bookingDetails.passenger_contact_no == "" || bookingDetails.passenger_contact_no == "null") ? 'n/a' : bookingDetails.passenger_contact_no;
            document.getElementById("department").value = (bookingDetails.department == "" || bookingDetails.department == "null") ? 'n/a' : bookingDetails.department;
            document.getElementById("vehicleNo").value = (bookingDetails.vehicle_no == "" || bookingDetails.vehicle_no == "null") ? 'n/a' : bookingDetails.vehicle_no;
            document.getElementById("tripStartLoc").value = (bookingDetails.booking_start_point == "" || bookingDetails.booking_start_point == "null") ? 'n/a' : bookingDetails.booking_start_point;
            document.getElementById("tripEndLoc").value = (bookingDetails.booking_end_point == "" || bookingDetails.booking_end_point == "null") ? 'n/a' : bookingDetails.booking_end_point;
            document.getElementById("tripDistance").value = (bookingDetails.trip_distance == "" || bookingDetails.trip_distance == "null") ? 'n/a' : bookingDetails.trip_distance;
            document.getElementById("waitingMin").value = (bookingDetails.waiting_minutes == "" || bookingDetails.waiting_minutes == "null") ? 'n/a' : bookingDetails.waiting_minutes;
            document.getElementById("hireAmount").value = (bookingDetails.hire_amount == "" || bookingDetails.hire_amount == "null") ? 'n/a' : bookingDetails.hire_amount;
            document.getElementById("extraChargeInvoice").value = (bookingDetails.extra_charge_invoice == "" || bookingDetails.extra_charge_invoice == "null") ? 'n/a' : bookingDetails.extra_charge_invoice;
            document.getElementById("invoiceTotalAmount").value = (bookingDetails.invoice_total_amount == "" || bookingDetails.invoice_total_amount == "null") ? 'n/a' : bookingDetails.invoice_total_amount;
            document.getElementById("tripStartTime").value = (bookingDetails.start_time == "" || bookingDetails.start_time == "null") ? 'n/a' : bookingDetails.start_time;
            document.getElementById("tripEndTime").value = (bookingDetails.end_time == "" || bookingDetails.end_time == "null") ? 'n/a' : bookingDetails.end_time;
            document.getElementById("baseFare").value = (bookingDetails.base_fare == "" || bookingDetails.base_fare == "null") ? 'n/a' : bookingDetails.base_fare;
            document.getElementById("additionalDistanceFare").value = (bookingDetails.aditional_distance == "" || bookingDetails.aditional_distance == "null") ? 'n/a' : bookingDetails.aditional_distance;
            document.getElementById("waitingTimeCharge").value = (bookingDetails.waiting_time_charge == "" || bookingDetails.waiting_time_charge == "null") ? 'n/a' : bookingDetails.waiting_time_charge;

            let tripRouteBtn = document.getElementById("tripRouteBtn");
            // let cancelTripBtn = document.getElementById("cancelTripBtn");

            switch (bookingDetails.booking_status) {
                case 'In Progress':
                    pageAlert(2, 'Trip In Progress')
                    tripRouteBtn.style.display = "none";
                    break;
                case 'Completed':
                    pageAlert(1, 'Trip Completed')
                    tripRouteBtn.style.display = "block";
                    break;
                case 'Cancled':
                    pageAlert(3, 'Trip Cancelled')
                    tripRouteBtn.style.display = "none";
                    break;
                case 'Unknown':
                    pageAlert(4, 'Unknown State')
                    tripRouteBtn.style.display = "none";
                    break;

            }

            if (additionalChargesTable) {//destroy the current table
                additionalChargesTable.destroy();
            }

            if (bookingDetails.extra_charge_details !== undefined && bookingDetails.extra_charge_invoice > 0) {
                additionalChargesTable = $('#additionalChargesTable').DataTable({
                    data: bookingDetails.extra_charge_details !== undefined ? bookingDetails.extra_charge_details : null,
                    responsive: true,
                    paging: false,
                    ordering: false,
                    info: false,
                    searching: false,
                    columns: [
                        { data: "type_description" },
                        { data: "amount" }
                    ],
                    aaSorting: []
                });
            }
            else {
                let additionalChargesTable = document.getElementById("additionalChargesTable");
                let extraChargeInvoice = document.getElementById("extraChargeInvoice");
                let extraChargeInvoice1 = document.getElementById("extraChargeInvoice1");
                let hireAmount = document.getElementById("hireAmount");
                let hireAmount1 = document.getElementById("hireAmount1");

                additionalChargesTable.style.display = "none";
                extraChargeInvoice.style.display = "none";
                extraChargeInvoice1.style.display = "none";
                hireAmount.style.display = "none";
                hireAmount1.style.display = "none";
            }
        } else if (result.data.status === 1) {

            window.location.href = "../view/440.php";
        } else if (result.data.status === 2) {
            notification('error', 'ERROR', result.data.message);

            document.getElementById("passengerName").value = 'n/a';
            document.getElementById("passengerContactNo").value = 'n/a';
            document.getElementById("department").value = 'n/a';
            document.getElementById("vehicleNo").value = 'n/a';
            document.getElementById("tripStartLoc").value = 'n/a';
            document.getElementById("tripEndLoc").value = 'n/a';
            document.getElementById("tripDistance").value = 'n/a';
            document.getElementById("waitingMin").value = 'n/a';
            document.getElementById("hireAmount").value = 'n/a';
            document.getElementById("extraChargeInvoice").value = 'n/a';
            document.getElementById("invoiceTotalAmount").value = 'n/a';
            document.getElementById("tripStartTime").value = 'n/a';
            document.getElementById("tripEndTime").value = 'n/a';
        }
    } else {
        notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
        console.error(result.data);
    }

    stopLoading(load);//stop loading
}