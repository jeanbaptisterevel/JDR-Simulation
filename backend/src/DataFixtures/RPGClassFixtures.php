<?php

namespace App\DataFixtures;

use App\DataFixtures\Abstr\CoreFixture;
use App\Entity\Item;
use App\Entity\RPGClass;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class RPGClassFixtures extends CoreFixture implements DependentFixtureInterface
{

  protected function loadFakeData(): void
  {
    $items = $this->manager->getRepository(Item::class)->findAll();

    $this->createMany(RPGClass::class, 5, function(RPGClass $rpgClass) use ($items) {
      $rpgClass
        ->setName($this->faker->getClassName())
        ->setBaseHealth("2d10")
        ->setBaseForce($this->faker->randomPrimaryStat())
        ->setBaseDext($this->faker->randomPrimaryStat())
        ->setBaseConst($this->faker->randomPrimaryStat())
        ->setBaseIntell($this->faker->randomPrimaryStat())
        ->setBaseWisdom($this->faker->randomPrimaryStat())
        ->setBaseCharisma($this->faker->randomPrimaryStat())
        ->addAllowedItems($this->faker->randomElements($items, 3))
        ->addStartingItems($this->faker->randomElements($items, 3))
      ;
    });
  }

  public function getDependencies(): array
  {
    return array(
      ItemFixtures::class,
    );
  }
}
