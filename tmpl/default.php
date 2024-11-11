<?php
defined('_JEXEC') or die;

// Get field display parameters
$showFullName = $params->get('show_full_name', 1);
$showUsername = $params->get('show_username', 1);
$showEmail = $params->get('show_email', 0);
$showRegistrationDate = $params->get('show_registration_date', 1);
$showLastLogin = $params->get('show_last_login', 1);
$showUserGroup = $params->get('show_user_group', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .user-table {
            width: 100%;
            border-collapse: collapse;
        }
        .user-table th, .user-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
           
        }
        .user-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .user-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .user-table tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<?php if (!empty($users)) : ?>
    <table class="user-table">
        <thead>
            <tr>
                <?php if ($showFullName) : ?>
                    <th>Full Name</th>
                <?php endif; ?>
                <?php if ($showUsername) : ?>
                    <th>Username</th>
                <?php endif; ?>
                <?php if ($showEmail) : ?>
                    <th>Email Address</th>
                <?php endif; ?>
                <?php if ($showRegistrationDate) : ?>
                    <th>Registration Date</th>
                <?php endif; ?>
                <?php if ($showLastLogin) : ?>
                    <th>Last Login Date</th>
                <?php endif; ?>
                <?php if ($showUserGroup) : ?>
                    <th>User Group</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <?php if ($showFullName) : ?>
                        <td><?php echo htmlspecialchars($user->full_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php endif; ?>
                    <?php if ($showUsername) : ?>
                        <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php endif; ?>
                    <?php if ($showEmail && !empty($user->email)) : ?>
                        <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php endif; ?>
                    <?php if ($showRegistrationDate) : ?>
                        <td><?php echo JHtml::_('date', $user->registerDate, 'Y-m-d H:i:s'); ?></td>
                    <?php endif; ?>
                    <?php if ($showLastLogin) : ?>
                        <td><?php echo ($user->last_login) ? JHtml::_('date', $user->last_login, 'Y-m-d H:i:s') : 'Never Logged In'; ?></td>
                    <?php endif; ?>
                    <?php if ($showUserGroup) : ?>
                        <td><?php echo htmlspecialchars($user->user_group, ENT_QUOTES, 'UTF-8'); ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No users found.</p>
<?php endif; ?>

</body>
</html>
