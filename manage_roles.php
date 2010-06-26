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

admin_gatekeeper();

// Define context
set_context('admin');

global $CONFIG;

$roles = roles_get();
$body = '<div class ="contentWrapper">';
$body .= elgg_view('roles/list',array('roles'=>$roles));
$body .= elgg_view('roles/forms/edit_role');
$body .= '</div>';

$title = elgg_echo('roles:manage_roles_title');

page_draw($title,elgg_view_layout("two_column_left_sidebar", '', elgg_view_title($title) . $body));

?>