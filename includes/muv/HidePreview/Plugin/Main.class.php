<?php

namespace muv\HidePreview\Plugin;


defined( 'ABSPATH' ) OR exit;


class Main {

	
	public static function init() {
        if ( is_admin() ) {
			\muv\HidePreview\Admin\Main::init();
		} else {
			\muv\HidePreview\Frontend\Main::init();
		}
	}

}
