<?php

class R_Input extends CI_Input
{

    private static $par;

    public function __construct()
    {
        parent::__construct();
        self::$par = new parent;
    }

    public static function pos($par = null)
    {
        return !$par ? self::$par->post() : self::$par->post($par, TRUE);
    }

    public static function gett($par = null)
    {
        return !$par ? self::$par->get() : self::$par->get($par, TRUE);
    }

    public static function mustPost()
    {
        if (self::$par->method() !== "post") {
            http_response_code(404);
            exit;
        }
    }

    public static function isPost()
    {
        return self::$par->method() == "post";
    }

    /**
     * Parsing post dari json
     * @return array
     */
    public static function json(): array
    {
        $json = file_get_contents('php://input');

        $data = json_decode($json, TRUE);

        return $data;
    }
}
