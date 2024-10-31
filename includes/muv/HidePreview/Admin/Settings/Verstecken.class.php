<?php

namespace muv\HidePreview\Admin\Settings;

use \muv\HidePreview\Classes\DefaultSettings;


defined( 'ABSPATH' ) OR exit;


class Verstecken {

	
	public static function init() {
		
		add_action( 'admin_init', array( self::class, 'addSettingsVerstecken' ) );
	}

	
	public static function handleSettings() {
		
		echo '<form method="post" action="options.php">';

		
		settings_fields( 'muv-hp-settings-verstecken' );

		
		do_settings_sections( 'muv-hp-settings-verstecken' );

		
		submit_button();
	}

	
	public static function addSettingsVerstecken() {
		
		add_settings_section( 'muv-hp-verstecken-aktivieren', __( 'Verstecken aktivieren', 'muv-hide-preview' ), array(
			self::class,
			'sectionVersteckenAktivierenBeschreibung'
		), 'muv-hp-settings-verstecken' );

		
		add_settings_field( 'muv-hp-verstecken-aktivieren'
			, __( 'Verstecken aktivieren', 'muv-hide-preview' )
			, array( self::class, 'versteckenAktivierenHtml' )
			, 'muv-hp-settings-verstecken'
			, 'muv-hp-verstecken-aktivieren' );
		register_setting( 'muv-hp-settings-verstecken', 'muv-hp-verstecken-aktiv', array(
			self::class,
			'versteckenAktivierenValidate'
		) );

		
		add_settings_section( 'muv-hp-verstecken-bereiche-inkl', __( 'Zu versteckte Bereiche', 'muv-hide-preview' ), array(
			self::class,
			'sectionVersteckenBereicheInklBeschreibung'
		), 'muv-hp-settings-verstecken' );

		
		add_settings_field( 'muv-hp-verstecken-bereiche-inkl'
			, __( '(Teil-) URL', 'muv-hide-preview' )
			, array( self::class, 'versteckenBereicheInklHtml' )
			, 'muv-hp-settings-verstecken'
			, 'muv-hp-verstecken-bereiche-inkl' );
		register_setting( 'muv-hp-settings-verstecken', 'muv-hp-verstecken-bereiche-inkl', array(
			self::class,
			'versteckenBereicheInklValidate'
		) );

		
		add_settings_section( 'muv-hp-verstecken-bereiche-exkl', __( 'Anzuzeigende Bereiche', 'muv-hide-preview' ), array(
			self::class,
			'sectionVersteckenBereicheExklBeschreibung'
		), 'muv-hp-settings-verstecken' );

		
		add_settings_field( 'muv-hp-verstecken-bereiche-exkl'
			, __( '(Teil-) URL', 'muv-hide-preview' )
			, array( self::class, 'versteckenBereicheExklHtml' )
			, 'muv-hp-settings-verstecken'
			, 'muv-hp-verstecken-bereiche-exkl' );
		register_setting( 'muv-hp-settings-verstecken', 'muv-hp-verstecken-bereiche-exkl', array(
			self::class,
			'versteckenBereicheExklValidate'
		) );
	}

	
	public static function sectionVersteckenAktivierenBeschreibung() {
		
	}

	
	public static function versteckenAktivierenHtml() {
		$aktiv   = get_option( 'muv-hp-verstecken-aktiv', DefaultSettings::VERSTECKEN_AKTIV );
		$checked = checked( '1', $aktiv, false );
		echo '<label>';
		echo '<input name="muv-hp-verstecken-aktiv" type="checkbox" value="1" ' . $checked . '/>';
		echo __( 'Verstecken der nicht öffentlichen Bereiche aktivieren.', 'muv-hide-preview' );
		echo '</label>';
	}

	
	public static function versteckenAktivierenValidate( $wert ) {
		
		$check = (int) $wert;

		return $check;
	}

	
	public static function sectionVersteckenBereicheInklBeschreibung() {
		_e( 'Bitte geben Sie PRO ZEILE eine (Teil-) URL ein.<br>' .
		    'Endet die URL mit <code>*</code> so handelt es sich um eine Teil-URL, d.h. die aufgerufene URL muss mit dieser Teil-URL beginnen.<br>' .
		    '<br>Beispiel:' .
		    '<ul>' .
		    '<li>Die Eingabe von z.B. <code>/blog*</code> versteckt den Bereich <b>/blog</b> inkl. aller weiteren Unterbereiche</li>' .
		    '<li>Die Eingabe von z.B. <code>/</code> versteckt die Startseite, zeigt aber alle anderen Seiten an</li>' .
		    '</ul>' .
		    'Lassen Sie dieses Feld <b>leer</b>, um den <b>gesamten</b> Internet-Auftritt zu verstecken.<br>'
			, 'muv-hide-preview' );
	}

	
	public static function versteckenBereicheInklHtml() {
		$content = sanitize_textarea_field( get_option( 'muv-hp-verstecken-bereiche-inkl', DefaultSettings::VERSTECKEN_BEREICHE_INKL ) );
		echo '<textarea class="large-text code" rows="10" cols="50" name="muv-hp-verstecken-bereiche-inkl">' . $content . '</textarea>';
	}

	
	public static function versteckenBereicheInklValidate( $wert ) {
		$temp    = explode( "\n", sanitize_textarea_field( $wert ) );
		$content = '';
		
		foreach ( $temp as $zeile ) {
			$zeile = trim( $zeile );
			if ( ( strlen( $zeile ) > 0 ) && ( $zeile[0] !== '/' ) ) {
				$zeile = '/' . $zeile;
			}
			$content .= $zeile . PHP_EOL;
		}

		

		return $content;
	}

	
	public static function sectionVersteckenBereicheExklBeschreibung() {
		_e( 'Bitte geben Sie PRO ZEILE eine (Teil-) URL ein.<br>' .
		    'Die in diesem Feld eingegebenen (Teil-) URLs heben die im Feld "Zu versteckende Bereiche" eingegebenen (Teil-) URL wieder auf<br>' .
		    '<br>Beispiel:' .
		    '<ul>' .
		    '<li>Sollten Sie bei "Zu versteckende Bereiche" <code>/blog*</code> eingegeben haben und hier ' .
		    '<code>/blog/bereich1</code> so wird der gesamte Bereich <b>/blog</b> mit Ausnahme des Unterbereichs <b>/bereich1</b> ' .
		    'versteckt</li>' .
		    '<li>Sollten Sie bei "Zu versteckende Bereiche" <code>/*</code> eingegeben haben und hier ' .
		    '<code>/</code> so wird die Startseite angezeigt, aber alle anderen Seiten versteckt</li>' .
		    '</ul>'
			, 'muv-hide-preview' );
	}

	
	public static function versteckenBereicheExklHtml() {
		$content = sanitize_textarea_field( get_option( 'muv-hp-verstecken-bereiche-exkl', DefaultSettings::VERSTECKEN_BEREICHE_EXKL ) );
		echo '<textarea class="large-text code" rows="10" cols="50" name="muv-hp-verstecken-bereiche-exkl">' . $content . '</textarea>';
	}

	
	public static function versteckenBereicheExklValidate( $wert ) {
		$temp    = explode( "\n", sanitize_textarea_field( $wert ) );
		$content = '';
		
		foreach ( $temp as $zeile ) {
			$zeile = trim( $zeile );
			if ( ( strlen( $zeile ) > 0 ) && ( $zeile[0] !== '/' ) ) {
				$zeile = '/' . $zeile;
			}
			$content .= $zeile . PHP_EOL;
		}

		

		return $content;
	}


}
