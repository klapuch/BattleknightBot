<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

interface Entrance {
    /**
     * Let the user to the system
     * @param string $username
     * @param string $password
     * @throws \UnexpectedValueException
     * @return Knight
     */
    public function enter(string $username, string $password): Knight;
}