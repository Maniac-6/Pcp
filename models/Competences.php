<?php

namespace Models;

class Competences extends Entity
{
    protected static $table = 'competence';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'code'      => ['type' => 'string', 'required' => false,],
        'lib'       => ['type' => 'string', 'required' => true,],
      ];
    }
}