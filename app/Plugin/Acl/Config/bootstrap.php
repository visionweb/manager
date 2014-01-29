<?php
/* -------------------------------------------------------------------
 * The settings below have to be loaded to make the acl plugin work.
 * -------------------------------------------------------------------
 *
 * See how to include these settings in the README file
 */

/*
 * The model name used for the user group (typically 'Role' or 'Group')
 */
Configure :: write('acl.aro.group.model', 'Group');

/*
 * The primary key of the group model
 *
 * (can be left empty if your primary key's name follows CakePHP conventions)('id')
 */
Configure :: write('acl.aro.group.primary_key', 'id');

/*
 * The foreign key's name for the groups
 *
 * (can be left empty if your foreign key's name follows CakePHP conventions)(e.g. 'group_id')
 */
Configure :: write('acl.aro.group.foreign_key', 'group_id');

/*
 * The model name used for the user (typically 'User')
 */
Configure :: write('acl.aro.user.model', 'User');

/*
 * The primary key of the user model
 *
 * (can be left empty if your primary key's name follows CakePHP conventions)('id')
 */
Configure :: write('acl.aro.user.primary_key', 'id');

/*
 * The name of the database field that can be used to display the group name
 */
Configure :: write('acl.aro.group.display_field', 'nom_group');

/*
 * You can add here group id(s) that are always allowed to access the ACL plugin (by bypassing the ACL check)
 * (This may prevent a user from being rejected from the ACL plugin after a ACL permission update)
 */
Configure :: write('acl.group.access_plugin_group_ids', array());

/*
 * You can add here users id(s) that are always allowed to access the ACL plugin (by bypassing the ACL check)
 * (This may prevent a user from being rejected from the ACL plugin after a ACL permission update)
 */
Configure :: write('acl.group.access_plugin_user_ids', array(2));

/*
 * The users table field used as username in the views
 * It may be a table field or a SQL expression such as "CONCAT(User.lastname, ' ', User.firstname)" for MySQL or "User.lastname||' '||User.firstname" for PostgreSQL
 */
Configure :: write('acl.user.display_name', "User.username");

/*
 * Indicates whether the presence of the Acl behavior in the user and group models must be verified when the ACL plugin is accessed
 */
Configure :: write('acl.check_act_as_requester', true);

/*
 * Add the ACL plugin 'locale' folder to your application locales' folders
 */
App :: build(array('locales' => App :: pluginPath('Acl') . DS . 'locale'));

/*
 * Indicates whether the groups permissions page must load through Ajax
 */
Configure :: write('acl.gui.groups_permissions.ajax', false);

/*
 * Indicates whether the users permissions page must load through Ajax
 */
Configure :: write('acl.gui.users_permissions.ajax', false);
?>