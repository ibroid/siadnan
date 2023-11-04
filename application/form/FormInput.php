<?php

abstract class FormInput
{
  abstract public function targetEntity();

  public static function input($constDefinition, $custom = stdClass::class)
  {
    $CI = &get_instance();
    $st = new static;
    return $CI->load->component('form_input', [
      'definition' => $st->parseDefinition($constDefinition),
      'custom' => $custom
    ]);
  }

  public static function select($constDefinition, $custom = stdClass::class, $options = [])
  {
    $CI = &get_instance();
    $st = new static;
    return $CI->load->component('form_input', [
      'definition' => $st->parseDefinition($constDefinition),
      'custom' => $custom,
      'options' => $options
    ]);
  }

  public function parseDefinition($definition)
  {
    $def = json_decode($this->reflect()->getConstant($definition . "Definition"));
    if (!is_object($def)) {
      throw new Exception("cannot parse " . $definition . " to objects", 1);
    }

    return $def;
  }

  public function parseLabel($definition)
  {
    return str_replace(' ', '', $definition);
  }

  public function reflect()
  {
    $reflect = new ReflectionClass($this->targetEntity());
    return $reflect;
  }
}
