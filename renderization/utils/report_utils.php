<?php

function get_report_items($report_id) {
	$items = get_posts(array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'category'         => '',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => 'meta-box-report-id',
		'meta_value'       => $report_id,
		'post_type'        => 'report_item',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'any',
		'suppress_filters' => true
	));

	$processed = array();

	$custom_fields = array(
		"meta-box-order",
		"meta-box-report-id",
		"meta-box-block-type",
		"meta-box-highlighted-icon",
		"meta-box-table-type",
		"meta-box-chart-type",
		"meta-box-number",
		"meta-box-anchor"
	);

	foreach ($items as $item) {
		$item = $item->to_array();

		foreach ($custom_fields as $custom_field) {
			$item[$custom_field] = get_post_meta($item["ID"], $custom_field, true);
		}

		$item['post_content'] = apply_filters('the_content', $item['post_content']);
		$item['table'] = ucwords(str_replace(":", ": ", str_replace("-", " ", $item['meta-box-table-type'])));

		array_push($processed, $item);
	}

	usort($processed, function($a, $b) {
		$a_order = $a["meta-box-order"];
		$b_order = $b["meta-box-order"];

		if ($a_order == $b_order) {
			return 0;
		}

		return ($a_order < $b_order) ? -1 : 1;
	});

	// Data tables
	$path = get_template_directory() . "/renderization/dashboard/data/tables.json";

	if (!file_exists($path)) {
		$settingsPath = get_template_directory() . "/renderization/settings.json";

	  if (file_exists($settingsPath)) {
	  	$settings = json_decode(file_get_contents($settingsPath), true);
		}

		$tables = generateDataTables($settings['apiUrl']);
	}
	else {
		$tables = json_decode(utf8_encode(file_get_contents($path)), TRUE);
	}

	// Assign chapter numbers
	$levels = array(
		1 => 0,
		2 => 0,
		3 => 0,
		4 => 0,
		5 => 0
	);

	$index = "0";
	$index_level = NULL;
	$first_level = 0;
	$first_level_numeric = 0;
	$previous_class = "";

	for($i = 0; $i < count($processed); $i++) {
		$item = $processed[$i];
		$type = $item['meta-box-block-type'];
		$number = $item['meta-box-number'];
		$anchored = $item['meta-box-anchor'] === "true";
		$the_class = $type == 'highlighted' ? "box" : "";

		$show_icon = $item['meta-box-highlighted-icon'] == 'on';

		// Get the header
		switch ($type) {
			case 'heading_1':
				if (empty($number)) {
					$levels[1] = $levels[1] + 1;
					$index = (string)$levels[1];
					$first_level = $levels[1];
				}
				else {
					$index = $number;
					$first_level = $number;
				}

				$first_level_numeric++;

				$levels[2] = 0;
				$levels[3] = 0;
				$levels[4] = 0;
				$levels[5] = 0;

				$index_level = 1;
				break;
			case 'heading_2':
				$levels[2] = $levels[2] + 1;
				$levels[3] = 0;
				$levels[4] = 0;
				$levels[5] = 0;
				$index = is_numeric($first_level) ? $first_level . "." . $levels[2] : "";
				$index_level = 2;
				break;
			case 'heading_3':
				$levels[3] = $levels[3] + 1;
				$levels[4] = 0;
				$levels[5] = 0;
				$index = is_numeric($first_level) ? $first_level . "." . $levels[2] . "." . $levels[3] : "";
				$index_level = 3;
				break;
			case 'heading_4':
				$levels[4] = $levels[4] + 1;
				$levels[5] = 0;
				$index = is_numeric($first_level) ? $first_level . "." . $levels[2] . "." . $levels[3] . "." . $levels[4] : "";
				$index_level = 4;
				break;
			case 'heading_5':
				$levels[5] = $levels[5] + 1;
				$index = is_numeric($first_level) ? $first_level . "." . $levels[2] . "." . $levels[3] . "." . $levels[4] . "." . $levels[5] : "";
				$index_level = 5;
				break;
			default:
				$index = "";
				$index_level = NULL;
				break;
		}

		$processed[$i]['chapter'] = $first_level;
		$processed[$i]['index'] = $index;
		$processed[$i]['index_level'] = $index_level;
		$processed[$i]['first_level_numeric'] = $first_level_numeric;

		$processed[$i]['is_highlighted'] = $type == 'highlighted';
		$processed[$i]['show_icon'] = $type == 'highlighted' && $show_icon;
		$processed[$i]['is_table'] = $type == 'table';
		$processed[$i]['anchored'] = $anchored;

		$title = str_replace(" ", "_", strtolower($processed[$i]['post_title']));
		$title = str_replace(",", "", $title);
		$title = str_replace(".", "", $title);
		$processed[$i]['tag'] = $title;

		if ($type == 'table') {
			$table = $processed[$i]['meta-box-table-type'];

			if (!empty($table)) {
				$table = explode(":", $table);
				$year = $table[0];
				$table = $table[1];

				$table_contents = $tables[$year]["tables"][$table];
				$processed[$i]['table_contents'] = $table_contents;
			}
		}

		if ($type == 'chart') {
			$chart = $processed[$i]['meta-box-chart-type'];

			if (!empty($chart)) {
				$chart = explode(":", $chart);
				$year = $chart[0];
				$chart = $chart[1];

				$processed[$i]['chart'] = $chart;
			}
		}

		$processed[$i]['is_chart'] = $type == 'chart';

		if ($anchored) {
			$the_class = "anchored $previous_class";
		}

		$previous_class = $the_class;

		$processed[$i]['class'] = $the_class;
	}

	return $processed;
}

