<!-- Left Menu -->
<aside class="sidebar">
    <nav class="sidebar-nav">
        <ul class="metismenu">
            <li class="title">
            <?php
              echo $_SESSION["company_name"]
            ?>
            </li>
            <li id="dashboardNav">
                <a href="dashboard.php">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-label">Dashboards</span>
                </a>
            </li>
            <li id="newTripNav"
             
            > <!-- user permission -->
                <a href="new-trip.php">
                    <i class="material-icons">directions_car</i>
                    <span class="nav-label">New Trip</span>
                </a>
            </li>
            <li id="quickTripNav">
                <a href="quick-trip.php">
                    <i class="material-icons">directions_run</i>
                    <span class="nav-label">Quick Trip</span>
                </a>
            </li>
             <li id="allTripsNav">
                <a href="trip-history.php">
                    <i class="material-icons">person_pin</i>
                    <span class="nav-label">Trip History</span>
                </a>
            </li>
            <li id="myTripsNav">
                <a href="my-trips.php">
                    <i class="material-icons">person_pin</i>
                    <span class="nav-label">My Trips</span>
                </a>
            </li>
            <li id="shuttleServiceManagementNav">
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">directions_bus</i>
                    <span class="nav-label">Shuttle Service</span>
                </a>
                <ul id="shuttleServiceManagementList">
                    <li id="myAttendanceNav">
                        <a href="my-attendance.php">My Attendance</a>
                    </li>
                    <li id="routeAttendanceManageNav">
                        <a href="route-attendance-manage.php">Manage Attendance</a>
                    </li>
                </ul>
            </li>
            <li id="teamManagementNav"
        
            > <!-- user permission -->
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">group</i>
                    <span class="nav-label">Team Management</span>
                </a>
                <ul id="driverRegistrationList">
                    <li id="addNewDriverRegistrationNav">
                        <a href="add-member.php">Member Registration</a>
                    </li>
                    <li id="driverRegistrationListNav">
                        <a href="team-list.php">Team List</a>
                    </li>
                </ul>
            </li>
            <li id="tripManagementNav"
                
            > <!-- user permission -->
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">directions_car</i>
                    <span class="nav-label">Trip Management</span>
                </a>
                <ul id="tripManagementList">
                    <li id="activeTripsNav">
                        <a href="trips-active.php">Active Trips</a>
                    </li>
                    <li id="tripHistoryNav">
                        <a href="trip-history.php">Trip History</a>
                    </li>
<!--                    <li id="tripCancelNav">-->
<!--                        <a href="trip-cancel.php">Cancel Trips</a>-->
<!--                    </li>-->
                    <li id="tripCanceledNav">
                        <a href="trip-canceled.php">Canceled Trips</a>
                    </li>
                    <li id="liveMapNav">
                        <a href="live-map.php">Live Map</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
<!-- #END# Left Menu -->
