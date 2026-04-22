<?php
return [

    'processes' => [

        'Change Proposal And Justification' => [
            'model' => App\Models\ChangeProposalJust::class,
            'name' => 'Change Proposal And Justification'
        ],

        'Action Item' => [
            'model' => App\Models\ActionItem::class,
            'name' => 'Action Item'
        ],

        
        'Change Control' => [
            'model' => App\Models\CC::class,
            'name' => 'Change Control'
        ],

        'CAPA' => [
            'model' => App\Models\Capa::class,
            'name' => 'CAPA'
        ],

        'deviation' => [
            'model' => App\Models\Deviation::class,
            'name' => 'Deviation'
        ],

        'Effectiveness Check' => [
            'model' => App\Models\EffectivenessCheck::class,
            'name' => 'Effectiveness Check'
        ],

    ]

];