////////////////////////////////////////////////////////////////////////////////
//															  DATA TABLES
////////////////////////////////////////////////////////////////////////////////

function generateDataTables($api_url) {
	// Read from file
	$path = get_stylesheet_directory();
	$file = "$path/renderization/dashboard/data/tables.json";

	if (file_exists($file)) {
		$tables = json_decode(file_get_contents($file), true);
		return $tables;
	}

	$tableData = formatAreaApiData($api_url, "2014");
	$tables = array();

	// Whole ranking
	createTable($tables, $tableData, false, false, true, "whole-ranking", "2014 Affordability Index Rankings", true, function ($country) {
		return true;
	}, TRUE);

	// Emerging countries
	createTable($tables, $tableData, false, false, true, "emerging-countries", "2014 Affordability Index Rankings: Emerging Countries", true, function ($country) {
		return strtolower($country["area_type"]) == "emerging";
	}, TRUE);

	// Developing countries
	createTable($tables, $tableData, false, false, true, "developing-countries", "2014 Affordability Index Rankings: Developing Countries", true, function ($country) {
		return strtolower($country["area_type"]) == "developing";
	}, TRUE);

	// 2014 Affordability Index Top Five
	createTable($tables, $tableData, false, false, true, "top-five", "2014 Affordability Index Top Five", true, function ($country) {
		return $country["ranking"] <= 5;
	}, TRUE);

	// 2014 Affordability Index: Top Emerging
	createTable($tables, $tableData, true, false, true, "top-emerging", "2014 Affordability Index: Top Emerging Countries", false, function ($country) {
		return $country["ranking_type"] <= 5 && strtolower($country["area_type"]) == "emerging";
	}, TRUE);

	// 2014 Affordability Index: Top Developing
	createTable($tables, $tableData, true, false, true, "top-developing", "2014 Affordability Index: Top Developing Countries", false, function ($country) {
		return $country["ranking_type"] <= 5 && strtolower($country["area_type"]) == "developing";
	}, TRUE);

	createTopTable($tables, $tableData, FALSE);

	// Countries that have achieved the UN 5% entry-level target
	usort($tableData, function ($a, $b) {
		if (empty($a["mobile_broadband"]))
			return 1;

		if (empty($b["mobile_broadband"]))
			return -1;

		return $a["mobile_broadband"] > $b["mobile_broadband"];
	});

	createTable($tables, $tableData, true, true, false, "un-entry-level", "Countries that have achieved the UN 5% entry-level target", false, function ($country) {
		return true;
	}, TRUE);

	// Table 9
	$path = get_stylesheet_directory();
	$tables["broadband-poverty-table"] = file_get_contents("$path/renderization/models/tables/table9.txt", true);

	// Table 10
	$tables["broadband-gender-table"] = file_get_contents("$path/renderization/models/tables/table10.txt", true);

	// Table 11
	$tables["primary-research-scores_a"] = file_get_contents("$path/renderization/models/tables/table11a.txt", true);
	$tables["primary-research-scores_b"] = file_get_contents("$path/renderization/models/tables/table11b.txt", true);

	// Affordability graphic
	$tables["affordability-graphic"] = file_get_contents("$path/renderization/models/tables/affordability.txt", true);

	// Indicator table
	$indicatorInfo = formatIndicatorApiData($api_url);
	createIndicatorTable($tables, $indicatorInfo);

	//////////////////////////////////////////////////////////////////////////////
	// 															2015 Tables
	//////////////////////////////////////////////////////////////////////////////

	$tableData = formatAreaApiData($api_url, "2015");
	$tables_2015 = array();

	$tables_2015["top-5-2015"] = replace_table("$path/renderization/models/tables/2015_top_5.txt");
	$tables_2015["scores-rankings"] = replace_table("$path/renderization/models/tables/2015_scores_rankings.txt");
	$tables_2015["highest-adi-developed"] = replace_table("$path/renderization/models/tables/2015_highest_developed.txt");
	$tables_2015["mobile-broadband"] = replace_table("$path/renderization/models/tables/2015_mobile_broadband.txt");
	$tables_2015["broadband-most-affordable"] = replace_table("$path/renderization/models/tables/2015_broadband_most_affordable.txt");
	$tables_2015["500mb-affordable"] = replace_table("$path/renderization/models/tables/2015_500mb_affordable.txt");
	$tables_2015["prices-affordability-growth"] = replace_table("$path/renderization/models/tables/2015_prices_affordability_growth.txt");
	createIndicatorTable($tables_2015, $indicatorInfo);

	// Emerging countries
	createTable($tables_2015, $tableData, false, false, true, "emerging-countries", "Affordability Drivers Index - Emerging Countries", true, function ($country) {
		return strtolower($country["area_type"]) == "emerging";
	}, TRUE, array(
		"Rank",
		"Country",
		"Sub-Index: Communications Infrastructure",
		"Sub-Index: Access and Affordability",
		"Affordability Drivers Index: Overall Composite Score"
	));

	// Developing countries
	createTable($tables_2015, $tableData, false, false, true, "developing-countries", "Affordability Drivers Index - Developing Countries", true, function ($country) {
		return strtolower($country["area_type"]) == "developing";
	}, TRUE, array(
		"Rank",
		"Country",
		"Sub-Index: Communications Infrastructure",
		"Sub-Index: Access and Affordability",
		"Affordability Drivers Index: Overall Composite Score"
	));

	$tables_2015["annex-comparison-2015"] = replace_table("$path/renderization/models/tables/2015_annex_comparison.txt");

	$tables = array(
		"2014" => array(
			"tables" => $tables
		),
		"2015" => array(
			"tables" => $tables_2015
		)
	);

	// Store in file
	file_put_contents($file, json_encode($tables));

	return $tables;
}

