<?php

return [

    'points' => 1,

    'enable-for-voters' => env('VOTE_APP_AVAILABLE_FOR_VOTERS',true),
    
    'app-available-from-date' => env('VOTE_AVAILABLE_FROM_DATE'),
    
    'app-available-from-hour' => env('VOTE_AVAILABLE_FROM_HOUR'),

    'app-available-until-date' => env('VOTE_AVAILABLE_UNTIL_DATE'),

    'app-available-until-hour' => env('VOTE_AVAILABLE_UNTIL_HOUR')

];
