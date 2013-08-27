<?php
return array(
    'Controller' => array(
        'Controller'    => array(
            
            '[:ClassRoot]/Controller/[:ClassName].php'     => array(
                '[:ControllerClassName]'                   => 'Controller_[:ClassName]',
                '[:ExtensionClass]'                        => '[:ModuleName]_Controller_[:ClassName]',
                '[:SourceActions]'                         => '    // Inherited methods.',
            ),
            
            '[:ClassRoot]/[:ModuleName]/Controller/[:ClassName].php'    => array(
                '[:ControllerClassName]'                                => '[:ModuleName]_Controller_[:ClassName]',
                '[:ExtensionClass]'                                     => 'Controller'
            )
            
        )
    ),
    
    'LayoutController' => array(
        'Controller'    => array(
            
            '[:ClassRoot]/Controller/[:ClassName].php'     => array(
                '[:ControllerClassName]'                   => 'Controller_[:ClassName]',
                '[:ExtensionClass]'                        => '[:ModuleName]_Controller_[:ClassName]',
                '[:SourceActions]'                         => '    //  Inherited methods.',
            ),
            
            '[:ClassRoot]/[:ModuleName]/Controller/[:ClassName].php'    => array(
                '[:ControllerClassName]'                                => '[:ModuleName]_Controller_[:ClassName]',
                '[:ExtensionClass]'                                     => 'Controller_Template_Layout'
            )
            
        ),
        
        'View'          => array(
            
            '[:ViewRoot]/content/[:classname]/[:action_names].php'
            
        ),
    ),
    
    'AjaxController' => array(
        
        'Controller'    => array(
            
            '[:ClassRoot]/Controller/[:ClassName].php'    => array(
                '[:ControllerClassName]'                  => 'Controller_[:ClassName]',
                '[:ExtensionClass]'                       => '[:ModuleName]_Controller_[:ClassName]',
                '[:SourceActions]'                        => '    // Inherited methods.',
            ),
            
            '[:ClassRoot]/[:ModuleName]/Controller/[:ClassName].php'    => array(
                '[:ControllerClassName]'                                => '[:ModuleName]_Controller_[:ClassName]',
                '[:ExtensionClass]'                                     => 'Controller_Template_Ajax'
            )
        ),
        
        'View'          => array(
            
            '[:ViewRoot]/content/[:classname]/[:action_names].php'
            
        ),
    ),
    
    "model" => ""
);