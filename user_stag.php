<?php

// Protect against hack attempts
if (!defined('NGCMS')) die ('HAL');

LoadPluginLang('user_stag', 'main', '', '', '#');

function stag ($newsID) {
	global $mysql, $lang, $userROW;

	$row = $mysql->record("SELECT reg, last, id FROM " . uprefix . "_users WHERE id = ". intval($newsID)." ORDER BY reg DESC LIMIT 1");

	$with_us = round((time() - $row['reg']) / 86400);

	if ($with_us > 0){
                                                 
	$count_days=1;

	$y1 = $lang['user_stag']['y1']; 
	$y2 = $lang['user_stag']['y2']; 
	$y3 = $lang['user_stag']['y3']; 
	$m1 = $lang['user_stag']['m1']; 
	$m2 = $lang['user_stag']['m2']; 
	$m3 = $lang['user_stag']['m3']; 
	$d1 = $lang['user_stag']['d1']; 
	$d2 = $lang['user_stag']['d2']; 
	$d3 = $lang['user_stag']['d3'];

	$with_us_year = floor($with_us / 365);

	if ($with_us_year >= 1){
		if ($with_us_year == 1) $after_y = $y1;
		if ($with_us_year > 1 && $with_us_year < 5) $after_y = $y2;
		if ($with_us_year > 4) $after_y = $y3;
	$years = $with_us_year." ".$after_y;
	$with_us = $with_us - ($years * 365);
	$count_days=0;
	}
	
	$with_us_month = floor($with_us / 31);
	
	if ($with_us_month >= 1){
		if ($with_us_month == 1) $after_m = $m1;
		if ($with_us_month > 1 && $with_us_month < 5) $after_m = $m2;
		if ($with_us_month > 4) $after_m = $m3;
	$monthes = $with_us_month." ".$after_m;
	$with_us = $with_us - ($monthes * 31);
		if (pluginGetVariable('user_stag', 'us_month')) {
			if ($with_us_month > 6) $count_days=0;
		}
		if ($with_us_month == 12) {
			$years = ($with_us_year+1)." ".$y1;$with_us_month=$monthes='';
		}
	}
	
	if ($count_days == 1){
		if ($with_us > 0){
			if ($with_us == 1 || $with_us == 21 || $with_us == 31) $after_d = $d1;
			if ($with_us > 1 && $with_us < 5) $after_d = $d2;
			if ($with_us > 4 && $with_us < 21) $after_d = $d3;
			if ($with_us > 21 && $with_us < 25) $after_d = $d2;
			if ($with_us > 24 && $with_us < 31) $after_d = $d3;
		$days = $with_us." ".$after_d;
		}
	}
	
	$stag = ''.$years.' '.$monthes.' '.$days.'';
	unset($years); unset($monthes); unset($days);
	
	return $stag;
	}
	
$stag = 0;
return $stag;
}

LoadPluginLibrary('uprofile', 'lib');

class StagUserFilter extends p_uprofileFilter {

	function showProfile($userID, $SQLrow, &$tvars) {
		$with_us = stag ($userID);
		$tvars['user']['stag'] = $with_us;
	}
}

pluginRegisterFilter('plugin.uprofile', 'user_stag', new StagUserFilter);

?>