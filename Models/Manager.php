<?php


namespace CESI\ProjetDiscord;


class Manager
{
    protected $db;
    public function DbConnect()
    {
        return new \PDO('mysql:host=localhost;dbname=discord;charset=utf8','root','');
    }
}