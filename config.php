<?php

if (!defined('NGCMS')) die ('HAL');

pluginsLoadConfig();
LoadPluginLang('user_stag', 'config', '', '', '#');

if (!getPluginStatusActive('uprofile')) {
	msg(['type' => 'error', 'text' => $lang['user_stag']['uprofile_error']]);
	return print_msg( 'warning', $lang['user_stag']['user_stag'], $lang['user_stag']['uprofile_error'], 'javascript:history.go(-1)' );
}

switch ($_REQUEST['action']) {
	case 'about':			about();		break;
	default: main();
}

function about()
{global $twig, $lang, $breadcrumb;
	$tpath = locatePluginTemplates(array('main', 'about'), 'user_stag', 1);
	$breadcrumb = breadcrumb('<i class="fa fa-user btn-position"></i><span class="text-semibold">'.$lang['user_stag']['user_stag'].'</span>', array('?mod=extras' => '<i class="fa fa-puzzle-piece btn-position"></i>'.$lang['extras'].'', '?mod=extra-config&plugin=user_stag' => '<i class="fa fa-user btn-position"></i>'.$lang['user_stag']['user_stag'].'',  '<i class="fa fa-exclamation-circle btn-position"></i>'.$lang['user_stag']['about'].'' ) );

	$xt = $twig->loadTemplate($tpath['about'].'about.tpl');
	$tVars = array();
	$xg = $twig->loadTemplate($tpath['main'].'main.tpl');
	
	$about = 'версия 0.1';
	
	$tVars = array(
		'global' => 'О плагине',
		'header' => $about,
		'entries' => $xt->render($tVars)
	);
	
	print $xg->render($tVars);
}

function main()
{global $twig, $lang, $breadcrumb;
	
	$tpath = locatePluginTemplates(array('main', 'general.from'), 'user_stag', 1);
	$breadcrumb = breadcrumb('<i class="fa fa-user btn-position"></i><span class="text-semibold">'.$lang['user_stag']['user_stag'].'</span>', array('?mod=extras' => '<i class="fa fa-puzzle-piece btn-position"></i>'.$lang['extras'].'', '?mod=extra-config&plugin=user_stag' => '<i class="fa fa-user btn-position"></i>'.$lang['user_stag']['user_stag'].'' ) );

	if (isset($_REQUEST['submit'])){
		pluginSetVariable('user_stag', 'us_month', intval($_REQUEST['us_month']));
		pluginsSaveConfig();
		msg(array("type" => "info", "info" => "сохранение прошло успешно"));
		return print_msg( 'info', ''.$lang['user_stag']['user_stag'].'', 'Cохранение прошло успешно', 'javascript:history.go(-1)' );
	}
	
	$us_month = pluginGetVariable('user_stag', 'us_month');
	$us_month = '<option value="1" '.($us_month==1?'selected':'').'>'.$lang['noa'].'</option><option value="0" '.($us_month==0?'selected':'').'>'.$lang['yesa'].'</option>';
	
	$xt = $twig->loadTemplate($tpath['general.from'].'general.from.tpl');
	$xg = $twig->loadTemplate($tpath['main'].'main.tpl');
	
	$tVars = array(
		'us_month' => $us_month,
	);
	
	$tVars = array(
		'global' => 'Общие',
		'header' => '<i class="fa fa-exclamation-circle"></i> <a href="?mod=extra-config&plugin=user_stag&action=about">'.$lang['user_stag']['about'].'</a>',
		'entries' => $xt->render($tVars)
	);
	
	print $xg->render($tVars);
}

?>