<?

namespace modules\craft\config;

use craft\elements\Entry;
use craft\helpers\UrlHelper;

class firstSection{
  
  public function returnFirstSection(){
    return [
  'endpoints' => [
    'first-section.json' => function () {
      return [
        'elementType' => Entry::class,
        'criteria' => ['section' => 'firstSection'],
        'transformer' => function (Entry $entry) {
          return [
            'title' => $entry->title,
            'url' => $entry->url,
            'jsonUrl' => UrlHelper::url("first-section/{$entry->id}.json"),
          ];
        },
      ];
    },
    'first-section/<entryId:\d+>.json' => function ($entryId) {
      return [
        'elementType' => Entry::class,
        'criteria' => ['id' => $entryId],
        'one' => true,
        'transformer' => function (Entry $entry) {
          // Create an array of all the "Body" Matrix field's blocks

          return [
            'title' => $entry,
            'url' => $entry->url,
          ];
        },
      ];
    },
  ]
];
  }
}