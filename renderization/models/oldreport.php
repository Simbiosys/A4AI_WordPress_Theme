<?php
require_once('utils.php');

class OldreportModel {

	function OldreportModel() {
	}

	function get($api_url, $visualisationsPath) {
		global $wpdb;

		$data = Array();
		$chapters = Array();

		// Obtain the post id through its name
		$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'report'");

		// Obtain the post through its id
		$post = get_post($id);

		// Filter the post content
		$post_content = apply_filters('the_content', $post->post_content);

		$chapter_counter = 0;
		$html = "";

		$dataTables = $this->generateDataTables($api_url);

		$chapterData = sliceHtmlIntoChapters($post_content, $dataTables);

		foreach($chapterData["chapters"] as $chapter) {
        	$chapter_counter++;

        	$article = str_get_html($chapter);

            $chapters['chapter_'.$chapter_counter] = $article;
            $html .= $article;
        }

		$slices = generateSideBar($chapters);

		$data["report"]["content"] = $html;
		$data["report"]["ul"] = $slices["sidebar"];
		$data["report"]["figures"] = $chapterData["figures"];
		$data["report"]["table"] = $chapterData["table"];

		return $data;
	}

	function generateDataTables($api_url) {
		// Read from file
		$path = get_stylesheet_directory();
		$file = "$path/renderization/data/report/report-tables.json";

		if (file_exists($file)) {
			$tables = json_decode(file_get_contents($file), true);
			return $tables;
		}

		$tableData = $this->formatAreaApiData($api_url);
		$tables = array();

		// Whole ranking
		$this->createTable($tables, $tableData, false, false, true, "whole-ranking", "2014 Affordability Index Rankings", true, function ($country) {
			return true;
		});

		// Emerging countries
		$this->createTable($tables, $tableData, false, false, true, "emerging-countries", "2014 Affordability Index Rankings: Emerging Countries", true, function ($country) {
			return strtolower($country["area_type"]) == "emerging";
		});

		// Developing countries
		$this->createTable($tables, $tableData, false, false, true, "developing-countries", "2014 Affordability Index Rankings: Developing Countries", true, function ($country) {
			return strtolower($country["area_type"]) == "developing";
		});

		// 2014 Affordability Index Top Five
		$this->createTable($tables, $tableData, false, false, true, "top-five", "2014 Affordability Index Top Five", true, function ($country) {
			return $country["ranking"] <= 5;
		});

		// 2014 Affordability Index: Top Emerging
		$this->createTable($tables, $tableData, true, false, true, "top-emerging", "2014 Affordability Index: Top Emerging Countries", false, function ($country) {
			return $country["ranking_type"] <= 5 && strtolower($country["area_type"]) == "emerging";
		});

		// 2014 Affordability Index: Top Developing
		$this->createTable($tables, $tableData, true, false, true, "top-developing", "2014 Affordability Index: Top Developing Countries", false, function ($country) {
			return $country["ranking_type"] <= 5 && strtolower($country["area_type"]) == "developing";
		});

		$this->createTopTable($tables, $tableData);

		// Countries that have achieved the UN 5% entry-level target
		usort($tableData, array('ReportModel', 'usortBroadbandCmp'));

		$this->createTable($tables, $tableData, true, true, false, "un-entry-level", "Countries that have achieved the UN 5% entry-level target", false, function ($country) {
			return true;
		});

		// Table 9
		$path = get_stylesheet_directory();
		$tables["broadband-poverty-table"] = file_get_contents("$path/renderization/models/tables/table9.txt", true);

		// Table 10
		$tables["broadband-gender-table"] = file_get_contents("$path/renderization/models/tables/table10.txt", true);

		// Table 11
		$tables["primary-research-scores"] = file_get_contents("$path/renderization/models/tables/table11.txt", true);

		// Affordability graphic
		$tables["affordability-graphic"] = file_get_contents("$path/renderization/models/tables/affordability.txt", true);

		// Indicator table
		$indicatorInfo = $this->formatIndicatorApiData($api_url);
		$this->createIndicatorTable($tables, $indicatorInfo);

		// Store in file
		file_put_contents($file, json_encode($tables));

		return $tables;
	}

