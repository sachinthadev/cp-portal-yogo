import { fetchPost } from './request.js';
import { showModal } from "./util.js";
import { notification } from "./util.js";


/**
 * Init the map
 * @param divTag
 * @returns {jvm.Map|Map<any, any>}
 */

let directionsRenderer;
const tripDistance = 0;

export function initilizeMap(divTag) {
    const googleMap = new google.maps.Map(document.getElementById(divTag), {
        center: { lat: 6.7881, lng: 79.8913 },
        zoom: 10,
        streetViewControl: false,
        disableDefaultUI: true
    });

    directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });

    directionsRenderer.setMap(googleMap)

    return googleMap
}

export function placeSearchByText(autoCompleteTextBox, latTextBox, lngTextBox, setMapFun) {
    const options = {
        componentRestrictions: { country: "lk" }
    };

    const autocomplete = new google.maps.places.Autocomplete(document.getElementById(autoCompleteTextBox), options);

    autocomplete.addListener("place_changed", () => {
        const place = autocomplete.getPlace();
        document.getElementById(latTextBox).value = place.geometry.location.lat();
        document.getElementById(lngTextBox).value = place.geometry.location.lng();

        if (setMapFun)
            setMapFun()
    });
}

export function setMarker(googleMap, markerIcon, markerTitle, location, content) {

    //init info window
    const infowindow = new google.maps.InfoWindow({
        content: content,
    });

    //make the marker
    const marker = new google.maps.Marker({
        position: location,
        map: googleMap,
        title: markerTitle,
        icon: markerIcon
    });

    //marker click listener
    marker.addListener("click", () => {
        infowindow.open(googleMap, marker);
    });

    return marker
}


export function setMarkerLive(googleMap, markerIcon, markerTitle, location, content, bookingId) {

    //init info window
    const infowindow = new google.maps.InfoWindow({
        content: content,
    });

    //make the marker
    const marker = new google.maps.Marker({
        position: location,
        map: googleMap,
        title: markerTitle,
        icon: markerIcon
    });

    //marker click listener
    marker.addListener("click", () => {
        infowindow.open(googleMap, marker);
        loadRouteDetails(googleMap, bookingId, markerIcon, marker)
    });

    return marker
}

export function setMarkerWithIconLabel(googleMap, iconLabel, markerTitle, location, content) {

    //make the marker
    const marker = new google.maps.Marker({
        position: location,
        map: googleMap,
        title: markerTitle,
        label: iconLabel
    });

    if (content) {
        //init info window
        const infowindow = new google.maps.InfoWindow({
            content: content,
        });

        //marker click listener
        marker.addListener("click", () => {
            infowindow.open(googleMap, marker);
        });
    }

    return marker
}

export function setMarkerWithIcon(googleMap, markerIcon, markerTitle, location, content) {

    //make the marker
    const marker = new google.maps.Marker({
        position: location,
        map: googleMap,
        title: markerTitle,
        icon: markerIcon
    });

    if (content) {
        //init info window
        const infowindow = new google.maps.InfoWindow({
            content: content,
        });

        //marker click listener
        marker.addListener("click", () => {
            infowindow.open(googleMap, marker);
        });
    }

    return marker
}

export function setMarkerWithIconLabelAndColour(googleMap, iconLabel, markerTitle, location, content) {

    //make the marker
    const marker = new google.maps.Marker({
        icon: {
            url: "../images/mapicon/" + iconLabel + "",
            title: markerTitle,
            labelOrigin: new google.maps.Point(24, 35),
        },
        map: googleMap,
        position: location,
        label: {
            color: 'black',
            fontWeight: 'bold',
            text: markerTitle,
        },
        animation: google.maps.Animation.DROP,

    });

    if (content) {
        //init info window
        const infowindow = new google.maps.InfoWindow({
            content: content,
        });

        //marker click listener
        marker.addListener("click", () => {
            infowindow.open(googleMap, marker);
        });
    }

    return marker
}

