<?php

namespace MultiColumnAuthenticate\Auth;

use Cake\Auth\FormAuthenticate;
use Cake\ORM\TableRegistry;

class MultiColumnAuthenticate extends FormAuthenticate
{
    /**
     * Default config for this object.
     *
     * - `fields` The fields to use to identify a user by.
     * - `columns` The columns where `$fields['username']` should check against.
     * - `userModel` The alias for users table, defaults to Users.
     * - `finder` The finder method to use to fetch user record. Defaults to 'all'.
     *   You can set finder name as string or an array where key is finder name and value
     *   is an array passed to `Table::find()` options.
     *   E.g. ['finderName' => ['some_finder_option' => 'some_value']]
     * - `passwordHasher` Password hasher class. Can be a string specifying class name
     *    or an array containing `className` key, any other keys will be passed as
     *    config to the class. Defaults to 'Default'.
     * - Options `scope` and `contain` have been deprecated since 3.1. Use custom
     *   finder instead to modify the query to fetch user record.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'fields' => [
            'username' => 'username',
            'password' => 'password'
        ],
        'columns' => [
            'username',
            'email'
        ],
        'userModel' => 'Users',
        'scope' => [],
        'finder' => 'all',
        'contain' => null,
        'passwordHasher' => 'Default'
    ];

    /**
     * Get query object for fetching user from database.
     *
     * @param string $username The username/identifier.
     * @return \Cake\ORM\Query
     */
    protected function _query($username)
    {
        $config = $this->_config;
        $table = TableRegistry::get($config['userModel']);

        foreach ($config['columns'] as $column) {
            $options['conditions']['OR'][$table->aliasField($column)] = $username;
        }

        if (!empty($config['scope'])) {
            $options['conditions'] = array_merge($options['conditions'], $config['scope']);
        }
        if (!empty($config['contain'])) {
            $options['contain'] = $config['contain'];
        }

        $finder = $config['finder'];
        if (is_array($finder)) {
            $options += current($finder);
            $finder = key($finder);
        }

        $query = $table->find($finder, $options);

        return $query;
    }
}
