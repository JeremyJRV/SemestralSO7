<?php
namespace clases;

abstract class Model
{
    protected static string $table;
    protected static string $primaryKey = 'id';
    protected array $attributes = [];

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    public function fill(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    public function __get(string $name)
    {
        return $this->attributes[$name] ?? null;
    }

    public function __set(string $name, $value): void
    {
        $this->attributes[$name] = $value;
    }

    public static function find(int|string $id): ?static
    {
        $db = Database::getInstance()->getConnection();
        $table = static::$table;
        $pk = static::$primaryKey;
        $stmt = $db->prepare("SELECT * FROM `$table` WHERE `$pk` = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? new static($row) : null;
    }

    public static function all(): array
    {
        $db = Database::getInstance()->getConnection();
        $table = static::$table;
        $stmt = $db->query("SELECT * FROM `$table`");
        $rows = $stmt->fetchAll();
        $results = [];
        foreach ($rows as $row) {
            $results[] = new static($row);
        }
        return $results;
    }

    public function save(): bool
    {
        $db = Database::getInstance()->getConnection();
        $table = static::$table;
        $pk = static::$primaryKey;

        if (isset($this->attributes[$pk]) && $this->attributes[$pk]) {
            // Update
            $sets = [];
            $params = [];
            foreach ($this->attributes as $key => $value) {
                if ($key === $pk) continue;
                $sets[] = "`$key` = :$key";
                $params[$key] = $value;
            }
            $params[$pk] = $this->attributes[$pk];
            $sql = "UPDATE `$table` SET " . implode(', ', $sets) . " WHERE `$pk` = :$pk";
            return $db->prepare($sql)->execute($params);
        } else {
            // Insert
            $columns = implode('`, `', array_keys($this->attributes));
            $placeholders = ':' . implode(', :', array_keys($this->attributes));
            $sql = "INSERT INTO `$table` (`$columns`) VALUES ($placeholders)";
            $stmt = $db->prepare($sql);
            $result = $stmt->execute($this->attributes);
            if ($result) {
                $this->attributes[$pk] = (int) $db->lastInsertId();
            }
            return $result;
        }
    }

    public function delete(): bool
    {
        $db = Database::getInstance()->getConnection();
        $table = static::$table;
        $pk = static::$primaryKey;
        $stmt = $db->prepare("DELETE FROM `$table` WHERE `$pk` = :id");
        return $stmt->execute(['id' => $this->attributes[$pk]]);
    }

    public static function query(string $sql, array $params = []): array
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function toArray(): array
    {
        return $this->attributes;
    }
}