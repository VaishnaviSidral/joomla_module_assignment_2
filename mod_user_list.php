<?php
defined('_JEXEC') or die;

// Check access control for logged-in users only if set
$restrictAccess = $params->get('restrict_access', 1);
$user = JFactory::getUser();
if ($restrictAccess && $user->guest) {
    return;
}

// Include the helper file
require_once __DIR__ . '/src/Helper/UserListHelper.php';

// Get the user data based on selected user groups and display fields
$users = ModUserListHelper::getUsers($params);

// Load the layout
require JModuleHelper::getLayoutPath('mod_user_list');
?>
