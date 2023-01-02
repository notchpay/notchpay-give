<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Give
 * @subpackage Gateways
 * @author     Chapdel KAMGA<chapdel@notchpay.co>
 * @license    https://opensource.org/licenses/gpl-license GNU Public License
 * @link       https://notchpay.co
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    NotchPay_Give
 * @subpackage Gateways
 * @author     Chapdel <chapdel@notchpay.co>
 */
class NotchPay_Give_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since 1.0.0
     * @param string $plugin_name The name of this plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) 
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_filter( 'give_get_sections_gateways', [ $this, 'register_sections' ] );
        add_filter( 'give_get_settings_gateways', [ $this, 'register_settings' ] );
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_styles() 
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in NotchPay_Give_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The NotchPay_Give_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/notchpay-give-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since 1.0.0
     */
    public function enqueue_scripts() 
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in NotchPay_Give_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The NotchPay_Give_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/notchpay-give-admin.js', array( 'jquery' ), $this->version, false);

    }

    public function add_plugin_admin_menu() 
    {

        /*
        * Add a settings page for this plugin to the Settings menu.
        *
        * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
        *
        *        Administration Menus: http://codex.wordpress.org/Administration_Menus
        *
        */
        
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since 1.0.0
     */

    public function add_action_links( $links ) 
    {
        /*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
        $settings_link = array(
        '<a href="' . admin_url('edit.php?post_type=give_forms&page=give-settings&tab=gateways&section=notchpay') . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge($settings_link, $links);

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since 1.0.0
     */

    public function display_plugin_setup_page() 
    {
        include_once 'partials/notchpay-give-admin-display.php';
    }

    /**
     * Register Admin Section.
     *
     * @param array $sections List of sections.
     *
     * @since  1.2.1
     * @access public
     *
     * @return array
     */
    public function register_sections( $sections ) {
        $sections['notchpay'] = esc_html__( 'Notch Pay', 'notchpay-give' );

        return $sections;
    }

    /**
     * Register Admin Settings.
     *
     * @param array $settings List of settings.
     *
     * @since  1.0.0
     * @access public
     *
     * @return array
     */
    public function register_settings( $settings ) {
        $current_section = give_get_current_setting_section();

        switch ( $current_section ) {
            case 'notchpay':
                $settings = [
                    [
                        'type' => 'title',
                        'id'   => 'give_title_gateway_settings_notchpay',
                    ],
                    [
                        'name' => esc_html__( 'Notch Pay', 'notchpay-give' ),
                        'desc' => '',
                        'type' => 'give_title',
                        'id'   => 'give_title_notchpay',
                    ],
                    [
                        'name'        => esc_html__( 'Sandbox Public Key', 'notchpay-give' ),
                        'desc'        => esc_html__( 'Enter your Notch Pay Test Public Key', 'notchpay-give' ),
                        'id'          => 'notchpay_test_public_key',
                        'type'        => 'password',
                        'row_classes' => 'give-notchpay-test-public-key',
                    ],
                    [
                        'name'        => esc_html__( 'Live Public Key', 'notchpay-give' ),
                        'desc'        => esc_html__( 'Enter your Notch Pay Live Public Key', 'notchpay-give' ),
                        'id'          => 'notchpay_live_public_key',
                        'type'        => 'password',
                        'row_classes' => 'give-notchpay-live-public-key',
                    ],
                    [
                        'name'    => esc_html__( 'Billing Details', 'notchpay-give' ),
                        'desc'    => esc_html__( 'This is not required by Notch Pay (except email)', 'notchpay-give' ),
                        'id'      => 'notchpay_billing_details',
                        'type'    => 'hidden',
                        'default' => 'disabled',
                    ],
                    [
                        'type' => 'sectionend',
                        'id'   => 'give_title_gateway_settings_notchpay',
                    ]
                ];
                break;
        }
        return $settings;
    }
}
