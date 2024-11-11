<?php
defined('_JEXEC') or die;

class ModUserListHelper
{
    public static function getUsers($params)
    {
        // Get the database object
        $db = JFactory::getDbo();
        
        // Get selected user groups from parameters
        $userGroups = $params->get('user_groups', []);
        
        // Build the query to retrieve users with additional details
        $query = $db->getQuery(true)
            ->select([
                $db->quoteName('u.id'),
                $db->quoteName('u.name', 'full_name'),
                $db->quoteName('u.username'),
                $db->quoteName('u.email'),
                $db->quoteName('u.registerDate'),
                $db->quoteName('u.lastvisitDate', 'last_login'),
                $db->quoteName('g.title', 'user_group')
            ])
            ->from($db->quoteName('#__users', 'u'))
            ->join('LEFT', $db->quoteName('#__user_usergroup_map', 'map') . ' ON map.user_id = u.id')
            ->join('LEFT', $db->quoteName('#__usergroups', 'g') . ' ON g.id = map.group_id');

        // Filter by user groups if any are selected
        if (!empty($userGroups)) {
            $query->where($db->quoteName('g.id') . ' IN (' . implode(',', array_map([$db, 'quote'], $userGroups)) . ')');
        }

        // Set the query and load the results
        $db->setQuery($query);
        return $db->loadObjectList();
    }
}
