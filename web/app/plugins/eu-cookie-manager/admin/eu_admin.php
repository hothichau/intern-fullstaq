<?php
class SBAdmin {
    public $settings;
    public $sb_lang;
    function __construct() { }
    
    function initialize() {
        $this->settings = array(           
            'basename'      => plugin_basename( __FILE__ ),
            'dir'           => plugin_dir_path( __FILE__ ),
            'url'           => plugin_dir_url( __FILE__ ),
            'template'      => plugin_dir_path( __FILE__ ).'/template',
            'capabilities' => 'edit_others_posts',
            'menu_position' => 15,
            'menu_page' => 'EU Cookie Manager',
            'menu_title' => 'EU Cookie Manager',
            'menu_slug' => 'eu-cookie-manager',
            'menu_icon' => '',
            'version'       => '1.0.2'
        );
        
        // process admin
        add_action('admin_init', array($this, 'sb_action_admin_init'));
        add_action('admin_menu', array($this, 'sb_show_cookie_options'));
        add_action('admin_enqueue_scripts', array($this, 'sb_admin_enqueue_script'));       
        add_filter( 'option_page_capability_sb_cookie_options', array($this, 'sb_settings_permissions'), 10, 1 );      
        
    }
    
    function sb_settings_permissions( $capability ) {
        return 'edit_others_posts';
    }
    function sb_set_plugin_load_last() {
        $wp_path_to_this_file = preg_replace('/(.)plugins\/(.)$/', WP_PLUGIN_DIR."/$2", __FILE__);
        $this_plugin = plugin_basename(trim($wp_path_to_this_file));
        $active_plugins = get_option('active_plugins');
        $this_plugin_key = array_search($this_plugin, $active_plugins);
        array_splice($active_plugins, $this_plugin_key, 1);
        array_push($active_plugins, $this_plugin);
        update_option('active_plugins', $active_plugins);
    }
    
    
    function sb_action_admin_init() {
        // check and update plugin version
        $version = get_plugin_data ( __FILE__ );
        $new_version = $this->settings['version'];        
        if ( version_compare($new_version,  get_option('sb_cookie_version') ) == 1 ) {       
            update_option( 'sb_cookie_version', $new_version );   
        }
        
        global $sitepress;   
        if(!isset($sitepress)) {
            $this->sb_lang = 'en';
        } else {
            $this->sb_lang = $sitepress->get_current_language();
        }
        
        // admin menu
        
        register_setting( 'sb_cookie_options', 'sb_cookie_data_'.$this->sb_lang );    
    } 
    
    // add js and call picker from WP
    function sb_admin_enqueue_script() {
        wp_enqueue_style( 'wp-color-picker' );       
        wp_enqueue_script( 'sb-cookies-custom', plugins_url('template/js/settings.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
    
    function sb_show_cookie_options() {
        add_menu_page($this->settings['menu_page'], $this->settings['menu_title'], $this->settings['capabilities'], $this->settings['menu_slug'], array($this,'sb_cookie_admin_layout'),  $this->settings['menu_icon'] , $this->settings['menu_position'] );
    }
    function sb_cookie_admin_layout() {     
        require $this->settings['template'].'/sb-admin.php';
    }
} // end class

function sb_admin_eucookie() {
    global $sb_admin_eucookie, $settings;   
    if ( ! isset( $sb_admin_eucookie ) ) {       
        $sb_admin_eucookie = new SBAdmin();
        $sb_admin_eucookie->initialize();
    }
    return $sb_admin_eucookie;
}

?>