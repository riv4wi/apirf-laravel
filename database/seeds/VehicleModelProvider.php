<?php
namespace Faker\Provider;

class VehicleModelProvider extends \Faker\Provider\Base
{

    protected static $modelveh = array(
        "Chevrolet" => array('Aveo', 'Corsa', 'Malibú', 'Optra', 'Silverado', 'Spark', 'Cruze'),
        "Fiat" => array('Palio', 'Premio', 'Siena', 'Spazio', 'Uno'),
        "Renault" => array('Twingo', 'Logan', 'Clio', 'Mégane', 'Symbol', 'Kangoo', 'Scénic', 'R19', 'Sandero'),
        "Ford" => array('Explorer', 'F-150', 'Fiesta', 'Ka', 'Mustang'),
        "Toyota" => array('4Runner', 'Corolla', 'Hilux', 'Macho', 'Yaris'),
        "Jeep" => array('Cherokee', 'CJ', 'Grand Cherokee', 'Wagoneer', 'Wrangler', 'Compass', 'Commander', 'Willys', 'Comanche'),
        "Volkswagen" => array('Gol', 'Fox', 'Spacefox', 'Bora', 'Escarabajo', 'Jetta', 'Kombi', 'Crossfox', 'Polo'),
        "Hyundai" => array('Elantra', 'Tucson', 'Getz', 'Accent', 'Santa Fe', 'Excel', 'Sonata', 'H1', 'Galloper'),
        "Mitsubishi" => array('Lancer', 'Montero', 'Signo', 'L-300', 'MF', 'Galant', 'Panel', 'MX', 'Eclipse'),
        "Honda" => array('Civic', 'Accord', 'Fit', 'CR-V', 'Odyssey', 'Pilot', 'Prelude', 'CRX', 'Integra', 'Legend'),
        "Chrysler" => array('Neon', 'Sebring', 'Caliber', '300 C', 'Grand Caravan', 'Town & Country', 'Le baron', 'Spirit', 'Stratus'),
        "Nissan" => array('Sentra', 'Tiida', 'Pathfinder', 'X-Trail', '350Z', 'Patrol', 'Almera', 'Murano', 'Frontier'),
        "Peugeot" => array('206', '207', '307', '407', 'Expert', '205', '306', '605')
    );


    public function modelveh($brand)
    {
        return static::randomElement(static::$modelveh[$brand]);
    }

}

?>
