<?php

/**
 * This file is part of Sv1fT/laravel-exchange1c package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [
    'exchange_path' => '1c_exchange',
    'import_dir'    => storage_path('app/1c_exchange'),
    'login'         => env('1C_EXCHANGE_LOGIN','admin'),
    'password'      => env('1C_EXCHANGE_PASSWORD','admin'),
    'use_zip'       => false,
    'file_part'     => 0,
    'models'        => [
        \Sv1fT\Exchange1C\Interfaces\GroupInterface::class   => \Sv1fT\LaravelExchange1C\Models\Category::class,
        \Sv1fT\Exchange1C\Interfaces\ProductInterface::class => \Sv1fT\LaravelExchange1C\Models\Product::class,
        \Sv1fT\Exchange1C\Interfaces\OfferInterface::class   => \Sv1fT\LaravelExchange1C\Models\Offer::class,
    ],
    'log_channel' => 'daily',
    'queue'       => 'default',
    'auth'        => [
        'custom'   => false,
        'callback' => function ($username, $password) {
            if ($username == 'admin' && $password == 'admin') {
                return true;
            }

            return false;
        },
    ],
];
