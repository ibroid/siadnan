<?php

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class EloquentDatabase extends Illuminate\Database\Capsule\Manager
{

  public function __construct()
  {
    $ci  = &get_instance();

    parent::__construct();
    $this->addConnection([
      'driver' => 'mysql',
      'host' => $ci->db->hostname,
      'database' => $ci->db->database,
      'username' => $ci->db->username,
      'password' => $ci->db->password,
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => '',
    ]);
    $this->setEventDispatcher(new Dispatcher(new Container));
    $this->setAsGlobal();
    $this->bootEloquent();

    $this->readEntity();
  }

  private function readEntity()
  {
    $entity_path = APPPATH . 'entities' . DIRECTORY_SEPARATOR;
    if (file_exists($entity_path)) {
      $this->_read_entity_dir($entity_path);
    }
  }

  private function _read_entity_dir($dirpath)
  {
    $ci = &get_instance();

    $handle = opendir($dirpath);
    if (!$handle) return;

    while (false !== ($filename = readdir($handle))) {
      if ($filename == "." or $filename == "..") {
        continue;
      }

      $filepath = $dirpath . $filename;
      if (is_dir($filepath)) {
        $this->_read_entity_dir($filepath);
      } elseif (strpos(strtolower($filename), '.php') !== false) {
        require_once $filepath;
      } else {
        continue;
      }
    }

    closedir($handle);
  }
}
