<?php
// Load plugin model
require_once(dirname(dirname(__FILE__))."/models/model.php");

global $CONFIG;

admin_gatekeeper();

$role_id = get_input('id',0);
if (roles_delete($role_id)) {
	system_message(elgg_echo('roles:delete_response'));
} else {
	register_error(elgg_echo('roles:delete_error'));
}

forward($CONFIG->wwwroot.'/mod/roles/manage_roles.php');

?>