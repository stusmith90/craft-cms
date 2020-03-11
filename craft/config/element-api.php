<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
  'endpoints' => [
    'api/accordion' => function () {
      return [
        'elementType' => Entry::class,
        'criteria' => ['section' => 'secondSection'],
        'transformer' => function (Entry $entry) {
          $accordionData = [];
          foreach ($entry->accordionField as $block){
            $accordionData[] = [
              //'text' => $block->type->attributeConfigs,
              'header' => $block->accordionText,
              'hex' => (string)$block->accordionDescription,
              'jsonUrl' => UrlHelper::url("second-section/{$entry->id}.json"),
            ];
        }
          return [
            'accordion_data' => $accordionData,
          ];
          // return [
          //   'title' => $entry,
          //   'url' => $entry->url,
          //   'jsonUrl' => UrlHelper::url("second-section/{$entry->id}.json"),
          // ];
        },
      ];
    },
    'api/accordion<entryId:\d+>.json' => function ($entryId) {
      return [
        'elementType' => Entry::class,
        'criteria' => ['id' => $entryId],
        'one' => true,
        'transformer' => function(Entry $entry) {
    return [
        'title' => $entry,
        'url' => $entry->url,
    ];
},
      ];
    },
  ]
];