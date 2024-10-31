<?php

namespace muv\HidePreview\Admin;


defined( 'ABSPATH' ) OR exit;


class Main {

	
	public static function init() {
		
		Settings::init();

		
		add_action( 'admin_menu', array( self::class, 'addAdminMenuItem' ) );

		
		add_action( 'admin_print_scripts', array( self::class, 'adminScriptsMuVBackend' ) );
	}

	
	public static function addAdminMenuItem() {
		

		
		add_menu_page( __( 'muv Hide Preview', 'muv-hide-preview' ), __( 'muv Hide Preview', 'muv-hide-preview' ), 'manage_options', 'muv-hide-preview', array(
			self::class,
			''
		), MUV_HP_URL . '/assets/img/logo.png', 1302 );

		

		
		add_submenu_page( 'muv-hide-preview', __( 'Einstellungen', 'muv-hide-preview' ), __( 'Einstellungen', 'muv-hide-preview' ), 'manage_options', 'muv-hp-einstellungen', array(
			Settings::class,
			'handleSettings'
		) );

		
		remove_submenu_page( 'muv-hide-preview', 'muv-hide-preview' );
	}

	
	public static function adminScriptsMuVBackend() {
		$screen = get_current_screen();

		
        if ( strpos( $screen->id, '_page_muv-hp' ) !== false ) {
            
            wp_enqueue_style('muv-fa5', MUV_HP_URL . '/vendor/public/font-awesome/css/all.min.css');
        }
		
				
		
		
		if ( strpos( $screen->id, '_page_muv-hp' ) !== false ) {
			
			wp_enqueue_style( 'muv-hp-admin', MUV_HP_URL . '/assets/css/admin.min.css' );
			
			wp_enqueue_script( 'muv-hp-admin', MUV_HP_URL . '/assets/js/admin.js', array( 'jquery' ), false, true );
		}
	}

}
