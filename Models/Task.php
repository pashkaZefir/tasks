<?php


namespace Models;


use App\DB;

class Task extends Base
{
    protected static $tableName = 'tasks';

    /** @property int $id */
    public $id = null;

    /** @property string $username */
    public $username = null;

    /** @property string $email */
    public $email = null;

    /** @property string $ready */
    public $ready = null;

    /** @property string $changed */
    public $changed = null;

    /** @property string $description */
    public $description = null;

    protected static function filterValues($var){
        return ($var !== NULL && $var !== FALSE && $var !== '');
    }

    public static function select(int $page, array $filters = null, string $sort = null)
    {
        $page = max(1, (int)$page);
        $rowsPerPage = static::$rowsPerPage;
        $skip = ($page - 1) * $rowsPerPage;

        list($fields, $values) = DB::mapValues($filters, ' AND ');

        $sql = "select * from `" . static::$tableName . "`";
        if ($fields) {
            $sql .= " where $fields";
        }

        if ($sort) {
            $sort = DB::escapeName($sort);
            $sql .= " order by $sort ";
        }

        $sql .= " limit :skip, :rowsPerPage ";

        $tasks = DB::select($sql,
            array_merge($values, ['skip' => $skip, 'rowsPerPage' => $rowsPerPage]));

        return $tasks;
    }

    public function create()
    {
        return DB::exec("insert into `" . static::$tableName . "` (username, email, description) VALUES (?, ?, ?)",
            [$this->username, $this->email, $this->description]);
    }

    public function update()
    {
        $fields = get_object_vars($this);
        unset($fields['id']);

        list($fields, $values) = DB::mapValues(array_filter($fields, 'static::filterValues'), ',');
        $values[] = $this->id;
        return DB::exec("update `" . static::$tableName . "` set $fields where id = ?", $values);
    }

    public function get($id)
    {
        return static::select(1, ['id' => $id])->first();
    }
}