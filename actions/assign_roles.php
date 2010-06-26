<?php

// Load plugin model
require_once(dirname(dirname(__FILE__))."/models/model.php");

global $CONFIG;

admin_gatekeeper();

$roles = get_input('roles',array());
$user_guid = get_input('user_guid',0);
$user = get_entity($user_guid);

if (roles_assign($user,$roles)) {
	system_message(elgg_echo('roles:assign_response'));
} else {
	register_error(elgg_echo('roles:assign_error'));
}

forward($user->getURL());

?>