export function setMarkerWithIconLabelWithDragable(googleMap, iconLabel, markerTitle, location, content) {

    //make the marker
    const marker = new google.maps.Marker({
        position: location,
        map: googleMap,
        title: markerTitle,
        draggable: true,
        label: iconLabel
    });

    if (content) {
        //init info window
        const infowindow = new google.maps.InfoWindow({
            content: content,
        });

        //marker click listener
        marker.addListener("click", () => {
            infowindow.open(googleMap, marker);
        });
    }

    return marker
}

export function markerDragableEvent(e, textBox, next) {
    const latlng = {
        lat: parseFloat(e.latLng.lat()),
        lng: parseFloat(e.latLng.lng()),
    };
    reverseGeoCording(latlng.lat, latlng.lng, textBox, next)
}

export function setAllMarkersVisible(googleMap, markers) {
    let bounds = new google.maps.LatLngBounds();
    markers.forEach((marker, index) => {
        if (marker)
            bounds.extend(marker.getPosition())
    })

    google.maps.event.addListener(googleMap, 'zoom_changed', function () {
        const zoomChangeBoundsListener =
            google.maps.event.addListener(googleMap, 'bounds_changed', function (event) {
                if (this.getZoom() > 15 && this.initialZoom == true) {
                    // Change max/min zoom here
                    this.setZoom(15);
                    this.initialZoom = false;
                }
                google.maps.event.removeListener(zoomChangeBoundsListener);
            });
    });
    googleMap.initialZoom = true;
    googleMap.fitBounds(bounds)
}

export function clearMarker(marker) {
    marker.setMap(null)
}

export function calculateTripDistanceAndTime(googleMap, markers, estiamteTimeText, estimateDisText, vehicle) {
    if (markers.startmarker && markers.endmarker && vehicle != 0) {
        let avoidHighWays = false
        let avoidTrolls = false

        if (vehicle == 1) {
            avoidHighWays = true
            avoidTrolls = true
        }

        document.getElementById(estiamteTimeText).value = "Calculating.."
        document.getElementById(estimateDisText).value = "Calculating.."

        const service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix({
            origins: [markers.startmarker.position],
            destinations: [markers.endmarker.position],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: avoidHighWays,
            avoidTolls: avoidTrolls
        }, function (response, status) {
            if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {

                document.getElementById(estiamteTimeText).value = (response.rows[0].elements[0].duration.value / 60).toFixed(0)
                document.getElementById(estimateDisText).value = (response.rows[0].elements[0].distance.value / 1000).toFixed(2)

                getTripAmount((response.rows[0].elements[0].distance.value / 1000).toFixed(2), vehicle);
                console.log(tripDistance);

            } else {
                alert("Unable to find the distance via road.");
            }

        });
    }
}

const getTripAmount = async (estimateTripDistance, vehicleType) => {
    const data = {
        estimatetripdistance: estimateTripDistance,
        vehiclecategory: vehicleType
    };

    try {
        let result = await fetchPost('../service/get-estimate-trip-amount.php', data);
        console.log("API Response =>", result);

        // ✅ handle response correctly
        if (result?.status === 0 && result?.data?.status === 0 && result?.data?.info) {
            const details = result.data.info; // ✅ correct path
            console.log("Estimate Details =>", details);

            // Show values in inputs
            document.getElementById("estimateTripAmount").value = details.estimated_amount;
            document.getElementById("estimateId").value = details.estimate_id;
            document.getElementById("estimateTripDistance").value = estimateTripDistance;
        } else {
            console.error("Unexpected API response", result);
        }
    } catch (err) {
        console.error("Fetch Error:", err);
    }
};





export function drawRouteWithPolyLines(googleMap, lineCords) {

    const drivePath = new google.maps.Polyline({
        path: lineCords,
        geodesic: true,
        strokeColor: "#FF0000",
        strokeOpacity: 1.0,
        strokeWeight: 2,
    });
    let bounds = new google.maps.LatLngBounds();
    lineCords.forEach((loc) => {
        bounds.extend(loc)
    })

    google.maps.event.addListener(googleMap, 'zoom_changed', function () {
        const zoomChangeBoundsListener =
            google.maps.event.addListener(googleMap, 'bounds_changed', function (event) {
                if (this.getZoom() > 15 && this.initialZoom == true) {
                    // Change max/min zoom here
                    this.setZoom(15);
                    this.initialZoom = false;
                }
                google.maps.event.removeListener(zoomChangeBoundsListener);
            });
    });
    googleMap.initialZoom = true;
    googleMap.fitBounds(bounds)
    drivePath.setMap(googleMap);
}

