<?php
require_once('utils.php');

class Visualisation1Model {

	function Visualisation1Model() {
	}

	function get($api_url, $visualisationsPath) {
		global $wpdb;

		// Read from file
		$path = get_stylesheet_directory();
		$file = "$path/renderization/data/data/visualisation1.json";

		if (file_exists($file)) {
			$data = json_decode(file_get_contents($file), true);
			return $data;
		}

		$data = Array();

		$apiData = $this->formatApiData($api_url);

		$data["visualisation1"]["data"] = json_encode($apiData);

		// Store in file
		file_put_contents($file, json_encode($data));

		return $data;
	}

	function formatApiData($api_url) {
		// Areas
		$areas = json_decode(file_get_contents($api_url . '/areas/countries?info=false'), true);

		// Areas Info
		$areasInfo = json_decode(file_get_contents($api_url . '/areasInfo'), true);

		// Indicators
		$indicators = json_decode(file_get_contents($api_url . '/visualisationsGroupedByArea/ACCESS,INFRASTRUCTURE/ALL/2014'), true);

		return array(
			"areas" => $areas,
			"areasInfo" => $areasInfo,
			"indicators" => $indicators
		);
	}
}
?>
