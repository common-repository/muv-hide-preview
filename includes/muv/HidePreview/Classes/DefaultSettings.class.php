<?php

namespace muv\HidePreview\Classes;


defined( 'ABSPATH' ) OR exit;


class DefaultSettings {
			
	
	const VERSTECKEN_AKTIV = 0;
	
	const VERSTECKEN_BEREICHE_INKL = '';
	const VERSTECKEN_BEREICHE_EXKL = '';

				

				
	const AUSGABE_TYP = 1; 
    
    public static function TesteSeitenId($seitenId){
        
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

        
        if ($seitenId != -1){
            $existiert = false;
            foreach ($seiten as $s) {
                if ($s->ID == $seitenId){
                    $existiert = true;
                    
                    break;
                }
            }
            if (!$existiert){
                $seitenId = -1;
            }
        }

        
        if ($seitenId == -1) {
            $seitenId = 9999999999999999;
            foreach ($seiten as $s) {
                if ($s->ID < $seitenId) {
                    $seitenId = $s->ID;
                }
            }
        }

        return $seitenId;
    }


}
