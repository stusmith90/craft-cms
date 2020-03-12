<?php

namespace modules;

use craft\elements\Entry;
// use craft\helpers\UrlHelper;

class FirstSection{

  public function returnFirstSection(){
    return [
      'endpoints' => [
        'api/accordion' => function () {
          return [
            'elementType' => Entry::class,
            'criteria' => ['section' => 'secondSection'],
            'transformer' => function (Entry $entry) {
              $accordionData = [];
              foreach ($entry->accordionField as $block) {
                $accordionData[] = [
                  'id' => $entry->id,
                  'header' => $block->accordionText,
                  'hex_colour' => (string) $block->accordionDescription,
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
        'api/accordion/id=<entryId:\d+>' => function ($entryId) {
          return [
            'elementType' => Entry::class,
            'criteria' => ['id' => $entryId],
            'one' => true,
            'transformer' => function (Entry $entry) {
              $accordionData = [];
              foreach ($entry->accordionField as $block) {
                $accordionData[] = [
                  'id' => $entry->id,
                  'unique_id' => $block->id,
                  //'text' => $block->type->attributeConfigs,
                  'header' => $block->accordionText,
                  'hex_colour' => (string) $block->accordionDescription,
                ];
              }
              return [
                'accordion_data' => $accordionData,
              ];
            }
          ];
        },
      ]
    ];
  }
}