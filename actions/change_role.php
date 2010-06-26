<?php

global $CONFIG;

action_gatekeeper();
admin_gatekeeper();

$role_id = get_input('role_id',0);
if ($role_id && ($role = get_entity($role_id)) 
	&& ($role->getSubtype() == 'role')) {
	$title = get_input('title','');
	$description = get_input('description','');

	$role->title = $title;
	$role->description = $description;

	if ($role->save()) {
		system_message(elgg_echo('roles:change_response'));
	} else {
		register_error(elgg_echo('roles:change_error'));
	}
} else {
	register_error(elgg_echo('roles:change_error'));
}

forward($CONFIG->wwwroot.'/mod/roles/manage_roles.php');

?>