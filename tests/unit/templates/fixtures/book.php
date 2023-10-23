<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name'          => $faker->name,
    'released_year' => $faker->numberBetween(2014, date('Y')),
    'description'   => $faker->text(),
    'isbn'          => $faker->isbn10(),
    'created_at'    => date('Y-m-d H:i:s'),
    'updated_at'    => date('Y-m-d H:i:s'),
];
