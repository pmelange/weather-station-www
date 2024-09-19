<?php
header('Content-Type: application/json');
$con=mysqli_connect("localhost","pi","password","weather");

$select_query = "SELECT *, UNIX_TIMESTAMP(CREATED) as UNIX_TIME  FROM SCH8_WEATHER_MEASUREMENT ORDER BY ID DESC LIMIT 1;";
 
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con, $select_query);

$row = mysqli_fetch_array($result);
$resultrow["ROOF_TEMPERATURE"] = floatval($row["ROOF_TEMPERATURE"]);
$resultrow["CABINET_TEMPERATURE"] = floatval($row["CABINET_TEMPERATURE"]);
$resultrow["AIR_QUALITY"] = floatval($row["AIR_QUALITY"]);
$resultrow["HUMIDITY"] = floatval($row["HUMIDITY"]);
$resultrow["WIND_DIRECTION"] = floatval($row["WIND_DIRECTION"]);
$resultrow["WIND_SPEED"] = floatval($row["WIND_SPEED"]);
$resultrow["WIND_GUST_SPEED"] = floatval($row["WIND_GUST_SPEED"]);
$resultrow["RAINFALL"] = floatval($row["RAINFALL"]);
$resultrow["UNIX_TIME"] = floatval($row["UNIX_TIME"]) * 1000; 
$resultrow["MSL_PRESSURE"] = ( floatval($row["AIR_PRESSURE"])/(pow(1-(60/44330.0),5.255)) );
echo json_encode($resultrow);

mysqli_close($con);
?>
