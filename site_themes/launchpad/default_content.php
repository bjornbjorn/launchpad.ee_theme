<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

$theme_name = 'launchpad';

$orig_image_path = $this->userdata['image_path'];
$this->userdata['image_path'] = str_replace(SYSDIR.'/', '', BASEPATH).'images/';

// Add upload locations
$Q[] = "INSERT INTO `exp_upload_prefs` (`id`, `site_id`, `name`, `server_path`, `url`, `allowed_types`, `max_size`, `max_height`, `max_width`, `properties`, `pre_format`, `post_format`, `file_properties`, `file_pre_format`, `file_post_format`) VALUES
(1, 1, 'Main Upload Directory', '".$this->userdata['image_path'].$this->userdata['upload_folder']."', '".$this->userdata['site_url'].'images/'.$this->userdata['upload_folder']."', 'all', '', '', '', 'style=\"border: 0;\" alt=\"image\"', '', '', '', '', ''),
(2, 1, '".$theme_name." uploads', '".$this->theme_path.$theme_name."/images/uploads/', '".$this->userdata['site_url']."themes/site_themes/".$theme_name."/images/uploads/', 'img', '', '', '', '', '', '', '', '', '')";

@chmod($this->theme_path.$theme_name."/images/uploads/", DIR_WRITE_MODE);

// @confirm: now set it back
$this->userdata['image_path'] = $orig_image_path;

foreach ($Q as $sql)
{
	$this->db->query($sql);
}

// Set strict 404 settings
$this->config->update_site_prefs(array(
										'strict_urls'	=> 'n',
										'use_category_name' => 'y',				// use category names in url's (eg. /blog/freelancing/)
										'allow_extensions' => 'y',
									   ),
								1 // site id
								);



// hooks / extensions
$register_hooks = array(
'sessions_start' => array('launchpad_ext', 'on_sessions_start', ''),
);

foreach($register_hooks as $hook => $ext)
{
	$data = array(
		'class'        => $ext[0],
		'method'       => $ext[1],
		'hook'         => $hook,
		'settings'     => $ext[2],
		'priority'     => 10,
		'version'      => '1',
		'enabled'      => "y"
	);
	$this->db->insert('extensions', $data);
}

/* End of file default_content.php */
/* Location: ./themes/site_themes/LaunchPad/default_content.php */