<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link    https://notchpay.co
 * @since   1.0.0
 * @package NotchPay_Give
 *
 * @wordpress-plugin
 * Plugin Name:       Notch Pay for Give
 * Plugin URI:        http://wordpress.org/plugins/notchpay-give
 * Description:       Notch Pay integration for accepting donation with local payments and mobile money
 * Version:           1.0.1
 * Author:            Notch Pay
 * Author URI:        https://notchpay.co
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       notchpay-give
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('NP_GIVE_PLUGIN_NAME_VERSION', '2.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-notchpay-give-activator.php
 */
function activate_notchpay_give()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-notchpay-give-activator.php';
    NotchPay_Give_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-notchpay-give-deactivator.php
 */
function deactivate_notchpay_give()
{
    include_once plugin_dir_path(__FILE__) . 'includes/class-notchpay-give-deactivator.php';
    NotchPay_Give_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_notchpay_give');
register_deactivation_hook(__FILE__, 'deactivate_notchpay_give');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-notchpay-give.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_notchpay_give()
{

    $plugin = new NotchPay_Give();
    $plugin->run();
}
run_notchpay_give();
