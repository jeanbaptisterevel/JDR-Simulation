<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Item;
use App\Entity\Type;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ItemFixtures extends CoreFixture implements DependentFixtureInterface
{
  protected function loadFakeData(): void
  {
    $types = $this->manager->getRepository(Type::class)->findAll();

    $this->createMany(Item::class, 5, function (Item $item) use ($types) {
      $item
        ->setName($this->faker->getItemName())
        ->setType($this->faker->randomElement($types));
    });
  }

  public function getDependencies(): array
  {
    return array(
      TypeFixtures::class,
    );
  }
}
