<?php

namespace app\infrastructure\db;

use yii\db\Migration as yiiMigration;

abstract class Migration extends yiiMigration
{
    private static array $defaultOptions = [
        'column' => 'id',
        'delete' => 'RESTRICT',
        'update' => null,
    ];

    protected function createForeignKeysForColumns($columns)
    {
        foreach ($columns as $column => $refTable) {
            $options = self::$defaultOptions;

            if (is_array($refTable)) {
                $options = array_merge($options, $refTable);
            } else {
                $options['table'] = $refTable;
            }
            $this->createIndex(
                $this->idxName($column),
                static::TABLE_NAME,
                $column
            );

            $this->addForeignKey(
                $this->fkName($column),
                static::TABLE_NAME,
                $column,
                $options['table'],
                $options['column'],
                $options['delete'],
                $options['update']
            );
        }
    }

    protected function dropForeignKeysForColumns($columns)
    {
        foreach (array_reverse(array_keys($columns)) as $column) {
            $this->dropForeignKey(
                $this->fkName($column),
                static::TABLE_NAME,
            );

            $this->dropIndex(
                $this->idxName($column),
                static::TABLE_NAME,
            );
        }
    }

    private function idxName($columnName): string
    {
        return sprintf("idx-%s-%s", static::TABLE_NAME, $columnName);
    }

    private function fkName($columnName): string
    {
        return sprintf('fk-%s-%s', static::TABLE_NAME, $columnName);
    }
}