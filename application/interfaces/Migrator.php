<?php

interface Migrator
{
    public static function table_declare();
    public static function table_name();
}
