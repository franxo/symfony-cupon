<?php

namespace Cupon\UsuarioBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cupon\UsuarioBundle\Entity\Usuario;

class Usuarios extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 30;
    }
    public function load(ObjectManager $manager)
    {

        // Obtener todas las ciudades de la base de datos
        $ciudades = $manager->getRepository('CiudadBundle:Ciudad')->findAll();
        
        $entidad = new Usuario();
        $entidad->setNombre('Francisco');
        $entidad->setApellidos('Garde Calvo');
        $entidad->setEmail('example@example.com');
        $entidad->setPassword('1234');
        $entidad->setSalt('qwertasdfzxcv');
        $entidad->setDireccion('direccion 1, puerta 1');
        $entidad->setPermiteEmail(1);
        $entidad->setFechaAlta(new \DateTime());
        $entidad->setFechaNacimiento(new \DateTime('1978-01-01'));
        $entidad->setDni('12345678A');
        $entidad->setNumeroTarjeta('1234567890123456');
        $ciudad = $ciudades[array_rand($ciudades)];
        $entidad->setCiudad($ciudad);

        $manager->persist($entidad);

        $manager->flush();
    }
}
