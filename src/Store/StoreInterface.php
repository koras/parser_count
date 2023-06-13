<?php

namespace App\Store;

/**
 *  // реализует интерфейс StoreInterface, если вдруг мы захотим переделать под file_get_contents или что-то другое
 *
 */
interface StoreInterface
{
    public function executeGetContent($url);
}