<?php

    $manifest =array(
    	'acceptable_sugar_flavors' => array(0 => 'CE',1 => 'PRO',2 => 'ENT',), 
        'acceptable_sugar_versions' => array(
            'regex_matches' => array(0 => '6\.*'),
        ),
        'author' => 'Accusoft',
        'description' => 'Installs the Accusoft ACS Viewer',
        'icon' => '',
        'is_uninstallable' => true,
        'name' => 'Accusoft ACS Viewer Installer', 
        'published_date' => '2015-05-22',
        'type' => 'module',
        'version' => '0.1',        
    );
    
    $installdefs =array(
        'id' => 'package_acs_viewer',
        'copy' => array(
            0 => array( 
                'from' => '<basepath>/acsApiKey.php',
                'to' => 'custom/modules/Accusoft/acsApiKey.php',
            ),
            1 => array( 
                'from' => '<basepath>/modules/acsViewerParams.php',
                'to' => 'custom/modules/Accusoft/acsViewerParams.php',
            ),
            2 => array( 
                'from' => '<basepath>/modules/acsViewer.php',
                'to' => 'custom/modules/Accusoft/acsViewer.php',
            ),
            3 => array( 
                'from' => '<basepath>/modules/AcsViewerLogicHook.php',
                'to' => 'custom/modules/Accusoft/AcsViewerLogicHook.php',
            ),
            4 => array( 
                'from' => '<basepath>/EntryPointRegistry/acsViewer.php',
                'to' => 'custom/Extension/application/Ext/EntryPointRegistry/acsViewer.php',
            ),
		),
        'logic_hooks' => array(
            array(
                'module' => '',
				'hook' => 'after_ui_frame',
				'order' => 99,
				'description' => 'Used to intercept file download action to reroute to ACS Viewer',
				'file' => 'custom/modules/Accusoft/AcsViewerLogicHook.php',
				'class' => 'AcsViewerLogicHook',
				'function' => 'openViewer',
            ),
        ),
    );
?>