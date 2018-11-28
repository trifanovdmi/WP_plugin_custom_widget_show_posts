<?php
/*
Plugin Name: Views posts.
Description: Custom plugin for show post.
Version: 0.1
Author: Trifanov Dmitriy
*/
?>
<?php
if (preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) {
    die('You are not allowed to call this page directly.');
}

$currentDir = dirname(__FILE__);

define('WIDGET_ATTACHMENTS_DIR', $currentDir);
define('WIDGET_ATTACHMENTS_VERSION', '0.1');

$pluginName = plugin_basename(WIDGET_ATTACHMENTS_DIR);
$pluginUrl  = trailingslashit(WP_PLUGIN_URL . '/' . $pluginName);
$assetsUrl  = $pluginUrl . '/assets';


function widget_views_admin_init()
{
    if ( !function_exists('wp_enqueue_media') ) {

        function version_warning() {
            echo "
            <div class='updated fade'><p>".__('Please, update your WordPress to use Attach Files Widget. Minimum required version 3.5', 'ex_attachments_widget')."</p></div>
            ";
        }
        add_action('admin_notices', 'version_warning');

        return;
    }
    
}

function widget_views_widgets_init()
{
    include_once WIDGET_ATTACHMENTS_DIR  . '/WidgetViewsCustom.php';
    register_widget( 'WidgetViewsCustom' );
}

add_action('widgets_init', 'widget_views_widgets_init');

function widget_views_load_textdomain()
{
    load_plugin_textdomain( 'widget_views', false, dirname( plugin_basename( __FILE__ ) ) .'/languages/' );
}

add_action('plugins_loaded', 'widget_views_load_textdomain');