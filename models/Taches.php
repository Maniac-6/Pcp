<?php

namespace Models;

class Taches extends Entity
{
    protected static $table = 'tache';

    public static function fields()
    {
      return [
        'id'                => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'date'              => ['type' => 'date', 'required' => true,],
        'description'       => ['type' => 'string', 'required' => true,],
      ];
    }
}