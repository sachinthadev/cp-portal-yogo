import { fetchPost } from './request.js';
import { loading, stopLoading, notification, getVehicleIconById } from "./util.js";
import { initilizeMap, setMarker, clearMarker, setAllMarkersVisible, setMarkerLive } from "./map.js";

let markers = null
let liveMapRefreshTimer = null;
window.onload = function () {
    $('#tripManagementNav').addClass('active');
    $('#liveMapNav').addClass('active');
    $('#tripManagementList').addClass('collapse in');

    /**
     * get live vehicles
     */
    getLiveMapDetail()

    /***
     * Init Timer and function in 1 min
     */
    liveMapRefreshTimer = setInterval(function () {
        getLiveMapDetail()
    }, 60 * 1000);


}

/**
 * initilize map
 */
const googleMap = initilizeMap("gmapLive")


const getLiveMapDetail = async () => {
    const load = loading("#mainPanel");
    const data = {};
    let result = await fetchPost('../service/get-live-map-vehicle-details.php', data);
    stopLoading(load);//stop loading
    if (result.status === 0) {
        if (result.data.status === 0) {
            const liveMapData = result.data.data
            console.log(liveMapData)

            if (markers) {
                markers.forEach((marker, index) => {
                    clearMarker(marker)
                })
            } else {
                markers = new Array();
            }

            liveMapData.forEach((data, index) => {
                //vehicle location
                const location = { lat: data.latitude, lng: data.longitude };

                //info content
                const contentString = `<div id="content">
                                            <div id="siteNotice">
                                       </div>
                                       <h1 id="firstHeading" class="firstHeading">${data.employee_name}</h1>
                                           <div id="bodyContent">
                                                <p>
                                                <b>Booking ID :</b> ${data.booking_id}<br>
                                                <b>Employee Contact No :</b> ${data.employee_phone_number}<br>
                                                <b>Driver Name :</b> ${data.driver_name}<br>
                                                <b>Driver Contact No :</b> ${data.driver_phone_number}<br>
                                                <b>Vehicle No :</b> ${data.vehicle_number}(${data.category})<br>
                                                <b>Start Time :</b> ${data.start_time}<br>
                                                <b>PickUp Location :</b> ${data.pickup_address}<br>
                                                <b>Drop Location :</b> ${data.drop_address}<br>
                                                </p>
                                           </div>
                                       </div>`
                console.log(data.booking_id);
                const marker = setMarkerLive(googleMap, getVehicleIconById(data.category_id), data.employee_name, location, contentString, data.booking_id)
                markers.push(marker);
                //loadRouteDetails(data.booking_id);
            })
            setAllMarkersVisible(googleMap, markers)


        } else if (result.data.status === 1) {
            window.location.href = "../view/440.php";
        } else if (result.data.status === 2) {
            notification('error', 'ERROR', result.data.message);
        }
    } else {
        notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
        console.error(result.data);
    }
}

// const loadRouteDetails = async (bookingId) => {
//     console.log(bookingId);
//     const load = loading("#mainPanel");
//     const data = {
//         bookingid: bookingId
//     };
//     let result = await fetchPost('../service/get-route-details.php', data);
//     if (result.status === 0) {
//         if (result.data.status === 0) {
//             const routeDetails = result.data.data;
//             console.log(result.data.data);
//             if (routeDetails.meterdata.length > 0) {
//                 let driveCords = new Array()
//                 routeDetails.meterdata.forEach((data, index) => {
//                     //adding data to the location array
//                     const driveCord = { lat: parseFloat(data.lat), lng: parseFloat(data.lon) }
//                     driveCords.push(driveCord)
//                     let markerTitle
//                     switch (index) {
//                         case 0:
//                             markerTitle = "Start Location"
//                             setMarkerWithIconLabel(googleMap, "S", markerTitle, driveCords[index], contentBody(routeDetails, markerTitle))
//                             break;
//                         case (routeDetails.meterdata.length - 1):
//                             markerTitle = "End Location"
//                             setMarkerWithIconLabel(googleMap, "E", markerTitle, driveCords[index], contentBody(routeDetails, markerTitle))
//                     }
//                 })
//                 console.log(driveCords);
//                 drawRouteWithPolyLines(googleMap, driveCords)
//             } else
//                 //showModal("messageModal")
//             stopLoading(load);//stop loading

//         } else if (result.data.status === 1) {
//             window.location.href = "../view/440.php";
//         } else if (result.data.status === 2) {
//             notification('error', 'ERROR', result.data.message);
//         } else if (result.data.status === 3) {
//             showModal("messageModal")
//         }
//     } else {
//         notification('error', 'ERROR', 'Something went wrong, Please refresh and try again');
//         console.error(result.data);
//     }

//     stopLoading(load);//stop loading
// }