<?php

require_once __DIR__ . "../core/dataModel.php";

class User extends Model {
    protected string $table = "users";
    protected array $fillable = ["name", "email"];
}