function replace_table($file) {
	$contents = file_get_contents($file, true);
	return str_replace("{{host}}", get_stylesheet_directory_uri(), $contents);
}

function createIndicatorTable(&$tables, $data) {
	$html = "<table id='indicator-table' class='data-table data-table-indicator'><caption>{{caption}}</caption>";
	$html .= "<thead><tr><th>Code</th><th>Type</th><th>Name</th></tr></thead><tbody>";

	$html .= "<tr class='access'><td colspan='3'>Access</td></tr>";

	foreach ($data["access"] as $row) {
		$code = $row["code"];
		$name = $row["name"];
		$type = $row["type"];

		$html .= "<tr class='access'><td>$code</td><td>$type</td><td class='name'>$name</td></tr>";
	}

	$html .= "<tr class='infrastructure'><td colspan='3'>Infrastructure</td></tr>";

	foreach ($data["infrastructure"] as $row) {
		$code = $row["code"];
		$name = $row["name"];

		$html .= "<tr class='infrastructure'><td>$code</td><td>$type</td><td>$name</td></tr>";
	}

	$html .= "</tbody></table>";

	$tables["indicator-table"] = $html;
}

function createTopTable(&$tables, $data, $sortable = FALSE) {
	$data_sortable = $sortable ? "data-sortable" : "";

	$html = "<table id='top-five-table' class='data-table data-table-top' $data_sortable><caption>{{caption}}</caption>";
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

function createTable(&$tables, $data, $show_prepaid, $show_postpaid, $show_subindices, $identifier, $caption, $reset_count, $checker, $sortable = FALSE, $labels = NULL) {
	$data_sortable = $sortable ? "data-sortable" : "";

	$first_label = $labels && isset($labels[0]) ? $labels[0] : "Ranking";
	$second_label = $labels && isset($labels[1]) ? $labels[1] : "Country";
	$label_index = 1;

	$html = "<table id='$identifier' class='data-table $identifier' $data_sortable>";
	$html .= "<caption>{{caption}}</caption>";
	$html .= "<thead><tr>";
	$html .= "<th data-status='up'>$first_label</th>";
	$html .= "<th>$second_label</th>";

	if ($show_subindices) {
		$label = $labels && isset($labels[++$label_index]) ? $labels[$label_index] : "Sub-index: Communication Infrastructure";
		$html .= "<th>$label</th>";
		$label = $labels && isset($labels[++$label_index]) ? $labels[$label_index] : "Sub-index: Access";
		$html .= "<th>$label</th>";
	}

	$label = $labels && isset($labels[++$label_index]) ? $labels[$label_index] : "Affordability Index: Overall Composite Score";
	$html .= "<th>$label</th>";

	if ($show_prepaid) {
		$label = $labels && isset($labels[++$label_index]) ? $labels[$label_index] : "Mobile broadband (pre-paid handset-based 500 MB) as % GNI (2013)";
		$html .= "<th>$label</th>";
	}

	if ($show_postpaid) {
		$label = $labels && isset($labels[++$label_index]) ? $labels[$label_index] : "Mobile broadband (post-paid, computer based, 1GB) as % GNI (2013)";
		$html .= "<th>$label</th>";
	}

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

		if ($reset_count) {
			$ranking = $count;
		}

		$infrastructure = number_format(floatval($row["INFRASTRUCTURE"]), 2, '.', ',');
		$access = number_format(floatval($row["ACCESS"]), 2, '.', ',');
		$index = number_format(floatval($row["INDEX"]), 2, '.', ',');

		$mobile_broadband = $row["mobile_broadband"];
		$fixed_broadband = $row["fixed_broadband"];

		if ($mobile_broadband != "") {
			$mobile_broadband = number_format(floatval($mobile_broadband), 2, '.', ',');
		}

		if ($fixed_broadband != "") {
			$fixed_broadband = number_format(floatval($fixed_broadband), 2, '.', ',');
		}

		$html .= "<tr class='$type'>";
		$html .= "<td class='ranking' data-value='$ranking' data-number><span>$ranking</span></td>";
		$html .= "<td class='country' data-value='$country'><img src='$path/images/flags-big/$iso3.png' class='flag' alt='flag of $country' /> $country</td>";

		if ($show_subindices) {
			$html .= "<td class='infrastructure' data-value='$infrastructure' data-number data-title='Sub-index: Communications Infrastructure'>$infrastructure</td>";
			$html .= "<td class='access' data-value='$access' data-number data-title='Sub-index: Access'>$access</td>";
		}

		$html .= "<td class='index' data-value='$index' data-number data-title='Affordability Index'><span>$index</span></td>";

		if ($show_prepaid) {
			$html .= "<td class='mobile_broadband' data-value='$mobile_broadband' data-number data-title='500MB Mobile Broadband (% GNI)'>$mobile_broadband</td>";
		}

		if ($show_postpaid) {
			$html .= "<td class='fixed_broadband' data-value='$fixed_broadband' data-number data-title='1GB Mobile Broadband (% GNI)'>$fixed_broadband</td>";
		}

		$html .= "</tr>";

		$count++;
	}

	$html .= "</tbody></table>";

	$tables[$identifier] = $html;
}

function formatAreaApiData($api_url, $year) {
	$areas = json_decode(file_get_contents($api_url . '/areas/countries'), true);
	$areas = $areas["data"];

	$observations = json_decode(file_get_contents($api_url . "/visualisationsGroupedByArea/INDEX,ACCESS,INFRASTRUCTURE/ALL/$year"), true);
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

		$values = getValues($area_observations);
		$values["iso3"] = $iso3;
		$values["country"] = $short_name;
		$values["mobile_broadband"] = $mobile_broadband;
		$values["fixed_broadband"] = $fixed_broadband;
		$values["area_type"] = $area_type;

		array_push($data, $values);
	}

	usort($data, function ($a, $b) {
		return $a["ranking"] > $b["ranking"];
	});

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
		$type = $indicator["type"];

		array_push($data_access, array(
			"code" => $code,
			"name" => $name,
			"type" => $type
		));
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

?>
