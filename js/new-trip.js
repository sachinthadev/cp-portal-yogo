import { fetchPost } from './request.js';
import { loading, stopLoading, notification } from "./util.js";
import {
    clearMarker,
    initilizeMap,
    placeSearchByText,
    setAllMarkersVisible,
    setMarkerWithIconLabelWithDragable,
    calculateTripDistanceAndTime,
    drawRouteWithGoogleMap,
    markerDragableEvent
} from "./map.js";

let markers = { startmarker: null, endmarker: null };
const googleMap = initilizeMap("gmapLive");

// -------------------- INIT --------------------
$(document).ready(function () {
    $('#newTripNav').addClass('active');

    // Load all dropdowns
    getBranchDetailsForSelect();
    getDepartmentDetailsForSelect();
    getEmployeeDetailsForSelect();
    getVehicleDetailsForSelect();

    // Load Credit Info in Navbar
    getCreditDetails();

    // Department change → reload employees
    $('#departmentSelect').on('change', function () {
        getEmployeeDetailsForSelect(this.value);
    });

    // Branch change → set pickup location
    $('#branchSelect').on('change', function () {
        let sel = $(this).find(':selected');
        $("#pickupLocation").val(sel.data('address') || "");
        $("#pickupLocationLat").val(sel.data('latitude') || "");
        $("#pickupLocationLng").val(sel.data('longitude') || "");

        setMarkerAndEstimateCalculate({
            latLocText: "pickupLocationLat",
            lngLocText: "pickupLocationLng",
            markerIconLabel: "S",
            markerTitle: "Start Location"
        });
    });

    // Vehicle change → recalc distance
    $('#vehicleTypeSelect').on('change', function () {
        const vehicleType = this.value;
        calculateTripDistanceAndTime(googleMap, markers, "estimateTripTime", "estimateTripDistance", vehicleType);
        drawRouteWithGoogleMap(googleMap, markers, vehicleType, "pickupLocation", "dropLocation");
    });

    // Place search
    placeSearchByText("pickupLocation", "pickupLocationLat", "pickupLocationLng", () => {
        setMarkerAndEstimateCalculate({
            latLocText: "pickupLocationLat",
            lngLocText: "pickupLocationLng",
            markerIconLabel: "S",
            markerTitle: "Start Location"
        });
    });

    placeSearchByText("dropLocation", "dropLocationLat", "dropLocationLng", () => {
        setMarkerAndEstimateCalculate({
            latLocText: "dropLocationLat",
            lngLocText: "dropLocationLng",
            markerIconLabel: "E",
            markerTitle: "End Location"
        });
    });

    // Init Flatpickr once at page load
    flatpickr("#tripDateTime", {
        enableTime: true,
        time_24hr: true,
        enableSeconds: false,
        dateFormat: "Y-m-d H:i",
        defaultDate: new Date()
    });

    // Show/hide datetime picker when select changes
    $('#requiredTimeSelect').on('change', function () {
        $('#dateTimeDiv').toggle(this.value === "2");
    }).trigger('change'); // trigger on load to set default
});

// --- Submit handler ---
$("#newTripForm").submit(async function (event) {
    event.preventDefault();

    const submitBtn = document.getElementById("tripSubmitBtn");
    const resetBtn  = document.getElementById("tripResetBtn");
    submitBtn.disabled = true;
    resetBtn.disabled  = true;

    // Gather form values
    const passenger_phone_no = $("#memberPhoneNo").val() || "";
    const passenger_name     = $("#memberSelect").val() || "";
    const pickup_location    = $("#pickupLocation").val() || "";
    const pickup_lat         = $("#pickupLocationLat").val() || "";
    const pickup_lng         = $("#pickupLocationLng").val() || "";
    const drop_location      = $("#dropLocation").val() || "";
    const drop_lat           = $("#dropLocationLat").val() || "";
    const drop_lng           = $("#dropLocationLng").val() || "";
    const taxi_category_id   = $("#vehicleTypeSelect").val() || "";
    const estimate_id        = $("#estimateId").val() || "";
    const branch_id          = $("#branchSelect").val() || "";
    const department_id      = $("#departmentSelect").val() || "";
    const remarks            = $("#remarks").val() || "";
    const driver_remarks     = $("#driverRemarks").val() || "";

    const company_id  = window.sessionData?.company_id || "";
    const employee_id = window.sessionData?.employee_id || passenger_name;

    // Determine required_time
    let required_time = "";
    const requiredTimeSelect = $("#requiredTimeSelect").val();
    if (requiredTimeSelect === "1") {
        const now = new Date();
        required_time = `${now.getFullYear()}-${padTo2Digits(now.getMonth() + 1)}-${padTo2Digits(now.getDate())} ${padTo2Digits(now.getHours())}:${padTo2Digits(now.getMinutes())}`;
    } else if (requiredTimeSelect === "2") {
        required_time = $("#tripDateTime").val();  
    }

    const data = {
        passenger_phone_no,
        passenger_name,
        pickup_location,
        pickup_lat,
        pickup_lng,
        drop_location,
        drop_lat,
        drop_lng,
        taxi_category_id,
        required_time,
        estimate_id,
        company_id,
        branch_id,
        department_id,
        employee_id,
        remarks,
        driver_remarks
    };

    console.log("Booking Request Data:", data);

    try {
        let result = await fetchPost('../service/submit-new-trip.php', data);

        if (result.status === 0) {
            const bookingId = result.data?.info?.booking_id || "N/A";
            showSimpleNotification(`Booking Created! Booking ID: ${bookingId}`, 'success');
            setTimeout(() => { location.reload(); }, 1000);
        } else {
            const errorMsg = result.data?.message || result.message || "Booking Request Failed";
            showSimpleNotification(errorMsg, 'error');
        }
    } catch (err) {
        console.error(err);
        showSimpleNotification('Request failed. Please try again.', 'error');
    } finally {
        submitBtn.disabled = false;
        resetBtn.disabled  = false;
    }
});

