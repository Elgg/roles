<?php
$role = $vars['role'];
if ($role) {
	$action = 'change_role';
	$role_id = $role->getGUID();
	$title = $role->title;
	$description = $role->description;
	$form = '';	
} else {
	$action = 'add_role';
	$role_id = 0;
	$title = '';
	$description='';
	$form = '<h2>'.elgg_echo('roles:add_title').'</h2>';
}

$form .= elgg_view('input/hidden',array('internalname'=>'role_id','value'=>$role_id));

$form .= '<p><label for="title">'.elgg_echo('roles:title_label').'<br />';
$form .= elgg_view('input/text',array('internalname'=>'title', 'value'=>$title)).'</label><br />';
$form .= elgg_echo('roles:title_description').'</p>';

$form .= '<p><label for="description">'.elgg_echo('roles:description_label').'<br />';
$form .= elgg_view('input/text',array('internalname'=>'description', 'value'=>$description)).'</label><br />';
$form .= elgg_echo('roles:description_description').'</p>';
$form .= elgg_view('input/submit',array('value'=>elgg_echo('save')));

echo elgg_view('input/form',array('action'=>$vars['url'].'action/roles/'.$action,'body'=>$form));
?>