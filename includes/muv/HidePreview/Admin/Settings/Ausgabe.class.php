<?php

namespace muv\HidePreview\Admin\Settings;

use Guzzle\Service\Exception\DescriptionBuilderException;
use muv\HidePreview\Classes\DefaultSettings;


defined( 'ABSPATH' ) OR exit;


class Ausgabe {

    
    private static $typ = 0;

	
	public static function init() {
				add_action( 'admin_init', array( self::class, 'addSettings' ) );
	}

	
	public static function handleSettings() {
		echo '<form method="post" action="options.php">';

				settings_fields( 'muv-hp-settings-ausgabe' );
				do_settings_sections( 'muv-hp-settings-ausgabe' );
				submit_button();

		echo '</form>';
	}

	
	public static function addSettings() {
		
		add_settings_section( 'muv-hp-ausgabe', __( 'Auszugebende Seite', 'muv-hide-preview' ),
			array( self::class, 'sectionAusgabeSeiteBeschreibung' ), 'muv-hp-settings-ausgabe' );

		add_settings_field( 'muv-hp-ausgabe-typ', __( 'Typ der Ausgabe', 'muv-hide-preview' ),
			array( self::class, 'ausgabeTypHtml' ), 'muv-hp-settings-ausgabe', 'muv-hp-ausgabe' );
        register_setting( 'muv-hp-settings-ausgabe', 'muv-hp-ausgabe-typ', array( self::class, 'ausgabeTypValidate' ) );

		
        add_settings_field( 'muv-hp-ausgabe-seite', __( 'Auszugebende interne Seite', 'muv-hide-preview' ),
            array( self::class, 'ausgabeSeiteHtml' ), 'muv-hp-settings-ausgabe', 'muv-hp-ausgabe' );
        register_setting( 'muv-hp-settings-ausgabe', 'muv-hp-ausgabe-seite', array( self::class, 'ausgabeSeiteValidate' ) );

	}

	
	public static function sectionAusgabeSeiteBeschreibung() {
		_e( 'Hier können Sie festlegen, was anstelle Ihrer zu versteckenden Bereiche angezeigt werden soll.', 'muv-hide-preview' );
	}

	
	public static function ausgabeTypHtml() {
		$val = (int) ( get_option( 'muv-hp-ausgabe-typ', DefaultSettings::AUSGABE_TYP ) );
		echo '<select name="muv-hp-ausgabe-typ" id="muv-hp-ausgabe-typ">';
		echo '<option value="1"' . selected( $val, 1 ) . '>' . __( 'Plugin-Seite', 'muv-hide-preview' ) . '</option>';
		echo '<option value="2"' . selected( $val, 2 ) . '>' . __( 'Leere Seite', 'muv-hide-preview' ) . '</option>';
		echo '<option value="3"' . selected($val, 3) . '>' . __('Interne Seite', 'muv-hide-preview') . '</option>';
		
		echo '</select>';
	}

    
    public static function ausgabeSeiteHtml() {
        
        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'exclude' => '',
            'include' => '',
            'meta_key' => '',
            'meta_value' => '',
            'authors' => '',
            'child_of' => 0,
            'parent' => -1,
            'exclude_tree' => '',
            'number' => '',
            'offset' => 0,
            'post_type' => 'page',
            'post_status' => 'publish');
        $seiten = get_pages($args);

        
        $val = (int) ( get_option( 'muv-hp-ausgabe-seite', -1 ) );

        
        $val = DefaultSettings::TesteSeitenId($val);

        
        echo '<select name="muv-hp-ausgabe-seite" id="muv-hp-ausgabe-seite">';
        foreach($seiten as $s) {
            echo '<option value="' . (int)$s->ID . '"' . selected($val, $s->ID) . '>' . esc_html($s->post_title) . '</option>';
        }
        echo '</select>';
        echo "<br><br>";
        echo "<small>ACHTUNG! die von Ihnen ausgewählte <code>interne Seite</code> wird <b>immer</b> angezeigt. Auch dann, wenn Sie - laut Ihren Einstellungen - " .
            "eigentlich versteckt werden sollte.<br>" .
            "<b>Beispiel:</b><br>Sie wollen die Startseite verstecken, geben aber <b>gleichzeitig</b> als <code>interne Seite</code> die Startseite an. " .
            "In diesem Fall wird die Startseite trotzdem ausgegeben.";

        
        echo '<script>';
        echo 'function muv_hp_HideAuswabeSeite() {';
        echo "var typ = jQuery('#muv-hp-ausgabe-typ').val();";
        echo "if (typ != 3) {";
        echo "jQuery('#muv-hp-ausgabe-seite').closest('tr').hide();";
        echo "}else {";
        echo "jQuery('#muv-hp-ausgabe-seite').closest('tr').show();";
        echo '}';
        echo '}';
        echo 'muv_hp_HideAuswabeSeite();';
        echo '';
        echo "jQuery('#muv-hp-ausgabe-typ').on('change', function() {";
        echo "muv_hp_HideAuswabeSeite();";
        echo "});";
        echo '</script>';
    }

	
	public static function ausgabeTypValidate( $wert ) {
	    
		self::$typ = (int) ( $wert );
		if ( empty( self::$typ ) ) {
			
            self::$typ = DefaultSettings::AUSGABE_TYP;
			add_settings_error( 'muv-hp-ausgabe-typ'
				, 'muv-hp-ausgabe-typ'
				, __( 'Bitte geben Sie den Typ der Ausgabe an.', 'muv-hide-preview' ) );
		}

		return self::$typ;
	}

    
    public static function ausgabeSeiteValidate( $wert ) {
        
        if (self::$typ != 3){
            return -1;
        }

        
        $seiteSoll = (int) ( $wert );
        $seiteIst = DefaultSettings::TesteSeitenId($seiteSoll);
        if ( $seiteIst != $seiteSoll ) {
            
            add_settings_error( 'muv-hp-ausgabe-typ'
                , 'muv-hp-ausgabe-typ'
                , __( 'Bitte geben Sie eine existierende  Seite an.', 'muv-hide-preview' ) );
        }

        return $seiteIst;
    }

}
