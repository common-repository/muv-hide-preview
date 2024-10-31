<?php

namespace muv\HidePreview\Admin\Settings;


defined( 'ABSPATH' ) OR exit;


class Freischalten {

	
	public static function init() {
		
		add_action( 'admin_init', array( self::class, 'addSettings' ) );
		
		add_action( 'admin_menu', array( self::class, 'addAdminMenuItem' ) );
	}

	
	public static function addAdminMenuItem() {
		
		add_submenu_page( null, '', '', 'manage_options', 'muv-hp-anzeige-link-neu', array(
			self::class,
			'erzeugeNeuenFreischaltKey'
		) );
	}

	
	public static function erzeugeNeuenFreischaltKey() {
		
		check_admin_referer( 'muv-hp-anzeige-link-neu' );


		
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'Sie haben nicht das Recht, diese Seite zu sehen!', 'muv-minishop' ) );
		}

		
		update_option( 'muv-hp-freischalten-key', bin2hex( openssl_random_pseudo_bytes( 15 ) ), 'no' );

		
		wp_redirect( admin_url('admin.php?page=muv-hp-einstellungen&tab=freischalten&nk=1') );
		exit;
	}

	
	public static function handleSettings() {
		echo '<form method="post" action="options.php">';

		
		settings_fields( 'muv-hp-settings-freischalten' );
		
		do_settings_sections( 'muv-hp-settings-freischalten' );
		
		
		echo '</form>';
	}

	
	public static function addSettings() {
		
		add_settings_section( 'muv-hp-freischalten-link', __( 'Freischalt-Link', 'muv-hide-preview' ), array(
			self::class,
			'sectionFreischaltLinkBeschreibung'
		), 'muv-hp-settings-freischalten' );
	}

	
	public static function sectionFreischaltLinkBeschreibung() {
		echo __( 'Nach dem Aufrufen des folgenden Freischalt-Link ist der Zugriff auf alle versteckten Bereiche möglich.<br>' .
		         'Geben Sie deshalb diesen Link nur an die Personen weiter, die ihre versteckten Bereiche sehen sollen.', 'muv-hide-preview' );
		echo '<br><br>';
		echo '<input readonly type="text" class="gross" value="' .
		     esc_url( get_bloginfo( 'url' ) ) . '/muv-hide-preview/freischalten/' . esc_html( get_option( 'muv-hp-freischalten-key', '' ) ) .
		     '">';
		
		echo '<br><br><a href="' . wp_nonce_url( admin_url( 'admin.php?page=muv-hp-anzeige-link-neu&noheader=true'), 'muv-hp-anzeige-link-neu' ) .
		     '" class="button"><i class="fa fa-refresh"> </i> ' .
		     __( 'Freischalt-Link neu erstellen', 'muv-hide-preview' ) . '</a><br><br>';
	}

}
