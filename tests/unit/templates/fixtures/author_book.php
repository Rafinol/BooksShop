<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$coefficient = $index % 4 + 1;

return [
    'author_id'  => $faker->randomNumber(1, 15),
    'book_id'    => $index + 1,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
];