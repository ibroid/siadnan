<?php
$name = (isset($definition->name)) ? "name=\"$definition->name\" " : '';
$required = (isset($definition->null) && $definition->null == false) ? "required " : '';
$id = (isset($definition->name)) ? "id=\"validation$definition->name\" " : '';
$for = (isset($definition->name)) ? "for=\"validation$definition->name\" " : '';

$value = (isset($custom->value)) ? "value=\"" . $custom->value . "\" " : '';
$placeholder = (isset($custom->placeholder)) ? $custom->placeholder : "Pilih Salah Satu";
?>

<label <?= $for ?>>
  <?= isset($custom->label) ? $custom->label : ucwords(str_replace('_', ' ', $definition->column))  ?>
</label>
<select class="form-select" aria-label=".form-select example" <?= $name . $required . $id ?>>
  <option selected="" disabled><?= $placeholder ?> </option>
  <?php foreach ($options as $option) { ?>
    <option value="<?= $option->value ?>"><?= $option->name ?></option>
  <?php } ?>
</select>