<?php

// Load plugin model
require_once(dirname(dirname(__FILE__))."/models/model.php");

global $CONFIG;

action_gatekeeper();
admin_gatekeeper();

$title = get_input('title','');
$description = get_input('description','');

if (roles_add($title,$description,$_SESSION['user']->getGUID())) {
	system_message(elgg_echo('roles:add_response'));
} else {
	register_error(elgg_echo('roles:add_error'));
}

forward($CONFIG->wwwroot.'/mod/roles/manage_roles.php');

?>