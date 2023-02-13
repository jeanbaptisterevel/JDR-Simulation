<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Type;

class TypeFixtures extends CoreFixture
{

  protected function loadFakeData(): void
  {

    $this->createMany(Type::class, 5, function (Type $type) {
      $type
        ->setName($this->faker->getTypeName())
        ->setCharacteristics($this->faker->getCharacteristics(1, 4));
    });
  }
}
