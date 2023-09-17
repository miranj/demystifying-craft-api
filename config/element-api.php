<?php

// Element API
// https://github.com/craftcms/element-api
// 
// Mimick a 3rd-party ticketing service API which
// returns the number of available tickets for each event.


use craft\elements\Entry;

return [
    'defaults' => [
        'paginate' => false,
        'cache' => false,
    ],
    
    'endpoints' => [
        'seats.json' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => [
                    'section' => 'eventSeats',
                    'with' => ['event'],
                ],
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'eventId' => $entry->event->one()->id,
                        'seatsAvailable' => $entry->seatsAvailable,
                        'title' => $entry->title,
                    ];
                }
            ];
        },
    ],
];
