<?php
namespace Zidy\webchat;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

abstract class Admin{
    static function add_actions(){
        add_action( 'activated_plugin',[ __CLASS__, 'activated_plugin' ], 10, 2 );
        add_action( 'deactivated_plugin', [ __CLASS__,'deactivated_plugin' ], 10, 2 );
        add_action( 'admin_menu', [ __CLASS__,'admin_menu' ] );
        add_action( 'admin_init', [ __CLASS__, 'register_settings' ] );
    }

    static function deactivated_plugin() {}

    static function activated_plugin() {}

    static function uninstall() {
        delete_option( 'zidy_webchat_options' );
    }

    static function register_settings(){
        register_setting( 'zidy_webchat_options_group', 'zidy_webchat_options' );
    }

    static function admin_menu(){
        add_options_page('Zidy Webchat Options', 'Zidy Webchat', 'activate_plugins', 'zidy-webchat-options', function(){
            include_once(Init::DIR.'/templates/admin.php');
        });
    }
}