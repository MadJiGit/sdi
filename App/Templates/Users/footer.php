<?php
$api = new \App\WeatherApi\Api();
$weather = new \App\Data\WeatherDTO($api->getValue());
?>
<!doctype html>

<html>
<h2>Weather Forecast for <?php echo $weather->getCityName(); ?></h2>
<table>
	<tr><th>Date</th><th>Time</th><th>Min Temp</th><th>Current Temp</th><th>Max Temp</th><th>Precip</th><th>Wspd</th></tr>
		<tr>
			<td><?php echo $weather->getDate(); ?></td>
			<td><?php echo $weather->getTime(); ?></td>
			<td><?php echo $weather->getMainMinTemp() .' C';?></td>
			<td><?php echo $weather->getMainCurrentTemp() .' C'; ?></td>
			<td><?php echo $weather->getMainMaxTemp() .' C'; ?></td>
			<td><?php echo $weather->getMainHumidity() . '%'; ?></td>
			<td><?php echo $weather->getMainPressure() .'%'?></td>
			<td><?php echo $weather->getWindSpeed(). 'm/s' ?></td>
		</tr>
</table>