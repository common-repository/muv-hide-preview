<?php

namespace muv\HidePreview\Frontend;


defined( 'ABSPATH' ) OR exit;


class Freischalten {

	
	public static function init() {
		add_action( 'init', array( self::class, 'addEndpoints' ) );
	}

	
	public static function addEndPoints() {
		
		add_filter( 'template_redirect', array( self::class, 'endpointDoFreischalten' ) );
	}

	
	public static function endpointDoFreischalten() {

		global $wp;

		
		if ( strpos( $wp->request, 'muv-hide-preview/freischalten/' ) !== 0 ) {
			return;
		}

		
		$tmp    = explode( '/', $wp->request );
		$keyIst = $tmp[2]; 
		$keySoll = get_option( 'muv-hp-freischalten-key', '' );
		
		if ( empty( $keySoll ) ) {
			wp_redirect( '/' );
			exit;
		}

		
		if ( $keyIst !== $keySoll ) {
			wp_redirect( '/' );
			exit;
		}

		
        if ( ! session_id() ) {
            session_start();
        }
		$_SESSION['muv-hp-freischalten'] = true;

		
		wp_redirect( '/' );
		exit;
	}
}
