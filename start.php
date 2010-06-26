<?php

	/**
	 * Elgg roles plugin
	 * 
	 * @package ElggProfile
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
	 * @author Kevin Jardine <kevin@radagast.biz>
	 * @copyright Curverider Ltd 2009
	 * @link http://elgg.com/
	 */

	// Load plugin model
    require_once(dirname(__FILE__)."/models/model.php");
    
	function roles_init() {
		
		// Load system configuration
		global $CONFIG;
			
		// Load the language files
		register_translations($CONFIG->pluginspath . "roles/languages/");
		
		// Access permissions
		register_plugin_hook('access:collections:write', 'all', 'roles_acl_plugin_hook');
	}
			
	/**
	 * Pagesetup function
	 *
	 */
	function roles_pagesetup()
	{
		if (get_context() == 'admin' && isadminloggedin()) {
			global $CONFIG;
			add_submenu_item(elgg_echo('roles:manage_roles_title'), $CONFIG->wwwroot . 'mod/roles/manage_roles.php');
		}
		
		extend_view('profile/menu/adminlinks','roles/forms/assign_roles');
	}

	register_elgg_event_handler('init','system','roles_init');
	register_elgg_event_handler('pagesetup','system','roles_pagesetup');
	
	// Register actions
	global $CONFIG;
	register_action("roles/add_role",false,$CONFIG->pluginspath . "roles/actions/add_role.php");
	register_action("roles/change_role",false,$CONFIG->pluginspath . "roles/actions/change_role.php");
	register_action("roles/delete_role",false,$CONFIG->pluginspath . "roles/actions/delete_role.php");
	register_action("roles/assign_roles",false,$CONFIG->pluginspath . "roles/actions/assign_roles.php");

?>