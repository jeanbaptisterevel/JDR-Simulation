<?php

namespace App\DataFixtures\Provider;

use Faker\Provider\Base;

class ItemProvider extends Base
{

  private array $items = [
    "Épée de feu",
    "Armure en mithril",
    "Bâton de glace",
    "Potion de soin",
    "Anneau de force",
    "Bouclier de bois",
    "Dague empoisonnée",
    "Tunique en cuir",
    "Livre de sorts",
    "Baguette magique"
  ];

  public function getItemName(): string
  {
    return self::randomElement($this->items);
  }

}
