<?php

namespace Cupon\OfertaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Cupon\OfertaBundle\Entity\Oferta;

class Ofertas extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder()
    {
        return 40;
    }
    public function load(ObjectManager $manager)
    {

        // Obtener todas las tiendas y ciudades de la base de datos
        $ciudades = $manager->getRepository('CiudadBundle:Ciudad')->findAll();
        $tiendas = $manager->getRepository('TiendaBundle:Tienda')->findAll();

        for ($i = 0; $i < 400; $i++) {
            $entidad = new Oferta();
            $entidad->setNombre('Oferta '.$i);
            $entidad->setDescripcion('Sed malesuada, enim sit amet ultricies semper, elit leo lacinia massa, in tempus nisl ipsum quis libero.');
            $entidad->setCondiciones('No disponible para llevar. Debe consumirse en el propio local.');
            $entidad->setFoto('foto1.jpg');
            $entidad->setPrecio(rand(1, 100));
            $entidad->setDescuento(rand(1, 10));
            $entidad->setFechaPublicacion(new \DateTime());
            $entidad->setFechaExpiracion(new \DateTime('2015-01-01'));
            $entidad->setCompras(0);
            $entidad->setUmbral(rand(25, 100));
            $entidad->setRevisada(true);
            
            $ciudad = $ciudades[array_rand($ciudades)];
            $entidad->setCiudad($ciudad);

            $tienda = $tiendas[array_rand($tiendas)];
            $entidad->setTienda($tienda);

            $manager->persist($entidad);
        }

        $manager->flush();
    }
}
