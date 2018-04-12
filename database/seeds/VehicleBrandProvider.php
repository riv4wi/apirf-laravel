<?php
namespace Faker\Provider;

class VehicleBrandProvider extends \Faker\Provider\Base {

  protected static $brand = array(
                                    'Chevrolet',
                                    'Fiat',
                                    'Renault',
                                    'Ford',
                                    'Toyota',
                                    'Jeep',
                                    'Volkswagen',
                                    'Hyundai',
                                    'Mitsubishi',
                                    'Honda',
                                    'Chrysler',
                                    'Nissan',
                                    'Peugeot'
                                  );

  public function brand(){
    return static::randomElement(static::$brand);
  }
}
?>