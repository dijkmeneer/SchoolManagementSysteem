<?php

namespace App\DataFixtures;

use App\Entity\Foto;
use App\Entity\Klas;
use App\Entity\Leraar;
use App\Entity\Student;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create some teachers (Leraren)
        $leraar1 = new Leraar();
        $leraar1->setNaam('John Doe');
        $leraar1->setLeeftijd(30);
        $manager->persist($leraar1);

        $leraar2 = new Leraar();
        $leraar2->setNaam('Jane Smith');
        $leraar2->setLeeftijd(40);
        $manager->persist($leraar2);

        // Create some classes (Klassen)
        $klas1 = new Klas();
        $klas1->setNaam('Class 1');
        $manager->persist($klas1);

        $klas2 = new Klas();
        $klas2->setNaam('Class 2');
        $manager->persist($klas2);

        // Link teachers to classes
        $klas1->addLeraar($leraar1);
        $klas1->addLeraar($leraar2);

        $klas2->addLeraar($leraar2);

        // Create some photos (Fotos)
        $foto1 = new Foto();
        $foto1->setFilename('photo1.jpg');
        $manager->persist($foto1);

        $foto2 = new Foto();
        $foto2->setFilename('photo2.jpg');
        $manager->persist($foto2);

        // Create some students (Studenten)
        $student1 = new Student();
        $student1->setNaam('Student A');
        $student1->setLeeftijd(20);
        $student1->setKlas($klas1);
        $student1->setFoto($foto1);
        $manager->persist($student1);

        $student2 = new Student();
        $student2->setNaam('Student B');
        $student2->setLeeftijd(22);
        $student2->setKlas($klas2);
        $student2->setFoto($foto2);
        $manager->persist($student2);

        // Flush all data to the database
        $manager->flush();
    }
}
