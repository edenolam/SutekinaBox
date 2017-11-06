<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 categories! Bam!
        for ($i = 0; $i < 20; $i++) {
            $category = new Category();
            $category->setName('categorie '.$i);
            $manager->persist($category);
        }

        $manager->flush();
    }
}