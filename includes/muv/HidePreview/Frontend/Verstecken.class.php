<?php

namespace muv\HidePreview\Frontend;

use muv\HidePreview\Classes\DefaultSettings;


defined( 'ABSPATH' ) OR exit;


class Verstecken {

	
	public static function init() {
		
		$aktiv = get_option( 'muv-hp-verstecken-aktiv', DefaultSettings::VERSTECKEN_AKTIV );
		if ( $aktiv && ( ! current_user_can( 'manage_options' ) ) ) {
			add_action( 'template_redirect', array( self::class, 'versteckeInhalt' ) );
		}
	}

	
	public static function versteckeInhalt() {
		global $wp;

		if ( ! isset( $wp->request ) ) {
			return;
		}

        
        if ( ! session_id() ) {
            session_start();
        }
        if ( isset( $_SESSION['muv-hp-freischalten'] ) && ( $_SESSION['muv-hp-freischalten'] === true ) ) {
            return;
        }


        
        $typ = (int) ( get_option( 'muv-hp-ausgabe-typ', DefaultSettings::AUSGABE_TYP ) );

        
        $seiteId = -1;
        if ($typ == 3){
            $seiteId = (int) ( get_option( 'muv-hp-ausgabe-seite', -1 ) );
            $seiteId = DefaultSettings::TesteSeitenId($seiteId);
        }

        
		if (( $typ == 3) && (get_the_id() === $seiteId )) {
			return;
		}

        
        if ( strpos( $wp->request, 'muv-hide-preview/freischalten/' ) === 0 ) {
            return;
        }

		
		$versteckenUrlsString = trim( get_option( 'muv-hp-verstecken-bereiche-inkl', DefaultSettings::VERSTECKEN_BEREICHE_INKL ) );
		$verstecken           = false;

		
		if ( empty( $versteckenUrlsString ) ) {
			$verstecken = true;
		} else {
			$versteckenUrls = explode( "\n", $versteckenUrlsString );

			
			foreach ( $versteckenUrls as $url ) {
				$url = trim( $url );
				if ( ! empty( $url ) ) {
					
					if ( ( $url[ strlen( $url ) - 1 ] === '%' ) || ( $url[ strlen( $url ) - 1 ] === '*' ) ) {
						$url = substr( $url, 0, ( strlen( $url ) - 1 ) ); 						if ( strpos( '/' . $wp->request, $url ) === 0 ) {
							$verstecken = true;
						}
					} else {
						
						if ( ( '/' . $wp->request === $url ) || ( '/' . $wp->request . '/' === $url ) ) {
							$verstecken = true;
						}
					}
					if ( $verstecken ) {
						break; 					}
				}
			}
		}

		
		if ( ! $verstecken ) {
			return;
		}

		
		$zeigenUrls = explode( "\n", get_option( 'muv-hp-verstecken-bereiche-exkl', DefaultSettings::VERSTECKEN_BEREICHE_EXKL ) );
		foreach ( $zeigenUrls as $url ) {
			$url = trim( $url );
			if ( ! empty( $url ) ) {
				
				if ( ( $url[ strlen( $url ) - 1 ] === '%' ) || ( $url[ strlen( $url ) - 1 ] === '*' ) ) {
					$url = substr( $url, 0, ( strlen( $url ) - 1 ) ); 					if ( strpos( '/' . $wp->request, $url ) === 0 ) {
						$verstecken = false;
						break; 					}
				} else {
					
					if ( ( '/' . $wp->request === $url ) || ( '/' . $wp->request . '/' === $url ) ) {
						$verstecken = false;
					}
				}
				if ( ! $verstecken ) {
					break; 				}
			}
		}

		
		if ( ! $verstecken ) {
			return;
		}

		
		if ( ! defined( 'DONOTCACHEPAGE' ) ) {
			define( 'DONOTCACHEPAGE', true );
		}
		if ( ! defined( 'DONOTCDN' ) ) {
			define( 'DONOTCDN', true );
		}
		if ( ! defined( 'DONOTCACHEDB' ) ) {
			define( 'DONOTCACHEDB', true );
		}
		if ( ! defined( 'DONOTMINIFY' ) ) {
			define( 'DONOTMINIFY', true );
		}
		if ( ! defined( 'DONOTCACHEOBJECT' ) ) {
			define( 'DONOTCACHEOBJECT', true );
		}

		
		$typ = (int) ( get_option( 'muv-hp-ausgabe-typ', DefaultSettings::AUSGABE_TYP ) );


		
        header( 'Retry-After: 60' );
        header( 'Cache-Control: max-age=0; private' );


        
		if ( $typ == 3 ) {
            wp_redirect(get_page_link($seiteId), 302);
            exit();
        }

        
        header( 'HTTP/1.1 503 Service Temporarily Unavailable' );
        header( 'Status: 503 Service Temporarily Unavailable' );

        
        if ( $typ == 1 ) {
			
			$templateName = 'Frontend/verstecken.tpl.php';
			$templateFile = locate_template( [ $templateName, '/muv-hide-preview/' . $templateName ] );

			
			if ( empty( $templateFile ) ) {
				$templateFile = MUV_HP_DIR . '/templates/' . $templateName;
			}

			require $templateFile;
            exit();
		}

        
        if ($typ == 2) {
			echo( '<!DOCTYPE html><html><head></head><body>' .
			      '<!-- Dieser Bereich ist geschützt durch muv hide-preview https://muv.com/produkte/hide-preview -->' .
			      '</body></html>' );
            exit();
		}
	}

}
