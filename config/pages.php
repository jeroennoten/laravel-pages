<?php

return [
    'masters' => ['layouts.app'],
    'views' => [
        'layouts.app' => [
            'name' => 'Pagina',
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
                            'view' => ['layouts' => ['partials.section']]
                        ],
                    ],
                ],
            ],
        ],
        'news.latest' => [
            'name' => 'Laatste nieuws',
            'sections' => []
        ],
        'partials.section' => [
            'name' => 'Sectie',
            'sections' => [
                'title' => [
                    'name' => 'Titel',
                    'contents' => [
                        'types' => [
                            'string' => [
                                'css' => 'font-size: 24px; height: auto;'
                            ],
                        ],
                        'max' => 1,
                    ]
                ],
                'content' => [
                    'name' => 'Inhoud',
                    'contents' => [
                        'types' => [
                            'html' => [
                                'name' => 'Tekst met opmaak'
                            ],
                            'latest_news' => [
                                'type' => 'view',
                                'name' => 'Laatste nieuws',
                                'layouts' => ['news.latest']
                            ],
                            'view' => [
                                'name' => 'Sectie',
                                'layouts' => ['partials.section']
                            ]
                        ],
                        'max' => 1,
                    ],
                ],
            ]
        ]
    ]
];