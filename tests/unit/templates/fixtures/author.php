<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'name'        => $faker->firstName,
    'last_name'   => $faker->lastName,
    'middle_name' => $faker->lastName,
    'created_at'  => date('Y-m-d H:i:s'),
    'updated_at'  => date('Y-m-d H:i:s'),
];
