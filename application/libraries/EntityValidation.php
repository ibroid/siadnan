<?php


class EntityValidation
{
  function __construct()
  {
    $entity_path = APPPATH . 'validations' . DIRECTORY_SEPARATOR;
    if (file_exists($entity_path)) {
      $this->_read_entity_dir($entity_path);
    }
  }

  /**
   * @param $dirpath
   */
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
