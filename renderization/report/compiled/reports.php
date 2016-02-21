<?php return function ($in, $debugopt = 1) {
    $cx = Array(
        'flags' => Array(
            'jstrue' => false,
            'jsobj' => false,
            'spvar' => true,
            'prop' => false,
            'method' => false,
            'mustlok' => false,
            'mustsec' => false,
            'debug' => $debugopt,
        ),
        'helpers' => Array(            'selected_item' => function($args) {
								return $args[0] == $args[1] ? "selected" : "";
							},
            'get_item_index' => function($args) {
								return intval($args[0]) + 1;
							},
            'format_table' => function($args) {
                return str_replace("{{caption}}", "", $args[0]);
              },
),
        'blockhelpers' => Array(),
        'hbhelpers' => Array(),
        'partials' => Array(),
        'scopes' => Array($in),
        'sp_vars' => Array(),
'funcs' => Array(
    'sec' => function ($cx, $v, $in, $each, $cb, $inv = null) {
        $isary = is_array($v);
        $loop = $each;
        $keys = null;
        $last = null;
        $is_obj = false;

        if ($isary && $inv !== null && count($v) === 0) {
            return $inv($cx, $in);
        }
        if (!$loop && $isary) {
            $keys = array_keys($v);
            $loop = (count(array_diff_key($v, array_keys($keys))) == 0);
            $is_obj = !$loop;
        }
        if ($loop && $isary) {
            if ($each) {
                if ($keys == null) {
                    $keys = array_keys($v);
                    $is_obj = (count(array_diff_key($v, array_keys($keys))) > 0);
                }
            }
            $ret = Array();
            $cx['scopes'][] = $in;
            $i = 0;
            if ($cx['flags']['spvar']) {
                $last = count($keys) - 1;
            }
            foreach ($v as $index => $raw) {
                if ($cx['flags']['spvar']) {
                    $cx['sp_vars']['first'] = ($i === 0);
                    if ($is_obj) {
                        $cx['sp_vars']['key'] = $index;
                        $cx['sp_vars']['index'] = $i;
                    } else {
                        $cx['sp_vars']['last'] = ($i == $last);
                        $cx['sp_vars']['index'] = $index;
                    }
                $i++;
                }
                $ret[] = $cb($cx, $raw);
            }
            if ($cx['flags']['spvar']) {
                if ($is_obj) {
                    unset($cx['sp_vars']['key']);
                } else {
                    unset($cx['sp_vars']['last']);
                }
                unset($cx['sp_vars']['index']);
                unset($cx['sp_vars']['first']);
            }
            array_pop($cx['scopes']);
            return join('', $ret);
        }
        if ($each) {
            if ($inv !== null) {
                $cx['scopes'][] = $in;
                $ret = $inv($cx, $v);
                array_pop($cx['scopes']);
                return $ret;
            }
            return '';
        }
        if ($isary) {
            if ($cx['flags']['mustsec']) {
                $cx['scopes'][] = $v;
            }
            $ret = $cb($cx, $v);
            if ($cx['flags']['mustsec']) {
                array_pop($cx['scopes']);
            }
            return $ret;
        }

        if ($v === true) {
            return $cb($cx, $in);
        } 

        if (!is_null($v) && ($v !== false)) {
            return $cb($cx, $v);
        }

        if ($inv !== null) {
            return $inv($cx, $in);
        }

        return '';
    },
    'ch' => function ($cx, $ch, $vars, $op) {
        return $cx['funcs']['chret'](call_user_func_array($cx['helpers'][$ch], $vars), $op);
    },
    'ifvar' => function ($cx, $v) {
        return !is_null($v) && ($v !== false) && ($v !== 0) && ($v !== '') && (is_array($v) ? (count($v) > 0) : true);
    },
    'chret' => function ($ret, $op) {
        if (is_array($ret)) {
            if (isset($ret[1]) && $ret[1]) {
                $op = $ret[1];
            }
            $ret = $ret[0];
        }

        switch ($op) {
            case 'enc': 
                return htmlentities($ret, ENT_QUOTES, 'UTF-8');
            case 'encq':
                return preg_replace('/&#039;/', '&#x27;', htmlentities($ret, ENT_QUOTES, 'UTF-8'));
        }
        return $ret;
    },
)

    );
    return '<link rel="stylesheet" href="'.htmlentities((string)((isset($in['root']) && is_array($in)) ? $in['root'] : null), ENT_QUOTES, 'UTF-8').'/renderization/report/css/dragula.min.css" />
<link rel="stylesheet" href="'.htmlentities((string)((isset($in['root']) && is_array($in)) ? $in['root'] : null), ENT_QUOTES, 'UTF-8').'/renderization/report/css/reports.css" />

<div class="wrap report-wrap">
  <h1>'.htmlentities((string)((isset($in['title']) && is_array($in)) ? $in['title'] : null), ENT_QUOTES, 'UTF-8').'</h1>
  <nav class="overflow-hidden">
    <label for="report">Select a report</label>
    <select id="report" class="report-select">
      '.$cx['funcs']['sec']($cx, ((isset($in['reports']) && is_array($in)) ? $in['reports'] : null), $in, false, function($cx, $in) {return '
        <option value="'.htmlentities((string)((isset($in['ID']) && is_array($in)) ? $in['ID'] : null), ENT_QUOTES, 'UTF-8').'" '.$cx['funcs']['ch']($cx, 'selected_item', Array(Array(((isset($in['ID']) && is_array($in)) ? $in['ID'] : null),((isset($cx['scopes'][0]['selected']['ID']) && is_array($cx['scopes'][0]['selected'])) ? $cx['scopes'][0]['selected']['ID'] : null)),Array()), 'enc').'>'.htmlentities((string)((isset($in['post_name']) && is_array($in)) ? $in['post_name'] : null), ENT_QUOTES, 'UTF-8').'</option>
      ';}).'
    </select>
    <a href="'.htmlentities((string)((isset($in['host']) && is_array($in)) ? $in['host'] : null), ENT_QUOTES, 'UTF-8').'/wp-admin/post-new.php?post_type=report" class="add-new-h2 add-new-report float-right">
      Add New Report
    </a>
  </nav>
  <nav class="report-nav">
    <h2 class="report-title width-70 float-left">Report: '.htmlentities((string)((isset($in['selected']['post_title']) && is_array($in['selected'])) ? $in['selected']['post_title'] : null), ENT_QUOTES, 'UTF-8').'</h2>
    <div class="report-actions width-30 float-right">
      <a href="javascript:void(0)" class="add-new-h2 edit-reports" title="Expand all blocks" id="expand_all">
        <i class="fa fa-eye fa-lg"></i>
      </a>
      <a href="'.htmlentities((string)((isset($in['host']) && is_array($in)) ? $in['host'] : null), ENT_QUOTES, 'UTF-8').'/affordability-report/report/'.htmlentities((string)((isset($in['selected']['post_name']) && is_array($in['selected'])) ? $in['selected']['post_name'] : null), ENT_QUOTES, 'UTF-8').'" class="add-new-h2 edit-reports" title="Preview" id="preview" target="_blank">
        <i class="fa fa-search fa-lg"></i>
      </a>
      <a href="'.htmlentities((string)((isset($in['host']) && is_array($in)) ? $in['host'] : null), ENT_QUOTES, 'UTF-8').'/wp-admin/post.php?post='.htmlentities((string)((isset($in['selected']['ID']) && is_array($in['selected'])) ? $in['selected']['ID'] : null), ENT_QUOTES, 'UTF-8').'&action=edit" class="add-new-h2 edit-reports">
        Edit Report Details
      </a>
    </div>
  </nav>
  <ul class="report-items" id="report_items">
    '.$cx['funcs']['sec']($cx, ((isset($in['items']) && is_array($in)) ? $in['items'] : null), $in, false, function($cx, $in) {return '
      <li class="report-item text block-type-'.htmlentities((string)((isset($in['meta-box-block-type']) && is_array($in)) ? $in['meta-box-block-type'] : null), ENT_QUOTES, 'UTF-8').' chapter-'.htmlentities((string)((isset($in['first_level_numeric']) && is_array($in)) ? $in['first_level_numeric'] : null), ENT_QUOTES, 'UTF-8').'" data-report-item="'.htmlentities((string)((isset($in['ID']) && is_array($in)) ? $in['ID'] : null), ENT_QUOTES, 'UTF-8').'" data-order="'.htmlentities((string)((isset($in['meta-box-order']) && is_array($in)) ? $in['meta-box-order'] : null), ENT_QUOTES, 'UTF-8').'">
        <nav class="report-item-add">
          <a href="'.htmlentities((string)((isset($cx['scopes'][0]['host']) && is_array($cx['scopes'][0])) ? $cx['scopes'][0]['host'] : null), ENT_QUOTES, 'UTF-8').'/wp-admin/post-new.php?post_type=report_item&report='.htmlentities((string)((isset($cx['scopes'][0]['selected']['ID']) && is_array($cx['scopes'][0]['selected'])) ? $cx['scopes'][0]['selected']['ID'] : null), ENT_QUOTES, 'UTF-8').'&order='.$cx['funcs']['ch']($cx, 'get_item_index', Array(Array((isset($cx['sp_vars']['index'])?$cx['sp_vars']['index']:'')),Array()), 'enc').'" title="Create a new block at this point">
            <i class="fa fa-plus fa-2x"></i>
          </a>
        </nav>
        <nav class="nav-heading_1">
          <span>
            1<sup>st</sup> Level Heading
          </span>
        </nav>
        <nav class="nav-heading_2">
          <span>
            2<sup>nd</sup> Level Heading
          </span>
        </nav>
        <nav class="nav-heading_3">
        </nav>
        <nav class="nav-heading_4">
        </nav>
        <nav class="nav-heading_5">
        </nav>
        <section class="report-item-body">
          <header class="report-item-header">
            <nav class="report-item-actions">
              <a href="javascript:void(0)" class="report-item-view" title="Click to maintain expanded" data-open="'.htmlentities((string)((isset($in['ID']) && is_array($in)) ? $in['ID'] : null), ENT_QUOTES, 'UTF-8').'">
                <i class="fa fa-eye fa-2x"></i>
              </a>
              <a href="'.htmlentities((string)((isset($cx['scopes'][0]['host']) && is_array($cx['scopes'][0])) ? $cx['scopes'][0]['host'] : null), ENT_QUOTES, 'UTF-8').'/wp-admin/post.php?post_type=report_item&post='.htmlentities((string)((isset($in['ID']) && is_array($in)) ? $in['ID'] : null), ENT_QUOTES, 'UTF-8').'&report='.htmlentities((string)((isset($cx['scopes'][0]['selected']['ID']) && is_array($cx['scopes'][0]['selected'])) ? $cx['scopes'][0]['selected']['ID'] : null), ENT_QUOTES, 'UTF-8').'&action=edit" class="report-item-edit" title="Edit block">
                <i class="fa fa-pencil fa-2x"></i>
              </a>
              <a href="" class="report-item-drag" title="Click and drag to reorder">
                <i class="fa fa-bars fa-2x"></i>
              </a>
              <div class="report-item-reorder">
                <a href="javascript:void(0)" class="report-item-reorder-up" title="Move up" data-move-up="'.htmlentities((string)((isset($in['ID']) && is_array($in)) ? $in['ID'] : null), ENT_QUOTES, 'UTF-8').'">
                  <i class="fa fa-caret-up fa-2x"></i>
                </a>
                <a href="javascript:void(0)" class="report-item-reorder-down" title="Move down" data-move-down="'.htmlentities((string)((isset($in['ID']) && is_array($in)) ? $in['ID'] : null), ENT_QUOTES, 'UTF-8').'">
                  <i class="fa fa-caret-down fa-2x"></i>
                </a>
              </div>
            </nav>
            <h3 class="report-item-title">
              '.(($cx['funcs']['ifvar']($cx, ((isset($in['index']) && is_array($in)) ? $in['index'] : null))) ? '
                <span class="report-index">'.htmlentities((string)((isset($in['index']) && is_array($in)) ? $in['index'] : null), ENT_QUOTES, 'UTF-8').'</span>
              ' : '').'
              '.htmlentities((string)((isset($in['post_title']) && is_array($in)) ? $in['post_title'] : null), ENT_QUOTES, 'UTF-8').'
            </h3>
          </header>
          '.(($cx['funcs']['ifvar']($cx, ((isset($in['show_icon']) && is_array($in)) ? $in['show_icon'] : null))) ? '
            <span class=\'highlighted-icon\'>
              <i class="fa fa-certificate fa-4x"></i>
            </span>
          ' : '').'
          <div class="report-item-content '.(($cx['funcs']['ifvar']($cx, ((isset($in['show_icon']) && is_array($in)) ? $in['show_icon'] : null))) ? ' highlighted-icon-shown ' : '').'" data-content="'.htmlentities((string)((isset($in['ID']) && is_array($in)) ? $in['ID'] : null), ENT_QUOTES, 'UTF-8').'">
            '.((isset($in['post_content']) && is_array($in)) ? $in['post_content'] : null).'
            '.(($cx['funcs']['ifvar']($cx, ((isset($in['is_table']) && is_array($in)) ? $in['is_table'] : null))) ? '
            <div class="table-content">
              <p>
                <i class="fa fa-table fa-lg"></i> '.htmlentities((string)((isset($in['table']) && is_array($in)) ? $in['table'] : null), ENT_QUOTES, 'UTF-8').'
              </p>
              '.$cx['funcs']['ch']($cx, 'format_table', Array(Array(((isset($in['table_contents']) && is_array($in)) ? $in['table_contents'] : null)),Array()), 'raw').'
            </div>
            ' : '').'
            '.(($cx['funcs']['ifvar']($cx, ((isset($in['is_chart']) && is_array($in)) ? $in['is_chart'] : null))) ? '
              <div id="'.htmlentities((string)((isset($in['chart']) && is_array($in)) ? $in['chart'] : null), ENT_QUOTES, 'UTF-8').'" class="chart"></div>
            ' : '').'
          </div>
          <span class="report-item-order" data-order-number id="block-'.htmlentities((string)((isset($in['meta-box-order']) && is_array($in)) ? $in['meta-box-order'] : null), ENT_QUOTES, 'UTF-8').'">'.htmlentities((string)((isset($in['meta-box-order']) && is_array($in)) ? $in['meta-box-order'] : null), ENT_QUOTES, 'UTF-8').'</span>
        </section>
      </li>
    ';}).'

    <li class="report-item">
      <nav class="report-item-add last">
        <a href="'.htmlentities((string)((isset($cx['scopes'][0]['host']) && is_array($cx['scopes'][0])) ? $cx['scopes'][0]['host'] : null), ENT_QUOTES, 'UTF-8').'/wp-admin/post-new.php?post_type=report_item&report='.htmlentities((string)((isset($cx['scopes'][0]['selected']['ID']) && is_array($cx['scopes'][0]['selected'])) ? $cx['scopes'][0]['selected']['ID'] : null), ENT_QUOTES, 'UTF-8').'&order=-1" title="Add new block">
          <i class="fa fa-plus fa-2x"></i>
        </a>
        <p>Add new block</p>
      </nav>
    </li>
  </ul>
</div>

<script src="'.htmlentities((string)((isset($in['root']) && is_array($in)) ? $in['root'] : null), ENT_QUOTES, 'UTF-8').'/renderization/report/js/dragula.min.js"></script>
<script src="'.htmlentities((string)((isset($in['root']) && is_array($in)) ? $in['root'] : null), ENT_QUOTES, 'UTF-8').'/renderization/report/js/reports.js"></script>
<script src="'.htmlentities((string)((isset($in['root']) && is_array($in)) ? $in['root'] : null), ENT_QUOTES, 'UTF-8').'/scripts/libraries/wesCountry.min.js"></script>
<script src="'.htmlentities((string)((isset($in['root']) && is_array($in)) ? $in['root'] : null), ENT_QUOTES, 'UTF-8').'/scripts/report-charts.js"></script>
';
}
?>