<?php
return [

    'processes' => [

        'change_proposal' => [
            'model' => App\Models\ChangeProposalJust::class,
            'name' => 'Change Proposal And Justification'
        ],

        'capa' => [
            'model' => App\Models\Capa::class,
            'name' => 'CAPA'
        ],

        'deviation' => [
            'model' => App\Models\Deviation::class,
            'name' => 'Deviation'
        ],

        'Change Control' => [
            'model' => App\Models\CC::class,
            'name' => 'Change Control'
        ],

        'Action Item' => [
            'model' => App\Models\ActionItem::class,
            'name' => 'Action Item'
        ],

        

        // 🔥 jitne bhi process hai add karte jao
    ]

];