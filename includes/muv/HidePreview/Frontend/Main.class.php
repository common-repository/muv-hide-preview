<?php

namespace muv\HidePreview\Frontend;


defined( 'ABSPATH' ) OR exit;


class Main {

	
	public static function init() {

		
		Freischalten::init();
		Verstecken::init();

		
		add_action( 'wp_enqueue_scripts', array( self::class, 'enqueueScripts' ) );
	}

	public static function enqueueScripts() {
				
	}

}
