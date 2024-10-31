<?php

namespace muv\HidePreview\Admin\Settings;


defined( 'ABSPATH' ) OR exit;


class Hinweis {

	
	public static function init() {
		
	}

	
	public static function zeigeHinweis() {
		echo '<br>';
		echo '<br>';
		echo '<b>' . __( 'Bitte beachten Sie!', 'muv-hide_preview' ) . '</b><br>';
		echo __( 'Sobald Sie das Verstecken aktiviert haben, können nur noch freigeschaltete Besucher die von Ihnen versteckten Seiten / Bereiche einsehen.', 'muv-hide_preview' ) . '<br>';
		echo __( 'Besucher erhalten dadurch eine Freischaltung für die versteckten Seiten, dass Sie den unter "Anzeige freischalten" angezeigten Freischalt-Link aufrufen.', 'muv-hide-preview' ) . '<br>';
		echo '<br>';
		echo '<br>';
		echo __( 'Das Aufrufen des gesamten Admin-Bereichs, sowie der Login in den Admin-Bbereich sind jederzeit möglich.', 'muv-hide-preview' ) . '<br>';
		echo '<b>' . __( 'AJAX-Requests, REST-Aufrufe und sonstige Seiten-Aufrufe "ohne Ausgabe" werden ebenfalls nicht versteckt!', 'muv-hide_preview' ) . '</b><br>';
		echo '<br>';
		echo '<br>';
		echo '<div class="alert alert-danger">';
		echo __( 'Wichtiger Hinweis!', 'muv-hide-preview' );
		echo '<br>';
		echo __( 'Um die Erstellung neuer Seiten zu vereinfachen, können angemeldete Administratoren sämtliche Seiten / Bereiche einsehen ohne ' .
		         'vorher den Freischalt-Link aufrufen zu müssen.', 'muv-hide-preview' );
		echo '<br>';
		echo '<br>';
		echo __( 'Testen Sie deshalb Ihre Einstellungen immer als nicht angemeldeter Benutzer!', 'muv-hide-preview' );
		echo '</div>';
	}
}
