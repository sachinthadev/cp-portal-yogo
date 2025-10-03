<?php
include_once('header.php');
?>
<link href="../style/table-mobile.css" rel="stylesheet"/>
<section class="content">
    <div class="page-heading">
        <h1>MY ATTENDANCE</h1>
        <ol class="breadcrumb">
            <li><a href="../index.php">Home</a></li>
            <li><a href="javascript:void(0);">Shuttle Service</a></li>
            <li class="active">My Attendance</li>
        </ol>
    </div>
    <div class="page-body clearfix">
        <div class="panel panel-default" data-panel-close="false" id="mainPanel">
            <div class="panel-heading">
                Month Plan
            </div>
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group has-feedback">
                        <div class="col-sm-4">
                            <label>Select Date</label>
                            <input type="text" placeholder="Please choose a date..." data-format="YYYY-MM-DD"
                                   class="form-control js-dtp" id="datePicker"/>
                            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table id="routeTable" class="table table-striped table-hover dataTable" width="100%" hidden>
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Days of week</th>
                            <th>Pickup Route</th>
                            <th>Drop Off Route</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>01</td>
                            <td>Sunday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>Monday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>03</td>
                            <td>Tuesday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>04</td>
                            <td>Wednesday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>05</td>
                            <td>Thursday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>06</td>
                            <td>Friday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>07</td>
                            <td>Saturday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>08</td>
                            <td>Sunday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>09</td>
                            <td>Monday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Tuesday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Wednesday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Thursday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>Friday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>Saturday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>Sunday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>Monday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>Tuesday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>Wednesday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>Thursday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>Friday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>Saturday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>Sunday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>23</td>
                            <td>Monday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>Tuesday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>Wednesday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>26</td>
                            <td>Thursday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>Friday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>28</td>
                            <td>Sunday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>29</td>
                            <td>Sunday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>30</td>
                            <td>Monday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>31</td>
                            <td>Tuesday</td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Pickup Route Select --</option>
                                    <option value="1">9.30am Kottawa Pickup</option>
                                    <option value="2">11.00am Kottawa Pickup</option>
                                </select>
                            </td>
                            <td><select id="vehicleTypeSelect" name="vehicleTypeSelect" class="form-control show-tick">
                                    <option value="0" selected disabled>-- Drop Off Route Select --</option>
                                    <option value="1"> 7.30PM Kottawa Drop</option>
                                    <option value="2">11.00PM Kottawa Drop</option>
                                </select></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Days of week</th>
                            <th>Pickup Route</th>
                            <th>Drop Off Route</th>
                        </tr>
                        </tfoot>

                    </table>
                </div>
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <button type="submit" id="saveManageAttendanceBtn" class="btn btn-block btn-success">SUBMIT
                            </button>
                        </div>
                        <div class="col-xs-6">
                            <button type="reset" id="manageAttendanceResetBtn" class="btn btn-block btn-danger">RESET
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once('default-imports.php');
?>
<!-- Custom js -->
<script src="../js/my-attendance.js" type="module"></script>
</body>

</html>

