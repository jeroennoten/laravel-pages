<?php

return [
    'masters' => ['layouts.app'],
    'views' => [
        'layouts.app' => [
            'name' => 'Pagina',
            'sections' => [
                'title' => [
                    'name' => 'Paginatitel',
                    'contents' => [
                        'types' => ['string'],
                        'max' => 1,
                    ],
                ],
                'main' => [
                    'name' => 'Inhoud',
                    'contents' => [
                        'types' => [
                            'view' => [
                                'name' => 'Blok',
                                'layouts' => ['partials.box']
                            ]
                        ],
                    ],
                ],
            ],
        ],
        'occassions.latest' => [
            'name' => 'Laatste occassions',
            'sections' => []
        ],
        'partials.box' => [
            'name' => 'Blok',
            'sections' => [
                'title' => [
                    'name' => 'Titel',
                    'contents' => [
                        'types' => ['string'],
                        'max' => 1,
                    ],
                ],
                'main' => [
                    'name' => 'Inhoud',
                    'contents' => [
                        'types' => [
                            'html' => [
                                'name' => 'Tekst met opmaak'
                            ],
                            'view' => [
                                'name' => 'Laatste occassions',
                                'layouts' => ['occassions.latest']
                            ],
                            'services' => [
                                'type' => 'view',
                                'name' => 'Onze diensten',
                                'layouts' => ['partials.services']
                            ],
                        ],
                    ],
                ],
            ]
        ],
        'partials.services' => [
            'name' => 'Services',
            'sections' => []
        ],
    ],
];