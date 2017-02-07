
CREATE TABLE IF NOT EXISTS `%PREFIX%access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_id` int(11) NOT NULL,
  `controller` varchar(32) NOT NULL,
  `method` varchar(32) NOT NULL,
  `system` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `access_id` (`access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Save Application Access' AUTO_INCREMENT=72;

INSERT INTO `%PREFIX%access` (`id`, `access_id`, `controller`, `method`, `system`) VALUES (1, 1, 'dashboard', 'index', 1),
(2, 1, 'dashboard', 'notifications', 1),
(3, 1, 'dashboard', 'remove_notification', 1),
(4, 1, 'dashboard', 'clear_notice', 1),
(5, 1, 'dashboard', 'messages', 1),
(6, 1, 'dashboard', 'label_messages', 1),
(7, 1, 'dashboard', 'search_messages', 1),
(8, 1, 'dashboard', 'write_message', 1),
(9, 1, 'dashboard', 'forward_message', 1),
(10, 1, 'dashboard', 'send_message', 1),
(11, 1, 'dashboard', 'edit_label', 1),
(12, 1, 'dashboard', 'save_label', 1),
(13, 1, 'dashboard', 'remove_label', 1),
(14, 1, 'dashboard', 'trash_message', 1),
(15, 1, 'dashboard', 'remove_message', 1),
(16, 1, 'dashboard', 'message_star_flag', 1),
(17, 1, 'dashboard', 'message_label', 1),
(18, 1, 'users', 'index', 1),
(19, 1, 'users', 'edit', 1),
(20, 1, 'users', 'save', 1),
(21, 1, 'users', 'remove', 1),
(22, 1, 'users', 'accesses', 1),
(23, 1, 'users', 'edit_access', 1),
(24, 1, 'users', 'save_access', 1),
(25, 1, 'users', 'remove_access', 1),
(26, 1, 'users', 'groups', 1),
(27, 1, 'users', 'edit_group', 1),
(29, 1, 'users', 'save_group', 1),
(30, 1, 'users', 'remove_group', 1),
(31, 1, 'settings', 'index', 1),
(32, 1, 'settings', 'save', 1),
(33, 1, 'settings', 'save_section', 1),
(34, 1, 'settings', 'edit_group', 1),
(35, 1, 'settings', 'edit_setting', 1),
(36, 1, 'settings', 'save_group', 1),
(37, 1, 'settings', 'save_setting', 1),
(38, 1, 'settings', 'remove_setting', 1),
(39, 1, 'settings', 'remove_group', 1),
(40, 1, 'settings', 'edit_section', 1),
(41, 1, 'settings', 'remove_section', 1),
(42, 1, 'contents', 'index', 1),
(43, 1, 'contents', 'edit', 1),
(44, 1, 'contents', 'save', 1),
(45, 1, 'contents', 'remove', 1),
(46, 1, 'contents', 'types', 1),
(47, 1, 'contents', 'edit_type', 1),
(48, 1, 'contents', 'save_type', 1),
(49, 1, 'contents', 'remove_type', 1),
(50, 1, 'contents', 'groups', 1),
(51, 1, 'contents', 'edit_group', 1),
(52, 1, 'contents', 'save_group', 1),
(53, 1, 'contents', 'remove_group', 1),
(54, 1, 'contents', 'fieldsets', 1),
(55, 1, 'contents', 'edit_fieldset', 1),
(56, 1, 'contents', 'save_fieldset', 1),
(57, 1, 'contents', 'remove_fieldset', 1),
(58, 1, 'contents', 'fields', 1),
(59, 1, 'contents', 'edit_field', 1),
(60, 1, 'contents', 'save_field', 1),
(61, 1, 'contents', 'remove_field', 1),
(62, 1, 'contents', 'languages', 1),
(63, 1, 'contents', 'edit_language', 1),
(64, 1, 'contents', 'save_language', 1),
(65, 1, 'contents', 'remove_language', 1),
(66, 1, 'menus', 'index', 1),
(67, 1, 'menus', 'edit_menu', 1),
(68, 1, 'menus', 'save_menu', 1),
(69, 1, 'menus', 'remove_menu', 1),
(70, 1, 'menus', 'edit_item', 1),
(71, 1, 'menus', 'save_item', 1),
(72, 1, 'menus', 'remove_item', 1);

CREATE TABLE IF NOT EXISTS `%PREFIX%contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT 'Contents Types',
  `group_id` int(11) NULL DEFAULT '0' COMMENT 'Content Groups',
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ordering` int(11) NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL,
  `access` varchar(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `Alias` (`alias`),
  KEY `Group` (`group_id`),
  KEY `Type` (`type_id`),
  KEY `User` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Save Contents Core Information' AUTO_INCREMENT=4 ;

INSERT INTO `%PREFIX%contents` (`id`, `alias`, `type_id`, `group_id`, `user_id`, `status`, `ordering`, `timestamp`, `modified`, `access`) VALUES
(1, 'home', 1, 0, 1111, 1, 0, NULL, '2014-05-31 21:35:24', '0'),
(2, 'about', 1, 0, 1111, 1, 0, NULL, '2014-05-30 09:27:38', '0');

CREATE TABLE IF NOT EXISTS `%PREFIX%content_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL COMMENT 'Fields Groups',
  `name` varchar(64) NOT NULL,
  `label` varchar(255) NOT NULL,
  `type` varchar(32) NOT NULL,
  `system` tinyint(4) NOT NULL DEFAULT '0',
  `access` varchar(11) DEFAULT '0',
  `required` int(11) NOT NULL DEFAULT '0',
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `trash` tinyint(1) NOT NULL DEFAULT '0',
  `in_admin_list` tinyint(1) NOT NULL DEFAULT '0',
  `in_list` tinyint(4) NOT NULL DEFAULT '0',
  `in_view` tinyint(1) NOT NULL DEFAULT '1',
  `in_search` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NULL DEFAULT '0',
  `validations` text,
  `options` varchar(255) DEFAULT NULL,
  `default_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `group_id` (`group_id`),
  KEY `Field Visibility` (`in_admin_list`,`in_list`,`in_view`,`in_search`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Contents Fields' AUTO_INCREMENT=7 ;

INSERT INTO `%PREFIX%content_fields` (`id`, `group_id`, `name`, `label`, `type`, `system`, `access`, `required`, `enabled`, `trash`, `in_admin_list`, `in_list`, `in_view`, `in_search`, `ordering`, `validations`, `options`, `default_value`) VALUES
(1, 1, 'title', 'Title', 'text', 1, '0', 1, 1, 0, 1, 1, 1, 1, 0, NULL, NULL, ''),
(2, 1, 'excerpt', 'Excerpt', 'textarea', 1, '0', 0, 1, 0, 0, 1, 0, 1, 1, NULL, NULL, ''),
(3, 1, 'content', 'Content', 'editor', 1, '0', 1, 1, 0, 0, 0, 1, 1, 2, NULL, NULL, ''),
(4, 2, 'meta_title', 'Meta Title', 'text', 1, '0,1', 0, 1, 0, 0, 0, 0, 1, 0, NULL, NULL, ''),
(5, 2, 'meta_description', 'Meta Description', 'textarea', 1, '0,1', 0, 1, 0, 0, 0, 0, 1, 0, NULL, NULL, ''),
(6, 2, 'meta_keywords', 'Meta Keywords', 'text', 1, '1', 0, 1, 0, 0, 1, 0, 1, 0, NULL, NULL, '');

CREATE TABLE IF NOT EXISTS `%PREFIX%content_field_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL DEFAULT 'default',
  `ordering` int(11) NULL,
  `access` varchar(11) NOT NULL DEFAULT '0',
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `system` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `access` (`access`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Fields Groups' AUTO_INCREMENT=3 ;

INSERT INTO `%PREFIX%content_field_groups` (`id`, `name`, `position`, `ordering`, `access`, `enabled`, `system`) VALUES
(1, 'Details', 'default', 0, '0', 1, 1),
(2, 'Meta Information', 'meta', 2, '0', 1, 0);

CREATE TABLE IF NOT EXISTS `%PREFIX%content_field_options` (
  `option_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL COMMENT 'Content Fields',
  `value` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `concat` set('+','-') NOT NULL DEFAULT '+',
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`option_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Fields Options' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `%PREFIX%content_field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `content_id` int(11) NOT NULL COMMENT 'Contents',
  `field_id` int(11) NOT NULL COMMENT 'Content Fields',
  `option_id` int(11) DEFAULT NULL COMMENT 'Field Options',
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `content_id` (`content_id`,`field_id`,`option_id`),
  KEY `language_id` (`language_id`),
  KEY `option_id` (`option_id`),
  FULLTEXT KEY `value` (`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Content Fields Value' AUTO_INCREMENT=37 ;

INSERT INTO `%PREFIX%content_field_values` (`id`, `language_id`, `content_id`, `field_id`, `option_id`, `value`) VALUES
(1, 1, 1, 1, NULL, 'Welcome to Bootigniter'),
(2, 1, 1, 2, NULL, 'Hey, Thanks for trying out Bootigniter, and now that \r\nyou are here so we just can''t wait to get started.'),
(3, 1, 1, 3, NULL, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ornare pretium vehicula. Phasellus sagittis pretium libero, ut tincidunt arcu dapibus sed. Ut non congue nunc. Nulla condimentum iaculis massa quis ultrices. In consequat, elit vitae sodales suscipit, ante turpis vestibulum neque, in condimentum neque est sit amet lorem. Donec tempor elit at diam tristique aliquam. Mauris molestie tristique metus, non accumsan urna pulvinar sit amet. Nullam faucibus enim quis neque aliquam lacinia. Ut fermentum non felis vitae placerat. '),
(4, 1, 1, 5, NULL, ''),
(5, 1, 1, 6, NULL, ''),
(6, 1, 1, 7, NULL, ''),
(7, 2, 1, 1, NULL, 'Bootigniter Aapka swagat karta hai'),
(8, 2, 1, 2, NULL, 'Bootigniter ka upyog karne k liye dhanyawaad.'),
(9, 2, 1, 3, NULL, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ornare pretium vehicula. Phasellus sagittis pretium libero, ut tincidunt arcu dapibus sed. Ut non congue nunc. Nulla condimentum iaculis massa quis ultrices. In consequat, elit vitae sodales suscipit, ante turpis vestibulum neque, in condimentum neque est sit amet lorem. Donec tempor elit at diam tristique aliquam. Mauris molestie tristique metus, non accumsan urna pulvinar sit amet. Nullam faucibus enim quis neque aliquam lacinia. Ut fermentum non felis vitae placerat.</p>\r\n'),
(10, 2, 1, 5, NULL, ''),
(11, 2, 1, 6, NULL, ''),
(12, 2, 1, 7, NULL, ''),
(13, 1, 2, 1, NULL, 'About Us'),
(14, 1, 2, 2, NULL, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ornare pretium vehicula. Phasellus sagittis pretium libero, ut tincidunt arcu dapibus sed. Ut non congue nunc. Nulla condimentum iaculis massa quis ultrices.'),
(15, 1, 2, 3, NULL, '<p>Cum sociis natoque penatibus et magnis <a href="http://bootigniter.org">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>\r\n\r\n<blockquote>\r\n<p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>\r\n</blockquote>\r\n\r\n<p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>\r\n\r\n<p>Heading</p>\r\n\r\n<p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>\r\n\r\n<p>Sub-heading</p>\r\n\r\n<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Example code block</p>\r\n\r\n<p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>\r\n\r\n<p>Sub-heading</p>\r\n\r\n<p>Cum sociis natoque p</p>\r\n'),
(16, 1, 2, 5, NULL, ''),
(17, 1, 2, 6, NULL, ''),
(18, 1, 2, 7, NULL, ''),
(19, 2, 2, 1, NULL, 'हमारे बारे में'),
(20, 2, 2, 2, NULL, 'यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है '),
(21, 2, 2, 3, NULL, 'यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है यह एक नमूना पाठ है '),
(22, 2, 2, 5, NULL, ''),
(23, 2, 2, 6, NULL, ''),
(24, 2, 2, 7, NULL, '');

CREATE TABLE IF NOT EXISTS `%PREFIX%content_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT '0',
  `type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `access` varchar(11) NOT NULL DEFAULT '0',
  `system` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Save Content Categories' AUTO_INCREMENT=2 ;

INSERT INTO `%PREFIX%content_groups` (`id`, `parent`, `type`, `name`, `alias`, `description`, `enabled`, `access`, `system`) VALUES
(0, NULL, 1, 'Uncategories', 'uncategories', NULL, 1, '0', 1);

CREATE TABLE IF NOT EXISTS `%PREFIX%content_types` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `have_groups` tinyint(4) NOT NULL DEFAULT '0',
  `group_depth` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Group Child Lavel',
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `system` tinyint(4) NOT NULL DEFAULT '0',
  `access` varchar(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Content Types' AUTO_INCREMENT=2 ;

INSERT INTO `%PREFIX%content_types` (`id`, `name`, `alias`, `description`, `have_groups`, `group_depth`, `enabled`, `system`, `access`) VALUES
(1, 'Pages', 'pages', 'Static Contents Pages', 0, 0, 1, 1, '0');

CREATE TABLE IF NOT EXISTS `%PREFIX%content_type_x_fields` (
  `x_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL COMMENT 'Content Types',
  `group_id` int(11) NOT NULL COMMENT 'Field Groups',
  PRIMARY KEY (`x_id`),
  KEY `type_id` (`type_id`,`group_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Content Groups For Content Types' AUTO_INCREMENT=3 ;

INSERT INTO `%PREFIX%content_type_x_fields` (`x_id`, `type_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

CREATE TABLE IF NOT EXISTS `%PREFIX%labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `groups` int(11) NOT NULL DEFAULT '1' COMMENT 'Label Types (1 = Message, 2 = Tags)',
  `label` varchar(32) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `system` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `label` (`label`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `%PREFIX%labels` (`id`, `user_id`, `groups`, `label`, `color`, `system`) VALUES
(1, 1111, 1, 'Important', '#E97436', 1),
(2, 1111, 1, 'Personal', '#C969C9', 1),
(3, 1111, 1, 'Work', '#23BAB5', 1),
(4, 1111, 1, 'Misc', '#FFCC33', 0);

CREATE TABLE IF NOT EXISTS `%PREFIX%languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` varchar(8) NOT NULL,
  `directory` varchar(11) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `ordering` int(11) NULL,
  `system` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Languages' AUTO_INCREMENT=3 ;

INSERT INTO `%PREFIX%languages` (`id`, `name`, `code`, `directory`, `is_default`, `is_admin`, `status`, `ordering`, `system`) VALUES
(1, 'English', 'en', 'english', 1, 1, 1, 0, 1),
(2, 'Hindi', 'hi', 'hindi', 0, 0, 1, 0, 0);

CREATE TABLE IF NOT EXISTS `%PREFIX%menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `item_depth` tinyint(4) NOT NULL DEFAULT '0',
  `access` varchar(32) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Save Navigations ' AUTO_INCREMENT=3 ;

INSERT INTO `%PREFIX%menus` (`id`, `name`, `description`, `item_depth`, `access`) VALUES
(1, 'Primary', '', 0, '0,1,2,3,4'),
(2, 'Secondary', '', 0, '0,1,2,3,4');

CREATE TABLE IF NOT EXISTS `%PREFIX%menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` tinyint(4) NOT NULL DEFAULT '0',
  `menu_id` int(11) NOT NULL COMMENT 'Menus',
  `menu_type` int(11) NOT NULL DEFAULT '0' COMMENT 'Menu Types ( 0 = Link, 1 = Path, 2 =  Contents, 3 = Groups, 4 = HTML)',
  `title` varchar(255) NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `access` varchar(11) NOT NULL DEFAULT '0',
  `content_type` int(11) NULL DEFAULT '0',
  `content_id` varchar(255) DEFAULT NULL COMMENT 'Content Alias',
  `path` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`content_id`),
  KEY `parent` (`parent`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Navigation Items' AUTO_INCREMENT=8 ;

INSERT INTO `%PREFIX%menu_items` (`id`, `parent`, `menu_id`, `menu_type`, `title`, `enabled`, `access`, `content_id`, `path`, `link`) VALUES
(1, 0, 1, 2, 'Home', 0, '0,1,2,3,4', 'home', 'page/index', ''),
(2, 0, 1, 2, 'About', 1, '0,1,2,3,4', 'about', '/', ''),
(3, 0, 1, 0, 'Features', 1, '0,1,2,3,4', 'contact', '', '#'),
(4, 0, 2, 0, 'Privacy', 1, '0,1,2,3,4', NULL, '', '#'),
(5, 0, 2, 0, 'Terms', 1, '0,1,2,3,4', NULL, '', '#'),
(6, 0, 1, 0, 'Demo', 1, '0,1,2,3,4', NULL, '', '#'),
(7, 0, 1, 0, 'Community', 1, '0,1,2,3,4', NULL, '', '#');

CREATE TABLE IF NOT EXISTS `%PREFIX%messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT 'Message Type (0 = Activity, 1 = Notification, 2 = Message, 3 = Email, 4 = Comments)',
  `receiver` int(11) NOT NULL DEFAULT '0',
  `author` int(11) NOT NULL DEFAULT '0',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_star` tinyint(1) NOT NULL DEFAULT '0',
  `have_attachment` tinyint(1) NOT NULL DEFAULT '0',
  `trash` tinyint(1) NOT NULL DEFAULT '0',
  `label` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `attachments` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`,`type`),
  KEY `subject` (`subject`),
FULLTEXT KEY `body` (`body`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Store All Type Messages & Notifications' AUTO_INCREMENT=4 ;

INSERT INTO `%PREFIX%messages` (`id`, `parent_id`, `type`, `receiver`, `author`, `is_read`, `is_star`, `have_attachment`, `trash`, `label`, `subject`, `body`, `attachments`, `created`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Bootigniter Installed', 'Your Bootigniter Packae Installed Successfully', '', NULL),
(2, 0, 1, 1111, 1111, 0, 0, 0, 0, 0, 'Update Admin User information', 'You should updat your admin user details & Password', '', NULL),
(3, 0, 2, 1111, 1111, 0, 0, 0, 0, 0, 'Welcome, Bootigniter" An Open Source CMS Boilerplate ', 'Now Deploy, scale and monitor your app with our Intuitive and Powerful Content Management System (CMS). A very Sleek API pattern for developers to extend the power of Codeigniter.<br /><p>Cum sociis natoque penatibus et magnis <a href="http://bootigniter.org">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p><blockquote><p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p></blockquote><p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p><p>Heading</p><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p><p>Sub-heading</p><p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Example code block</p><p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p><p>Sub-heading</p><p>Cum sociis natoque p</p>', '', NULL);

CREATE TABLE IF NOT EXISTS `%PREFIX%settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `system` tinyint(4) NOT NULL DEFAULT '0',
  `key` varchar(32) NOT NULL,
  `value` text,
  `options` text,
  `default_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Save Setting Configurations' AUTO_INCREMENT=9;

INSERT INTO `%PREFIX%settings` (`id`, `group_id`, `type`, `system`, `key`, `value`, `options`, `default_value`) VALUES
(1, 1, 'text', 1, 'administrator', 'Admin', NULL, NULL),
(2, 1, 'text', 0, 'administrator_email', 'admin@example.com', NULL, NULL),
(3, 1, 'text', 0, 'record_per_page', '10', NULL, NULL),
(4, 2, 'text', 0, 'global_meta_title', 'Bootigniter - An Open Source CMS Boilerplate', NULL, NULL),
(5, 2, 'text', 0, 'global_meta_keywords', 'Codeigniter CMS, Custom CMS, Customised Content Management System, Lightweight CMS, Tiny CMS, Flexible CMS, Download CMS, Bootstrap CMS, Mobile CMS, Responsive CMS', NULL, NULL),
(6, 2, 'textarea', 0, 'global_meta_description', 'An another open source project of Codeigniter with Bootstrap. It is a Lightweight MVC package for you to build your own Custom CMS.', NULL, NULL),
(7, 3, 'text', 0, 'site_name', 'BootIgniter', NULL, NULL);

CREATE TABLE IF NOT EXISTS `%PREFIX%setting_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL COMMENT 'Section ID',
  `title` varchar(128) NOT NULL,
  `access` varchar(32) NOT NULL DEFAULT '1',
  `system` tinyint(4) NOT NULL DEFAULT '0',
  `ordering` int(64) NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Save Setting''s Groups' AUTO_INCREMENT=4 ;

INSERT INTO `%PREFIX%setting_groups` (`id`, `sid`, `title`, `access`, `system`, `ordering`) VALUES
(1, 2, 'Administrator', '1', 1, 0),
(2, 3, 'Global Meta', '2,1', 1, 0),
(3, 1, 'Site Name', '1,2', 0, 0);

CREATE TABLE IF NOT EXISTS `%PREFIX%setting_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `access` varchar(32) NOT NULL DEFAULT '1',
  `system` tinyint(4) NOT NULL DEFAULT '0',
  `ordering` int(64) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Save Setting''s Sections' AUTO_INCREMENT=5 ;

INSERT INTO `%PREFIX%setting_sections` (`id`, `title`, `access`, `system`, `ordering`) VALUES
(1, 'Default', '1,2,3', 1, 0),
(2, 'Admin', '1', 1, 0),
(3, 'SEO', '1,2', 1, 0);

CREATE TABLE IF NOT EXISTS `%PREFIX%users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'User Group ID',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `registerd` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `gid` (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Save Users main details' AUTO_INCREMENT=1111 ;

CREATE TABLE IF NOT EXISTS `%PREFIX%user_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `system` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Access Level' AUTO_INCREMENT=5 ;

INSERT INTO `%PREFIX%user_access` (`id`, `name`, `system`) VALUES
('1', 'Admin', 1),
('2', 'Manager', 1),
('3', 'Author', 1),
('4', 'Registered', 1);

CREATE TABLE IF NOT EXISTS `%PREFIX%user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Save User Groups' AUTO_INCREMENT=6 ;

INSERT INTO `%PREFIX%user_groups` (`id`, `name`, `access`, `system`) VALUES
(1, 'Administrators', 1, 1),
(2, 'Managers', 2, 1),
(3, 'Authors', 3, 1),
(4, 'Registered', 4, 1),
(5, 'Subscribers', 4, 0);

CREATE TABLE IF NOT EXISTS `%PREFIX%user_profiles` (
  `user_id` int(11) NOT NULL,
  `avatar` varchar(64) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `state` varchar(32) NOT NULL,
  `country` varchar(32) NOT NULL,
  `phone` varchar(16) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Save Users profile details';

CREATE TABLE IF NOT EXISTS `%PREFIX%visitors` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(128) NOT NULL,
  `is_browser` tinyint(1) NOT NULL,
  `is_mobile` tinyint(1) NOT NULL,
  `platform` varchar(32) NOT NULL,
  `device` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `browser_version` varchar(32) DEFAULT NULL,
  `page` varchar(255) NOT NULL,
  `refer` varchar(255) DEFAULT NULL,
  `logged` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Log all visits states' AUTO_INCREMENT=1 ;


ALTER TABLE `%PREFIX%access`
  ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`access_id`) REFERENCES `%PREFIX%access` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `%PREFIX%contents`
  ADD CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `%PREFIX%users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `%PREFIX%content_fields`
  ADD CONSTRAINT `content_fields_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `%PREFIX%content_field_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `%PREFIX%content_field_options`
  ADD CONSTRAINT `content_field_options_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `%PREFIX%content_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `%PREFIX%content_groups`
  ADD CONSTRAINT `content_groups_ibfk_1` FOREIGN KEY (`type`) REFERENCES `%PREFIX%content_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `%PREFIX%labels`
  ADD CONSTRAINT `labels_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `%PREFIX%users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `%PREFIX%settings`
  ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `%PREFIX%setting_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `%PREFIX%setting_groups`
  ADD CONSTRAINT `setting_groups_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `%PREFIX%setting_sections` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `%PREFIX%user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `%PREFIX%users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
