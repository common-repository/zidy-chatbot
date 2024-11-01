<?php
namespace Zidy\webchat;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

abstract class Widget{
    static function add_actions(){
        add_action('wp_footer', [ __CLASS__, 'add_widget' ] );
    }

    static function add_widget(){
        if ( is_feed() || is_robots() || is_trackback() ) {
            return;
        }

        $options = get_option('zidy_webchat_options');
         if( !empty( $options ) && $options['enabled'] == 1 && !empty($options['widget_code'] ) ){
            $script_dom = new \DOMDocument();
            $script_dom->loadHTML('<html>'.$options['widget_code'].'</html>');
            foreach($script_dom->getElementsByTagName('script') as $script) {
                if ( !empty( $script->getAttribute('data-origin-id') ) && !empty( $script->getAttribute('src') ) && !empty( $script->getAttribute('data-client-id') ) ) {
                        echo '<script defer src="' . esc_url_raw($script->getAttribute('src')) . '" data-origin-id="' . esc_attr($script->getAttribute('data-origin-id')) . '" data-client-id="' . esc_attr($script->getAttribute('data-client-id')) . '"/></script>';
                }
            }
        }
    }
}