	function createIndicatorTable(&$tables, $data) {
		$html = "<table id='indicator-table' class='data-table data-table-indicator'><caption>{{table}} 2014 Affordability Index Structure</caption>";
		$html .= "<thead><tr><th>Code</th><th>Name</th></tr></thead><tbody>";

		$html .= "<tr class='access'><td colspan='2'>Access</td></tr>";

		foreach ($data["access"] as $row) {
			$code = $row["code"];
			$name = $row["name"];

			$html .= "<tr class='access'><td>$code</td><td>$name</td></tr>";
		}

		$html .= "<tr class='infrastructure'><td colspan='2'>Infrastructure</td></tr>";

		foreach ($data["infrastructure"] as $row) {
			$code = $row["code"];
			$name = $row["name"];

			$html .= "<tr class='infrastructure'><td>$code</td><td>$name</td></tr>";
		}

		$html .= "</tbody></table>";

		$tables["indicator-table"] = $html;
	}

	function createTopTable(&$tables, $data) {
		$html = "<table id='top-five-table' class='data-table data-table-top'><caption>{{table}} 2014 Affordability Index Top 5 Emerging and Developing Economies</caption>";
		$html .= "<thead><tr><th>Emerging Economies</th><th>Developing Economies</th></tr></thead><tbody>";

		$emerging = array();
		$developing = array();

		$path = get_stylesheet_directory_uri();

		foreach ($data as $row) {
			$ranking = $row["ranking"];
			$country = $row["country"];
			$iso3 = $row["iso3"];
			$type = strtolower($row["area_type"]);

			$value = "<td class='country $type'><img src='$path/images/flags-big/$iso3.png' class='flag' alt='flag of $country' /> <span>$country</span></td>";

			if ($type == "emerging")
				array_push($emerging, $value);
			else
				array_push($developing, $value);

			if (count($emerging) >=5 && count($developing) >=5 )
				break;
		}

		for ($i = 0; $i < 5; $i++) {
			$value_emerging = $emerging[$i];
			$value_developing = $developing[$i];

			$html .= "<tr>$value_emerging$value_developing</tr>";
		}

		$html .= "</tbody></table>";

		$tables["top-five-table"] = $html;
	}

	function createTable(&$tables, $data, $show_prepaid, $show_postpaid, $show_subindices, $identifier, $caption, $reset_count, $checker) {
		$html = "<table id='$identifier' class='data-table $identifier'>";
		$html .= "<caption>{{table}} $caption</caption>";
		$html .= "<thead><tr>";
		$html .= "<th>Ranking</th>";
		$html .= "<th>Country</th>";

		if ($show_subindices) {
			$html .= "<th>Sub-index: Communication Infrastructure</th>";
			$html .= "<th>Sub-index: Access</th>";
		}

		$html .= "<th>Affordability Index: Overall Composite Score</th>";

		if ($show_prepaid)
			$html .= "<th>Mobile broadband (pre-paid handset-based 500 MB) as % GNI (2013)</th>";

		if ($show_postpaid)
			$html .= "<th>Mobile broadband (post-paid, computer based, 1GB) as % GNI (2013)</th>";

		$html .= "</tr></thead><tbody>";

		$path = get_stylesheet_directory_uri();

		$count = 1;

		foreach ($data as $row) {
			if (!$checker($row))
				continue;

			$ranking = $row["ranking"];
			$country = $row["country"];
			$iso3 = $row["iso3"];
			$type = strtolower($row["area_type"]);

			if ($reset_count)
				$ranking = $count;

			$infrastructure = number_format(floatval($row["INFRASTRUCTURE"]), 2, '.', ',');
			$access = number_format(floatval($row["ACCESS"]), 2, '.', ',');
			$index = number_format(floatval($row["INDEX"]), 2, '.', ',');

			$mobile_broadband = $row["mobile_broadband"];
			$fixed_broadband = $row["fixed_broadband"];

			if ($mobile_broadband != "")
				$mobile_broadband = number_format(floatval($mobile_broadband), 2, '.', ',');

			if ($fixed_broadband != "")
				$fixed_broadband = number_format(floatval($fixed_broadband), 2, '.', ',');

			$html .= "<tr class='$type'>";
			$html .= "<td class='ranking'><span>$ranking</span></td>";
			$html .= "<td class='country'><img src='$path/images/flags-big/$iso3.png' class='flag' alt='flag of $country' /> $country</td>";

			if ($show_subindices) {
				$html .= "<td class='infrastructure' data-title='Sub-index: Communications Infrastructure'>$infrastructure</td>";
				$html .= "<td class='access' data-title='Sub-index: Access'>$access</td>";
			}

			$html .= "<td class='index' data-title='Affordability Index'><span>$index</span></td>";

			if ($show_prepaid)
				$html .= "<td class='mobile_broadband' data-title='500MB Mobile Broadband (% GNI)'>$mobile_broadband</td>";

			if ($show_postpaid)
				$html .= "<td class='fixed_broadband' data-title='1GB Mobile Broadband (% GNI)'>$fixed_broadband</td>";

			$html .= "</tr>";

			$count++;
		}

		$html .= "</tbody></table>";

		$tables[$identifier] = $html;
	}

