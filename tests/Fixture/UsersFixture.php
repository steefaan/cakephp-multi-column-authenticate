<?php

namespace MultiColumnAuthenticate\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class UsersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => [
            'type' => 'integer'
        ],
        'username' => [
            'type' => 'string',
            'length' => 64,
            'null' => false
        ],
        'email' => [
            'type' => 'string',
            'length' => 128,
            'null' => false
        ],
        'password' => [
            'type' => 'string',
            'length' => 64,
            'null' => false
        ],
        '_constraints' => [
            'primary' => [
                'type' => 'primary',
                'columns' => [
                    'id'
                ]
            ]
        ]
    ];

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'username' => 'stefan',
            'email' => 'stefan@php-engineer.de',
            'password' => '',
        ],
    ];
}