const loadRouteDetails = async (googleMap, bookingId, markerIcon, marker) => {
    console.log(bookingId);
    const data = {
        bookingid: bookingId
    };
    let result = await fetchPost('../service/get-route-details.php', data);
    console.log(result.status);
    if (result.status === 0) {
        console.log(result.data.status);
        if (result.data.status === 0) {

            const routeDetails = result.data.data;
            console.log(routeDetails.meterdata.length);
            if (routeDetails.meterdata.length > 0) {
                clearMarker(marker);
                let driveCords = new Array()
                let markerTitle
                let id = 0;
                // if (routeDetails.BookingStatus = "PC") {
                routeDetails.meterdata.forEach((data, index) => {
                    //adding data to the location array
                    const driveCord = { lat: parseFloat(data.lat), lng: parseFloat(data.lon) }
                    driveCords.push(driveCord)
                    if (routeDetails.BookingStatus === 'PC') {
                        console.log(routeDetails.BookingStatus);

                        switch (index) {
                            case 0:
                                markerTitle = "End Location"
                                setMarkerWithIconLabel(googleMap, "E", markerTitle, driveCords[index], contentBody(routeDetails, markerTitle))
                                break;
                            case (routeDetails.meterdata.length - 1):
                                markerTitle = "Start Location"
                                setMarkerWithIconLabel(googleMap, "S", markerTitle, driveCords[index], contentBody(routeDetails, markerTitle))
                        }
                    }
                    else {
                        const dropCode = { lat: parseFloat(routeDetails.drop_lat), lng: parseFloat(routeDetails.drop_lon) }
                        console.log(id);

                        const marker1 = "";
                        markerTitle = "End Location"
                        setMarkerWithIconLabel(googleMap, "E", markerTitle, dropCode, contentBody(routeDetails, markerTitle))

                        switch (index) {
                            case (routeDetails.meterdata.length - 1):
                                markerTitle = "Start Location"
                                setMarkerWithIconLabel(googleMap, "S", markerTitle, driveCords[index], contentBody(routeDetails, markerTitle))
                                break;
                            case 0:
                                console.log("123");
                                markerTitle = "Current Location"
                                setMarkerWithIcon(googleMap, markerIcon, markerTitle, driveCords[index], contentBody(routeDetails, markerTitle))
                        }

                        return marker1
                    }
                })
                console.log(driveCords);
                drawRouteWithPolyLines(googleMap, driveCords)
            } else
                showModal("messageModal")
            //stopLoading(load);//stop loading

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

export function drawRouteWithGoogleMap(googleMap, markers, vehicle, startLocTextBox, endLocTextBox) {
    if (markers.startmarker && markers.endmarker && vehicle != 0) {
        const directionsService = new google.maps.DirectionsService();

        let avoidHighWays = false
        let avoidTrolls = false

        if (vehicle == 1) {
            avoidHighWays = true
            avoidTrolls = true
        }

        console.log('origin', document.getElementById(startLocTextBox).value)
        console.log('Destination', document.getElementById(endLocTextBox).value)

        const request = {
            origin: document.getElementById(startLocTextBox).value,
            destination: document.getElementById(endLocTextBox).value,
            travelMode: google.maps.TravelMode.DRIVING,
            avoidHighways: avoidHighWays,
            avoidTolls: avoidTrolls,
        };

        directionsService
            .route(request)
            .then((response) => {
                directionsRenderer.setDirections(response);
            })
            .catch((e) => console.log(e.message));
    }
}

export function reverseGeoCording(lat, lng, locationText, next) {
    const latlng = { lat: lat, lng: lng }
    const geocoder = new google.maps.Geocoder();
    geocoder.geocode({ location: latlng }, (results, status) => {
        if (status === "OK") {
            if (results[0]) {
                if (locationText) {
                    document.getElementById(locationText).value = results[0].formatted_address
                    if (next) {
                        next()
                    }
                }
            } else {
                window.alert("No results found");
            }
        }
    });
}