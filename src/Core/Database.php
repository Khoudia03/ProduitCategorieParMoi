<?php

namespace Cisse\CategorieProduitPoo\Core;
use PDO;
use PDOException;
use PDOStatement;

class Database {
    private function __construct(){}

    private static ?PDO $instance = null;

    private static function getInstance(): PDO | null
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        try {
            $dsn = "pgsql:host=localhost;dbname=produitcategorie";
            self::$instance = new PDO($dsn, "postgres", "Cisse0312@");
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$instance;

        } catch (PDOException $e) {
            error_log("Connexion PostgreSQL échouée : " . $e->getMessage());
            return null;
        }
    }

    public static function query(string $sql, bool $single = true): mixed
    {
        $query = self::getInstance()->query($sql);
        return $single ? $query->fetch(PDO::FETCH_OBJ) : $query->fetchAll(PDO::FETCH_OBJ);
    }

    private static function prepare(string $sql, array $datas): PDOStatement
    {
        $prepare = self::getInstance()->prepare($sql);
        $prepare->execute($datas);
        return $prepare;
    }

    public static function executeQuery(string $sql, array $datas, bool $single = true): mixed
    {
        $statement = self::prepare($sql, $datas);
        return $single ? $statement->fetch(PDO::FETCH_OBJ) : $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public static function executeUpdate(string $sql, array $datas): int | string
    {
        $statement = self::prepare($sql, $datas);
        return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? self::getInstance()->lastInsertId() : $statement->rowCount();
    }

    public static function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";
        return self::query($sql, false);
    }
}