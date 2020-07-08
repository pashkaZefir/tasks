<?php


namespace Models;


use App\DB;

abstract class Base
{
    protected static $tableName = 'base';
    protected static $rowsPerPage = 3;

    public static function select(int $page, array $filters = null, string $sort = null)
    {
    }

    public static function getPagination()
    {
        $count = DB::select("select count(`id`) as count from " . static::$tableName)->first();
        return ceil($count->count / static::$rowsPerPage);
    }

    public function create()
    {
    }

    public function update()
    {
    }
}