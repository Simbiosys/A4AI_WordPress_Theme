<?php
require_once('utils.php');
require_once(get_template_directory() . "/renderization/utils/report_utils.php");

class ReportModel {

	function ReportModel() {
	}

	function get($api_url, $visualisationsPath) {
		global $wpdb;

		$report_id = get_the_ID();
		
		$report = get_post($report_id);
	
		if ($report->post_type != 'report') {
			wp_redirect(home_url('/affordability-report'));
			return;
		}

		$chapters = $this->get_chapters($report_id);

		$tables = generateDataTables($api_url);

		$all_reports = get_posts(array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'category'         => '',
			'include'          => '',
			'exclude'          => '',
			'post_type'        => 'report',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true
		));

		$years = array();

		foreach ($all_reports as $one_report) {
			array_push($years, $one_report->post_name);
		}

		return array(
			"report" => $report->to_array(),
			"selected_report" => $report->post_name,
			"years" => $years,
			"chapters" => $chapters["chapters"],
			"table_contents" => $chapters["table_contents"],
			"tables" => $tables,
			"list_tables" => $chapters["list_tables"],
			"list_figures" => $chapters["list_figures"],
			"headings" => $chapters["headings"]
		);
	}

	function get_chapters($report_id) {
		$items = get_report_items($report_id);
		$chapters = array();
		$table_contents = array();
		$chapter = array();
		$list_tables = array();
		$list_figures = array();

		$previous_chapter = count($items) > 0 ? $items[0]["chapter"] : NULL;
		$headings = array();
		$previous_index = NULL;

		for ($i = 0; $i < count($items); $i++) {
			$item = $items[$i];
			$chapter_number = $item["chapter"];
			$index = $item["index"];
			$index_level = $item["index_level"];
			$index = $item["index"];
			$type = $item['meta-box-block-type'];

			if ($chapter_number != $previous_chapter) {
				$title = $chapter[0]["post_title"];
				$tag = $chapter[0]["tag"];
				$tag = $this->get_chapter_name($tag, $previous_chapter);

				array_push($chapters, array(
					"number" => $previous_chapter,
					"title" => $title,
					"tag" => $tag,
					"contents" => $chapter,
					"subchapters" => $table_contents[count($table_contents) - 1]["contents"]
				));

				$chapter = array();
			}

			if ($index_level == 1) {
				array_push($table_contents, array(
					"number" => $chapter_number,
					"title" => $item["post_title"],
					"tag" => $this->get_chapter_name($item["tag"], $chapter_number),
					"contents" => array()
				));
			}
			else if ($index_level > 1) {
				array_push($table_contents[count($table_contents) - 1]["contents"], array(
					"number" => $index,
					"title" => $item["post_title"],
					"tag" => $this->get_chapter_name($item["tag"], $chapter_number),
					"level" => $index_level
				));
			}

			$previous_chapter = $chapter_number;

			if ($type === 'table') {
				$table_index = count($list_tables) + 1;

				array_push($list_tables, array(
					"title" => $item["post_title"],
					"index" => $table_index,
					"tag" => $item["tag"],
					"chapter" => $chapter_number
				));

				$item["table_index"] = $table_index;
			}
			else if ($type === 'chart') {
				$chart_index = count($list_figures) + 1;

				array_push($list_figures, array(
					"title" => $item["post_title"],
					"index" => $chart_index,
					"tag" => $item["tag"],
					"chapter" => $chapter_number
				));

				$item["chart_index"] = $chart_index;
			}

			if ($index != $previous_index) {
				array_push($headings, $item);
			}

			$previous_index = $index;

			array_push($chapter, $item);
		}

		if (!empty($chapter)) {
			$title = $chapter[0]["post_title"];
			$tag = $chapter[0]["tag"];
			$tag = $this->get_chapter_name($tag, $previous_chapter);

			array_push($chapters, array(
				"number" => $previous_chapter,
				"title" => $title,
				"tag" => $tag,
				"contents" => $chapter,
				"subchapters" => $table_contents[count($table_contents) - 1]["contents"]
			));
		}

		return array(
			"chapters" => $chapters,
			"table_contents" => $table_contents,
			"list_tables" => $list_tables,
			"list_figures" => $list_figures,
			"headings" => $headings
		);
	}

	function get_chapter_name($tag, $number) {
		return empty($tag) ? "chapter_$number" : $tag;
	}
}
?>
