<?php

namespace Naissance\ApplicationBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Naissance\ApplicationBundle\Entity\Product;

class ProductFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    // public function load(ObjectManager $manager)
    // {
    //     $Product1 = new Product();
    //     $Product1->setTitle('A day with Symfony2');
    //     $Product1->setProduct('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
    //     $Product1->setImage('beach.jpg');
    //     $Product1->setAuthor('dsyph3r');
    //     $Product1->setTags('symfony2, php, paradise, symProduct');
    //     $Product1->setCreated(new \DateTime());
    //     $Product1->setUpdated($Product1->getCreated());
    //     $manager->persist($Product1);

    //     $Product2 = new Product();
    //     $Product2->setTitle('The pool on the roof must have a leak');
    //     $Product2->setProduct('Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.');
    //     $Product2->setImage('pool_leak.jpg');
    //     $Product2->setAuthor('Zero Cool');
    //     $Product2->setTags('pool, leaky, hacked, movie, hacking, symProduct');
    //     $Product2->setCreated(new \DateTime("2011-07-23 06:12:33"));
    //     $Product2->setUpdated($Product2->getCreated());
    //     $manager->persist($Product2);

    //     $Product3 = new Product();
    //     $Product3->setTitle('Misdirection. What the eyes see and the ears hear, the mind believes');
    //     $Product3->setProduct('Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
    //     $Product3->setImage('misdirection.jpg');
    //     $Product3->setAuthor('Gabriel');
    //     $Product3->setTags('misdirection, magic, movie, hacking, symProduct');
    //     $Product3->setCreated(new \DateTime("2011-07-16 16:14:06"));
    //     $Product3->setUpdated($Product3->getCreated());
    //     $manager->persist($Product3);

    //     $Product4 = new Product();
    //     $Product4->setTitle('The grid - A digital frontier');
    //     $Product4->setProduct('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
    //     $Product4->setImage('the_grid.jpg');
    //     $Product4->setAuthor('Kevin Flynn');
    //     $Product4->setTags('grid, daftpunk, movie, symProduct');
    //     $Product4->setCreated(new \DateTime("2011-06-02 18:54:12"));
    //     $Product4->setUpdated($Product4->getCreated());
    //     $manager->persist($Product4);

    //     $Product5 = new Product();
    //     $Product5->setTitle('You\'re either a one or a zero. Alive or dead');
    //     $Product5->setProduct('Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
    //     $Product5->setImage('one_or_zero.jpg');
    //     $Product5->setAuthor('Gary Winston');
    //     $Product5->setTags('binary, one, zero, alive, dead, !trusting, movie, symProduct');
    //     $Product5->setCreated(new \DateTime("2011-04-25 15:34:18"));
    //     $Product5->setUpdated($Product5->getCreated());
    //     $manager->persist($Product5);

    //     $manager->flush();

    //     $this->addReference('Product-1', $Product1);
    //     $this->addReference('Product-2', $Product2);
    //     $this->addReference('Product-3', $Product3);
    //     $this->addReference('Product-4', $Product4);
    //     $this->addReference('Product-5', $Product5);
    // }

    // public function getOrder()
    // {
    //     return 1;
    // }

}