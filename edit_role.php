<?php
/**
 * Create and manage roles
 * 
 * @package roles
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Kevin Jardine <kevin@radagast.biz>
 * @copyright Curverider Ltd 2009
 * @link http://elgg.org/
 * 
 */
 
// Load Elgg engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");

// Load plugin model
require_once(dirname(__FILE__) . "/models/model.php");

action_gatekeeper();
admin_gatekeeper();

// Define context
set_context('admin');

global $CONFIG;

$body = '<div class ="contentWrapper">';
$role_id = get_input('id',0);
if ($role_id && ($role = get_entity($role_id)) && ($role->getSubtype() == 'role') ) {
	$body .= elgg_view('roles/forms/edit_role', array('role'=>$role));
} else {
	$body .= elgg_echo('roles:bad_role_id_error');
}
$body .= '</div>';

$title = elgg_echo('roles:edit_role_title');

page_draw($title,elgg_view_layout("two_column_left_sidebar", '', elgg_view_title($title) . $body));

?>