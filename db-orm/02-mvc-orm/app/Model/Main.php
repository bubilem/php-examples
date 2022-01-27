<?php

namespace SimpleOrmExample\Model;

use SimpleOrmExample\Util\Database\DB;
use SimpleOrmExample\Util\Str;

abstract class Main
{
    protected static $conf;
    protected $data;
    protected $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
        $this->data = [];
    }

    public function load($pk): bool
    {
        $query = 'SELECT * FROM ' . static::$conf['table'] . ' WHERE ' . static::$conf['pk'] . ' = ' . $pk;
        $result = $this->db->query($query);
        if (!$this->db->getLastError() && $this->db->getNumRows($result) === 1) {
            $this->data = $this->db->fetch($result);
            return true;
        }
        return false;
    }

    public function save(): bool
    {
        if ($this->id) {
            $values = [];
            foreach (static::$conf['attributes'] as $attributeName) {
                if ($attributeName != static::$conf['pk']) {
                    $values[] = $attributeName . " = " . (isset($this->data[$attributeName]) ? "'" . $this->data[$attributeName] . "'" : "NULL");
                }
            }
            $query = 'UPDATE ' . static::$conf['table'] .
                ' SET ' . implode(', ', $values) .
                ' WHERE ' . static::$conf['pk'] . ' = ' . $this->id;
        } else {
            $attributeNames = $attributeValues = [];
            foreach (static::$conf['attributes'] as $attributeName) {
                if ($attributeName != static::$conf['pk']) {
                    $values[] = $attributeName . " = " . (isset($this->data[$attributeName]) ? "'" . $this->data[$attributeName] . "'" : "NULL");
                }
            }
            $query = 'INSERT INTO ' . static::$conf['table'] . '(' . $attributeNames . ') VALUES (' . $attributeValues . ')';
        }
        $this->db->query($query);
        if (
            !$this->db->getLastError()
            && $this->db->getAffectedRows() == 1
        ) {
            return true;
        }
        return false;
    }

    public function __call(string $name, array $arguments)
    {
        $typeOfMethod = strtolower(substr($name, 0, 3));
        $name = Str::camelCaseToSnakeCase(substr($name, 3));
        switch ($typeOfMethod) {
            case 'set':
                if (
                    in_array($name, static::$conf["attributes"])
                    && !empty($arguments)
                ) {
                    $this->data[$name] = implode(" ", $arguments);
                }
                return $this;
            case 'get':
                return $this->$name;
            case 'clr':
                if (
                    in_array($name, static::$conf["attributes"])
                    && isset($this->data[$name])
                ) {
                    unset($this->data[$name]);
                }
                return $this;
        }
        return false;
    }

    public function __get(string $name)
    {
        $attributeName = Str::camelCaseToSnakeCase($name);
        return in_array($attributeName, static::$conf["attributes"])
            && isset($this->data[$attributeName])
            ? $this->data[$attributeName]
            : null;
    }
}
