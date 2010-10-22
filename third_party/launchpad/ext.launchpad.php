<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 * 
 * @package		launchpad
 * @subpackage	ThirdParty
 * @category	Extension
 * @author      bjorn	
 * @since       18.okt.2010 20:09:48
 * @link		 
 */ 
class launchpad_ext {

    var $settings        = array();
    
    var $name            = 'LaunchPad';
    var $version         = '1.0.0';
    var $description     = '';
    var $settings_exist  = 'n';
    var $docs_url        = '';

    /**
     * @var Devkit_code_completion
     */
    public $EE;    

	public function __construct($settings='')
	{
		$this->EE =& get_instance();
		$this->settings = $settings;													
    }
    
    
    
	/**
	 * Settings
	 */
	function settings()
	{

	}

    
	
	/**
	 * Update the extension
	 * 
	 * @param $current current version number
	 * @return boolean indicating whether or not the extension was updated 
	 */
	function update_extension($current='')
	{    
	    if ($current == '' OR $current == $this->version)
	    {
	        return FALSE;
	    }
	    
	    return FALSE;
	    // update code if version differs here
	}
		
	/**
	 * Disable the extention
	 * 
	 * @return unknown_type
	 */    
	function disable_extension()
	{		
		//
		// Remove added hooks
		//
		$this->EE->db->delete('extensions', array('class'=>get_class($this)));
			
	}
		

    /**
     * Activate the extension
     * 
     * This funciton is run on install and will register all hooks and
     * add custom member fields.
     * 
     */
	function activate_extension()
	{
		
		 // -------------------------------------------------
		 // Resiter the hooks needed for this extension 
		 // -------------------------------------------------
		 
		$register_hooks = array(			
			'sessions_start' => 'on_sessions_start',
		);
		
		$class_name = get_class($this);
		foreach($register_hooks as $hook => $method)
		{
			$data = array(                                        
				'class'        => $class_name,
				'method'       => $method,
				'hook'         => $hook,
				'settings'     => "",
				'priority'     => 10,
				'version'      => $this->version,
				'enabled'      => "y"
			);
			$this->EE->db->insert('extensions', $data); 	
		}
		
	}

	//
	// HOOKS
	//

    public function on_sessions_start($ref)
    {
        $this->EE->output = new Launchpad_Output();
    }


}
// END CLASS


/**
 * Get rid of the EE message templates
 */
class Launchpad_Output extends EE_Output
{
    private $err = FALSE;

	function show_user_error($type = 'submission', $errors, $heading = '')
	{
        $this->err = TRUE;
        parent::show_user_error($type, $errors, $heading );
	}


	function show_message($data, $xhtml = TRUE)
	{
		$EE =& get_instance();
        if(!isset($EE->TMPL))
        {
            $EE->load->library('template');
            $EE->TMPL = new EE_Template();
        }

        if(isset($data['link']))
        {
            $data['link_url'] = $data['link'][0];
            $data['link_text'] = $data['link'][1];
        }

        if($this->err)
        {
            $EE->TMPL->run_template_engine('launchpad', 'error');
        }
        else
        {
            $EE->TMPL->run_template_engine('launchpad', 'message');
        }
        
        parent::set_output($EE->TMPL->parse_variables(parent::get_output(), array($data)));
	}
}



/* End of file ext.launchpad.php */ 
/* Location: ./system/expressionengine/third_party//ext.launchpad.php */ 