	function formatAreaApiData($api_url) {
		$areas = json_decode(file_get_contents($api_url . '/areas/countries'), true);
		$areas = $areas["data"];

		$observations = json_decode(file_get_contents($api_url . '/visualisationsGroupedByArea/INDEX,ACCESS,INFRASTRUCTURE/ALL/LATEST'), true);
		$observations = $observations["data"];

		$data = array();

		foreach ($areas as $area) {
			$short_name = $area["short_name"];
			$iso3 = $area["iso3"];
			$area_type = $area["type"];

			$info = $area["info"];

			$mobile_broadband = "";
			$fixed_broadband = "";

			if (array_key_exists("mobile_broadband_percentage_GNI", $info))
				$mobile_broadband = $info["mobile_broadband_percentage_GNI"]["value"];

			if (array_key_exists("mobile_broadband_1GB_percentage_GNI", $info))
				$fixed_broadband = $info["mobile_broadband_1GB_percentage_GNI"]["value"];

			$area_observations = $observations[$iso3]["observations"];

			$values = $this->getValues($area_observations);
			$values["iso3"] = $iso3;
			$values["country"] = $short_name;
			$values["mobile_broadband"] = $mobile_broadband;
			$values["fixed_broadband"] = $fixed_broadband;
			$values["area_type"] = $area_type;

			array_push($data, $values);
		}

		usort($data, array('ReportModel', 'usortCmp'));

		return $data;
	}

	function formatIndicatorApiData($api_url) {
		$access_indicators = json_decode(file_get_contents($api_url.'/indicators/ACCESS/indicators'), true);
		$access_indicators = $access_indicators["data"];

		$infrastructure_indicators = json_decode(file_get_contents($api_url.'/indicators/INFRASTRUCTURE/indicators'), true);
		$infrastructure_indicators = $infrastructure_indicators["data"];

		$data_access = array();
		$data_infrastructure = array();

		foreach ($access_indicators as $indicator) {
			$code = $indicator["indicator"];
			$name = $indicator["name"];

			array_push($data_access, array("code" => $code, "name" => $name));
		}

		foreach ($infrastructure_indicators as $indicator) {
			$code = $indicator["indicator"];
			$name = $indicator["name"];

			array_push($data_infrastructure, array("code" => $code, "name" => $name));
		}

		return array("access" => $data_access, "infrastructure" => $data_infrastructure);
	}

	function getValues($observations) {
		$index = NULL;
		$access = NULL;
		$infrastructure = NULL;
		$rank = NULL;
		$rank_type = NULL;

		foreach ($observations as $observation) {
			$indicator = strtoupper($observation["indicator"]);
			$value = $observation["value"];
			$ranking = $observation["ranking"];
			$ranking_type = $observation["ranking_type"];

			if ($indicator == "INDEX") {
				$index = $value;
				$rank = $ranking;
				$rank_type = $ranking_type;
			}
			else if ($indicator == "ACCESS")
				$access = $value;
			else if ($indicator == "INFRASTRUCTURE")
				$infrastructure = $value;
		}

		return array("ranking" => $rank, "ranking_type" => $rank_type, "INDEX" => $index, "ACCESS" => $access, "INFRASTRUCTURE" => $infrastructure);
	}

	private static function usortCmp($a, $b) {
		return $a["ranking"] > $b["ranking"];
	}

	private static function usortBroadbandCmp($a, $b) {
		if (empty($a["mobile_broadband"]))
			return 1;

		if (empty($b["mobile_broadband"]))
			return -1;

		return $a["mobile_broadband"] > $b["mobile_broadband"];
	}
}
?>
