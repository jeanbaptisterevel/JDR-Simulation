<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class TypeProvider extends Base
{

  private array $names = [
    "Épée",
    "Bouclier",
    "Casque",
    "Torse",
    "Jambe",
    "Pieds",
  ];

  private array $attributes = [
    "damages" => [1, 2, 3, 4, 5, 6, 7],
    "armor" => [1, 2, 3, 4, 5, 6, 7],
    "lifeTime" => [1, 2, 3, 4, 5, 6, 7],
    "healing" => [1, 2, 3, 4, 5, 6, 7],
    "properties" => [
      "bleeding", "critical", "fast"
    ]
  ];

  public function getTypeName(): string
  {
    return self::randomElement($this->names);
  }

  public function getCharacteristics(int $min, int $max): array
  {
    $newCharacteristics = [];

    for ($i = 1; $i <= ($max - $min); $i++) {
      $randomAttribute = self::randomElement(array_keys($this->attributes));

      if ($randomAttribute !== "properties" && in_array($randomAttribute, $this->attributes, true)) {
        continue;
      }

      $values = $this->attributes[$randomAttribute];
      $attributeValue = is_array($values) ? self::randomElement($values) : $values;

      if ($randomAttribute === "properties" && in_array($attributeValue, $this->attributes["properties"], true)) {
        continue;
      }

      $attributes[$randomAttribute] = $attributeValue;
    }

    return $attributes;
  }
}
