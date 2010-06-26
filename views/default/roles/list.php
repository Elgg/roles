<?php
$edit_msg = elgg_echo('roles:edit');
$remove_msg = elgg_echo('roles:remove');
$remove_confirm_msg = elgg_echo('roles:remove_confirm');
$img_template = '<img border="0" width="16" height="16" alt="%s" title="%s" src="'.$vars['url'].'mod/roles/images/%s" />';
$edit_img = sprintf($img_template,$edit_msg,$edit_msg,"16-em-pencil.png");
$remove_img = sprintf($img_template,$remove_msg,$remove_msg,"16-em-cross.png");
$row_template = <<<END
<a href="{$vars['config']->wwwroot}mod/roles/edit_role.php?id=%s">$edit_img</a> |
<a onclick="return confirm('$remove_confirm_msg')" href="{$CONFIG->wwwroot}action/roles/delete_role?id=%s">$remove_img</a>
| %s (%s)<br />
END;
$body = '';
$roles = $vars['roles'];
if ($roles) {
	foreach($roles as $role) {
		$role_id = $role->getGUID();
		$body .= sprintf($row_template,$role_id,$role_id,$role->title,$role->description);
	}
}

$body .= '<br />';

echo $body;
?>