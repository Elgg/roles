<?php
// Load plugin model
require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/models/model.php");

$user = page_owner_entity();

if ($user) {
	$roles = roles_get();
	if ($roles) {
		$user_roles = roles_user($user);
		$options = array();
		foreach ($roles as $role) {
			$options[$role->title] = $role->getGUID();
		}
		$body = '<h3>'.elgg_echo('roles:assign_roles_title').'</h3>';
		$body .= elgg_view('input/hidden',array('internalname'=>'user_guid','value'=>$user->getGUID()));
		$body .= elgg_view('input/checkboxes',array('internalname'=>'roles','value'=>$user_roles,'options'=>$options));
		$body .= elgg_view('input/submit',array('value'=>elgg_echo('roles:assign')));
		
		echo elgg_view('input/form',array('action'=>$vars['url'].'action/roles/assign_roles','body'=>$body));
	}
}
?>