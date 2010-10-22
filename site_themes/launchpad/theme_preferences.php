<?php

// --------------------------------------------------------------------

error_reporting(E_ALL);

/**
 * Required modules
 */

// 'channel', 'member', 'stats' are already required by the system
$required_modules = array("pages", "launchpad" "mailinglist", "rss", "comment", "search", "stats", "emoticon");

// --------------------------------------------------------------------

/**
 * Optional Values, Used for a Fresh Site
 */

$default_group = 'launchpad';

// --------------------------------------------------------------------

/**
 * Default Preferences and Access Permissions for all Templates
 */

$default_template_preferences = array('caching'			=> 'n',
									  'cache_refresh'	=> 0,
									  'php_parsing'		=> 'none', // none, input, output
									  );

// Uses the Labels of the default four groups, as it is easier than the Group IDs, let's be honest
$default_template_access = array('Banned' 	=> 'n',
								 'Guests'	=> 'y',
								 'Pending'	=> 'y');

// --------------------------------------------------------------------

/**
 * Template Specific Preferences and Settings
 */

// $template_preferences['news']['index'] = array('caching' => 'y', 'cache_refresh' => 60);

$no_access = array(
					'Banned'	=> 'n',
					'Guests'	=> 'n',
					'Members'	=> 'n',
					'Pending'	=> 'n'
					);

$template_access['global_embeds']['index'] = $no_access;
$template_access['search']['index'] = $no_access;
				

/* End of file theme_preferences.php */
/* Location: ./themes/site_themes/coffeebreak
* /theme_preferences.php */