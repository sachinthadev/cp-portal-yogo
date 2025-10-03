import {fetchPost} from './request.js';
import {loading, stopLoading, notification, showModal} from "./util.js";
import {initilizeMap, drawRouteWithPolyLines, setMarkerWithIconLabel} from "./map.js";

window.onload = function () {

    let bookingId = document.getElementById("bookingId").value;
    loadRouteDetails(bookingId);

    /**
     * Button Click
     */
    $("#backModalBtn").click(function () {
        window.history.back();
    });
}

/**
 * initilize map
 */
const googleMap = initilizeMap("gmapRoute")


const loadRouteDetails = async (bookingId) => {
    const load = loading("#mainPanel");
    const data = {
        bookingid: bookingId
    };
    let result = await fetchPost('../service/get-route-details.php', data);
    if (result.status === 0) {
        if (result.data.status === 0) {
            const routeDetails = result.data.data;
            if (routeDetails.meterdata.length > 0) {
                let driveCords = new Array()
                routeDetails.meterdata.forEach((data, index) => {
                    //adding data to the location array
                    const driveCord = {lat: parseFloat(data.lat), lng: parseFloat(data.lon)}
                    driveCords.push(driveCord)
                    let markerTitle
                    switch (index) {
                             case (routeDetails.meterdata.length - 1):
                            markerTitle = "Start Location"
                            setMarkerWithIconLabel(googleMap, "S", markerTitle, driveCords[index], contentBody(routeDetails, markerTitle))
                            break;
                        case 0:
                            markerTitle = "END Location"
                            setMarkerWithIconLabel(googleMap, "E", markerTitle, driveCords[index], contentBody(routeDetails, markerTitle))
                    }
                })
                drawRouteWithPolyLines(googleMap, driveCords)
            } else
                showModal("messageModal")

        } else if (result.data.status === 1) {
            window.location.href = "../view/440.php";
        } else if (result.data.status === 2) {
            notification('error', 'ERROR', result.data.message);
        } else if (result.data.status === 3) {
            showModal("messageModal")
        }
    } else {
        notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
        console.error(result.data);
    }

    stopLoading(load);//stop loading
}

const contentBody = (data, title) => {
    return `<div id="content">
              <div id="siteNotice">
              </div>
               <h1 id="firstHeading" class="firstHeading">${title}</h1>
                <div id="bodyContent">
                   <p>
                     <b>Booking ID :</b> ${data.BookingID}<br>
                     <b>Employee Name :</b> ${data.ClientName}<br>
                     <b>Employee Contact No :</b> ${data.ClientMobile}<br>
                     <b>Meter On Time :</b> ${data.MeterOnTime}<br>
                     <b>Total Distance :</b> ${parseFloat(data.RunningKM).toFixed(2)}<br>
                     <b>Waiting Time :</b> ${data.WaitingTime} min<br>
                     </p>
                </div>
           </div>`
}