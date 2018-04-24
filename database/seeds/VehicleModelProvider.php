<?php
namespace Faker\Provider;

class VehicleModelProvider extends \Faker\Provider\Base
{

    protected static $modelveh = array(
        "Chevrolet" => array('Aveo', 'Corsa', 'Malibú', 'Optra', 'Silverado', 'Spark', 'Onix Joy',
                            'Onix', 'Onix Activ', 'Prisma Joy', 'Cobalt', 'Cruze 5', 'Cruze', 'Tracker',
                            'Captiva', 'Trailblazer', 'Camaro Coupé', 'Camaro Convertible',),

        "Fiat" => array('Palio', 'Premio', 'Sienna', 'Spazio', 'Uno'),
        "Renault" => array('Twingo', 'Logan', 'Clio', 'Mégane', 'Symbol', 'Kangoo', 'Scénic', 'R19', 'Sandero'),
        "Ford" => array('Explorer', 'F-150', 'Ka', 'Ka+', 'Fiesta', 'Fiesta 4P', 'Focus', 'Focus 4P', 'Mondeo', 'Mustang',),
        "Toyota" => array('4Runner', 'Corolla', 'Hilux', 'Macho', 'Yaris'),
        "Jeep" => array('Cherokee', 'Grand Cherokee', 'Wagoneer', 'Wrangler', 'Compass', 'Commander', 'Willys', 'Comanche'),
        "Volkswagen" => array('Gol', 'Fox', 'Spacefox', 'Bora', 'Escarabajo', 'Jetta', 'Kombi', 'Crossfox', 'Polo'),
        "Hyundai" => array('Elantra', 'Tucson', 'Getz', 'Accent', 'Santa Fe', 'Excel', 'Sonata', 'H1', 'Galloper'),
        "Mitsubishi" => array('Lancer', 'Montero', 'Signo', 'L-300', 'MF', 'Galant', 'Panel', 'MX', 'Eclipse'),
        "Honda" => array('Civic', 'Accord', 'Fit', 'CR-V', 'Odyssey', 'Pilot', 'Prelude', 'CRX', 'Integra', 'Legend'),
        "Chrysler" => array('Neon', 'Sebring', 'Caliber', '300 C', 'Grand Caravan', 'Town & Country', 'Le baron', 'Spirit', 'Stratus'),
        "Peugeot" => array('206', '207', '307', '407', 'Expert', '205', '306', '605'),
        "Citroën" => array('C3 Aircross', 'C4 Cactus', 'C4 Grand Picasso', 'C4 Lounge', 'C4 Picasso', 'C-Elysée'),
        "Nissan" => array('March', 'Kicks', 'Frontier ', 'Sentra', 'Tiida', 'Pathfinder', 'X-Trail', '350Z', 'Patrol', 'Almera', 'Murano'),
        "نيسان" => array('نيسان نافارا', 'التيما'),
        "بورش" => array('بورش باناميرا GTR'),
        "Maserati" => array('Ghibli', 'Levante', 'Quattroporte', 'GranTurismo', 'GranCabrio'),
    );


    public function modelveh($brand)
    {
        return static::randomElement(static::$modelveh[$brand]);
    }

}
