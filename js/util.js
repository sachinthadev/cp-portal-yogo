import { fetchPost } from './request.js';

export function notification(type, heading, message) {

    $('#toast-container').remove();
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr[type](message, heading);
}

export function loading(container) {
    return $(container).waitMe({
        effect: 'ios',
        text: 'Loading...',
        bg: 'rgba(255,255,255,0.90)',
    });
}

export function stopLoading(loading) {
    //Loading hide
    loading.waitMe('hide');
}

export function pageAlert(state, text) {
    let stateClass = '';
    switch (state) {
        case 1:
            stateClass = "alert-success"//completed
            break;
        case 2:
            stateClass = "alert-info"//in progress
            break;
        case 3:
            stateClass = "alert-warning"//canceled
            break;
        default:
            stateClass = "alert-danger"//unknown
            break;
    }
    $(".alert")
        .addClass(`${stateClass}`)
        .append(`State :  <strong>${text}</strong>`);

}

export function refreshSession() {
    const refreshTime = 600000; // every 10 minutes in milliseconds
    window.setInterval(async function () {
        const data = {};
        let result = fetchPost('../service/refresh-session.php', data);
    }, refreshTime);
}

export function showModal(modalName) {
    $(`#${modalName}`).modal({ backdrop: 'static', keyboard: false }, 'show');
}

export function closeModal(modalName) {
    $(`#${modalName}`).modal('toggle');
}

export function getOneDateBeforeCurrentDate() {
    return moment().add(1, 'days');
}

export function getSevenDaysBackFromCurrentDate() {
    return moment().subtract(7, 'days');
}

export function getThirtyDaysBackFromCurrentDate() {
    return moment().subtract(30, 'days');
}

export function getVehicleIconById(id) {
    let icon;
    switch (id) {
        case 1:
            icon = "../images/yogovehiclesicon/1/1.png"
            break;
        case 2:
            icon = "../images/yogovehiclesicon/2/1.png"
            break;
        case 3:
            icon = "../images/yogovehiclesicon/3/1.png"
            break;
        case 5:
            icon = "../images/yogovehiclesicon/5/1.png"
            break;
        case 7:
            icon = "../images/yogovehiclesicon/7/1.png"
            break;
        case 8:
            icon = "../images/yogovehiclesicon/8/1.png"
            break;
        case 9:
            icon = "../images/yogovehiclesicon/9/1.png"
            break;
        case 10:
            icon = "../images/yogovehiclesicon/10/1.png"
            break;
        case 11:
            icon = "../images/yogovehiclesicon/11/3.png"
            break;
        case 12:
            icon = "../images/yogovehiclesicon/12/1.png"
            break;

    }
    return icon
}

export function getCurrentLocation(latText, lngText, locationText, locationName) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {

            const lat = position.coords.latitude
            const lng = position.coords.longitude
            document.getElementById(latText).value = lat
            document.getElementById(lngText).value = lng
            if (locationName) {
                locationName(lat, lng, locationText)
            }
        });
    }
}