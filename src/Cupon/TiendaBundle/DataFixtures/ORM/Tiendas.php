<?php

namespace Cupon\TiendaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cupon\CiudadBundle\Entity\Ciudad;
use Cupon\TiendaBundle\Entity\Tienda;

class Tiendas extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 20;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las ciudades de la base de datos
        $ciudades = $manager->getRepository('CiudadBundle:Ciudad')->findAll();

        $tienda = new Tienda();
        $tienda->setNombre('Restaurante 1');
        $tienda->setLogin('tienda1');
        $tienda->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        $tienda->setPassword('tienda1');
        $tienda->setDescripcion('Mauris ultricies nunc nec sapien tincidunt facilisis');
        $tienda->setDireccion('Direccion 1');
        $ciudad = $ciudades[array_rand($ciudades)];
        $tienda->setCiudad($ciudad);
        $manager->persist($tienda);
                
        $manager->flush();
    }

}