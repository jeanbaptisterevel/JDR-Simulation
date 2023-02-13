<?php

namespace App\DataFixtures\Abstr;

use App\DataFixtures\Provider\ItemProvider;
use App\DataFixtures\Provider\RPGClassProvider;
use App\DataFixtures\Provider\TypeProvider;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class CoreFixture extends Fixture
{

  protected Generator $faker;
  protected ObjectManager $manager;

  public function __construct()
  {
    $this->faker = Factory::create('fr_FR');
    $this->faker->addProvider(new ItemProvider($this->faker));
    $this->faker->addProvider(new RPGClassProvider($this->faker));
    $this->faker->addProvider(new TypeProvider($this->faker));
  }

  public function load(ObjectManager $manager): void
  {
    $this->manager = $manager;

    $this->loadFakeData();
  }

  protected function createMany(string $fqcn, int $count, callable $factory)
  {
    for ($i = 0; $i < $count; $i++) {
      $entity = new $fqcn();
      $factory($entity, $i);
      $this->manager->persist($entity);
    }
    $this->manager->flush();
  }

  abstract protected function loadFakeData(): void;
}
