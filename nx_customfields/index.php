<?php

return [

    // Module name
    'name' => 'yootheme/nx_customfields',

    // How this element is referenced inside the builder
    'builder' => 'nx_customfields',

    // Render this element on the website
    'render' => function ($element) {
        return $this->app->view->render("{$this->path}/template.php", ['element' => $element]);
    },

    'events' => [

        'builder.init' => function ($elements, $builder) {
            $elements->set('nx_customfields', json_decode(file_get_contents("{$this->path}/element.json"), true));
            $elements->set('nx_customfields_item', json_decode(file_get_contents("{$this->path}/element_item.json"), true));
        }

    ],

    'config' => [

        'element' => true

    ]

];