// --- Helper: show simple notification popup ---
function showSimpleNotification(message, type = 'success') {
    let notif = document.getElementById('simpleNotification');
    if (!notif) {
        notif = document.createElement('div');
        notif.id = 'simpleNotification';
        notif.style = `
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: ${type === 'success' ? '#4CAF50' : '#f44336'};
            color: white;
            padding: 15px;
            border-radius: 5px;
            z-index: 9999;
            font-weight: bold;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        `;
        document.body.appendChild(notif);
    }

    notif.innerText = message;
    notif.style.backgroundColor = type === 'success' ? '#4CAF50' : '#f44336';
    notif.style.display = 'block';

    setTimeout(() => { notif.style.display = 'none'; }, 3000);
}

// Helper
function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

// --- Map & Markers ---
const setMarkerAndEstimateCalculate = (data) => {
    const vehicleType = $("#vehicleTypeSelect").val();
    const location = {
        lat: parseFloat($("#" + data.latLocText).val()),
        lng: parseFloat($("#" + data.lngLocText).val())
    };

    const marker = setMarkerWithIconLabelWithDragable(googleMap, data.markerIconLabel, data.markerTitle, location);

    if (data.markerIconLabel === "S") {
        if (markers.startmarker) clearMarker(markers.startmarker);
        markers.startmarker = marker;
        markers.startmarker.addListener('dragend', (e) => {
            markerDragableEvent(e, 'pickupLocation', () => {
                calculateTripDistanceAndTime(googleMap, markers, "estimateTripTime", "estimateTripDistance", vehicleType);
                drawRouteWithGoogleMap(googleMap, markers, vehicleType, "pickupLocation", "dropLocation");
            });
        });
    } else {
        if (markers.endmarker) clearMarker(markers.endmarker);
        markers.endmarker = marker;
        markers.endmarker.addListener('dragend', (e) => {
            markerDragableEvent(e, 'dropLocation', () => {
                calculateTripDistanceAndTime(googleMap, markers, "estimateTripTime", "estimateTripDistance", vehicleType);
                drawRouteWithGoogleMap(googleMap, markers, vehicleType, "pickupLocation", "dropLocation");
            });
        });
    }

    setAllMarkersVisible(googleMap, [markers.startmarker, markers.endmarker]);
    calculateTripDistanceAndTime(googleMap, markers, "estimateTripTime", "estimateTripDistance", vehicleType);
    drawRouteWithGoogleMap(googleMap, markers, vehicleType, "pickupLocation", "dropLocation");
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

export const getEmployeeDetailsForSelect = async () => {
    const load = loading("#mainPanel");
    let result = await fetchPost('../service/get-employee-details-for-select.php', {});
    stopLoading(load);

    if (result.status === 0 && result.data.status === 0) {
        const innerData = Array.isArray(result.data.data) ? result.data.data : result.data.data?.data || [];
        populateSelect('#memberSelect', innerData, 'employee_id', 'employee_name');
    } else if (result.data.status === 1) {
        window.location.href = "../view/440.php";
    } else {
        notification('error', 'ERROR', result.data.message || 'Failed to load employees');
    }
};

export const getVehicleDetailsForSelect = async () => {
    const load = loading("#mainPanel");
    let result = await fetchPost('../service/get-vehicle-details-for-select.php', {});
    stopLoading(load);

    if (result.status === 0 && result.data.status === 0) {
        const innerData = Array.isArray(result.data.data) ? result.data.data : result.data.data?.data || [];
        populateSelect('#vehicleTypeSelect', innerData, 'category_id', 'description');
    } else if (result.data.status === 1) {
        window.location.href = "../view/440.php";
    } else {
        notification('error', 'ERROR', result.data.message || 'Failed to load vehicles');
    }
};


// --- Fetch & display Credit Info ---
export const getCreditDetails = async () => {
    const load = loading("#mainPanel");
    let result = await fetchPost('../service/get-credit-details.php', {});
    stopLoading(load);
    if (result.status === 0 && result.data.status === 0) {
        const creditLimit   = result.data.data.credit_limit || 0;
        const creditBalance = result.data.data.credit_balance || 0;
        $('#creditLimit').text(creditLimit.toLocaleString());
        $('#creditBalance').text(creditBalance.toLocaleString());
    } else {
        $('#creditLimit').text('0');
        $('#creditBalance').text('0');
    }
};
