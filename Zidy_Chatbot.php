<?php
/**
 * @package Zidy_Chatbot
 */

/*
 * Plugin Name: Zidy_Chatbot
 * Version: 1.0.1
 * Description: Zidy Chatbot WordPress plugin. This plugin allows Zidy users to install the generated Zidy chatbot code onto their WordPress site to communicate with their clients via SMS text messages.
 * Author: Unify
 * Author URI: https://unifylink.com/
 */

namespace Zidy\webchat;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Zidy\webchat\Init' ) ):
abstract class Init{
    const DIR = __DIR__;
    const FILE = __FILE__;

    public static function init() {
        if ( function_exists( '__autoload' ) ) {
            spl_autoload_register( '__autoload' );
        }

        spl_autoload_register( [ __CLASS__, 'autoload' ] );

        if ( WP_DEBUG ) {
            add_action( 'init', 'flush_rewrite_rules', 1 );
        }
        
        self::actions();
    }

    private static function actions() {
        Admin::add_actions();
        Widget::add_actions();
    }

    public static function autoload( $class ) {
        if ( strpos( $class, 'Zidy\\webchat' ) === 0 ) {
            $file_name = str_replace( '\\', '/', $class );
            $file_name = preg_replace( '~^Zidy/webchat~', self::DIR . '/class', $file_name, 1 );
            $file_name = $file_name . '.php';

            if ( file_exists( $file_name ) ) {
                require_once( $file_name );
            }
        }
    }
}

Init::init();
endif;