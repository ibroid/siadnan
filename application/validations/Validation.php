<?php


abstract class Validation
{

  abstract function targetEntity();
  abstract function shouldValidateColumn($propertyName);

  public function getValidationRules()
  {
    $rules = [];

    // Iterasi melalui properti yang memiliki definisi kolom
    $reflection = new ReflectionClass(ProfileEntity::class);
    $constants = $reflection->getConstants();

    foreach ($constants as $constantName => $constantValue) {
      if (strpos($constantName, 'Definition') !== false) {
        // Mendapatkan nama properti dari definisi kolom
        $propertyName = lcfirst(str_replace('Definition', '', $constantName));

        // Mengekstrak definisi kolom JSON
        $columnDefinition = json_decode($constantValue, true);

        if ($columnDefinition && !isset($columnDefinition['table']) && $this->shouldValidateColumn($propertyName)) {
          $field = $columnDefinition['column'];
          $label = isset($columnDefinition['name']) ? $columnDefinition['name'] : $propertyName;
          $rules[$propertyName] = [
            'field' => $field,
            'label' => $label,
            'rules' => $this->generateValidationRules($columnDefinition),
          ];
        }
      }
    }

    return $rules;
  }

  private function generateValidationRules($columnDefinition)
  {
    $rules = [];

    // Tambahkan aturan berdasarkan definisi kolom
    if (isset($columnDefinition['null']) && !$columnDefinition['null']) {
      $rules[] = 'required';
    }

    // Tambahkan aturan berdasarkan tipe data
    switch ($columnDefinition['type']) {
      case 'int':
        $rules[] = 'integer';
        break;
      case 'varchar':
        $rules[] = 'max_length[' . $columnDefinition['constraint'] . ']';
        break;
      case 'timestamp':
        $rules[] = 'valid_datetime';
        break;
        // Tambahkan aturan khusus untuk tipe data lainnya
    }

    return implode('|', $rules);
  }
}
