<?php
function roles_get() {
	return get_entities('object','role',0,"",999);
}
function roles_assign($user,$roles) {
	$user_guid = $user->getGUID();
	$new_roles_by_title = array();
	if ($roles) {
		foreach($roles as $role_id) {
			$role = get_entity($role_id);
			$new_roles_by_title[$role->title] = $role;
		}
	}
	$new_titles = array_keys($new_roles_by_title);
	$current_roles = get_entities_from_relationship('role', $user_guid, false, "object", "role", 0, "", 500);
	
	// remove roles that are not in the new list
	$current_titles = array();
	if ($current_roles) {
		foreach ($current_roles as $current_role) {
			if (!in_array($current_role->title,$new_titles)) {
				remove_entity_relationship($user_guid, 'role', $current_role->getGUID());
				remove_user_from_access_collection($user_guid, $current_role->collection_id);
			} else {
				$current_titles[] = $current_role->title;
			}
		}
	}
	
	//add new roles	
	if ($new_titles) {
		foreach ($new_titles as $new_title) {
			if (!in_array($new_title,$current_titles)) {
				$new_role = $new_roles_by_title[$new_title];
				add_entity_relationship($user_guid, 'role', $new_role->getGUID());
				add_user_to_access_collection($user_guid, $new_role->collection_id);
			}
		}
	}
	return true;
}

function roles_add($title,$description,$owner_guid) {
	$role = new ElggObject();
	$role->subtype = 'role';
	$role->access_id = ACCESS_PUBLIC;
	$role->owner_guid = $owner_guid;
	$role->title = $title;
	$role->description = $description;
	// mimics groups, although like groups, the title is not actually used
	// for access lists but is generated on the fly
	
	if ($role->save()) {
		$collection_id = create_access_collection(sprintf(elgg_echo('roles:role_name_template'),$role->getGUID()));
		$role->collection_id = $collection_id;
		return $role->save();
	} else {
		return false;
	}
}

function roles_delete($role_id) {
	if ($role_id && ($role = get_entity($role_id)) 
		&& ($role->getSubtype() == 'role')) {
		// remove all the role relationships
		remove_entity_relationships($role_id, "role", true);
		// remove the access collection
		delete_access_collection($role->collection_id);
		// delete the role itself
		return $role->delete();
	} else {
		return false;
	}
}

/**
 * Return the role access list.
 */
function roles_acl_plugin_hook($hook, $entity_type, $returnvalue, $params) {
	$roles = roles_get();
	
	if ($roles) {
		foreach($roles as $role) {
			$returnvalue[$role->collection_id] = sprintf(elgg_echo('roles:role_name_template'),$role->title);
		}
	}
	return $returnvalue;
}

function roles_user($user) {
	$collections = array();
	$current_roles = get_entities_from_relationship('role', $user->getGUID(), false, "object", "role", 0, "", 500);
	if ($current_roles) {
		foreach($current_roles as $role) {
			$collections[] = $role->getGUID();
		}
	}
	return $collections;
}
?>