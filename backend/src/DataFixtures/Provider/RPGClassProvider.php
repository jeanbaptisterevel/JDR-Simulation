<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class RPGClassProvider extends Base
{

  private array $name = [
    "Guerrier",
    "Barbare",
    "Voleur",
    "Ranger",
    "Paladin",
    "Elementaliste",
    "Clerc",
    "Barde",
    "Moine",
    "Adepte",
    "Magicien",
    "Druide",
  ];

  private array $dies = [
    4, 6, 8, 10
  ];

  public function getClassName(): string
  {
    return self::randomElement($this->name);
  }

  public function randomPrimaryStat(): string
  {
    return ($this::numberBetween(7, 12) * 5) .
      " " .
      $this::numberBetween(1, 2) .
      "d" .
      self::randomElement($this->dies);
  }

}
