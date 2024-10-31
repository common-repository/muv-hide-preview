<?php


defined( 'ABSPATH' ) OR exit;

use muv\HidePreview\Classes\DefaultSettings;






add_option( 'muv-hp-verstecken-aktiv', DefaultSettings::VERSTECKEN_AKTIV );


add_option( 'muv-hp-verstecken-bereiche-inkl', DefaultSettings::VERSTECKEN_BEREICHE_INKL );
add_option( 'muv-hp-verstecken-bereiche-exkl', DefaultSettings::VERSTECKEN_BEREICHE_EXKL );


add_option( 'muv-hp-freischalten-key', bin2hex( openssl_random_pseudo_bytes( 15 ) ), false, 'no' );

