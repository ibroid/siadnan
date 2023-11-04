<?php
$maxLength = (isset($definition->constraint)) ? "maxlength=\"" . $definition->constraint . "\" " : '';
$name = (isset($definition->name)) ? "name=\"$definition->name\" " : '';
$required = (isset($definition->null) && $definition->null == false) ? "required " : '';
$typeText = (isset($definition->type) && $definition->type == "varchar" && $definition->name != "email") ? "type=\"text\" " : '';
$typeEmail = (isset($definition->type) && $definition->type == "varchar" && $definition->name == "email") ? "type=\"email\" " : '';
$typeNum = (isset($definition->type) && $definition->type == "int") ? "type=\"number\" " : '';
$id = (isset($definition->name)) ? "id=\"validation$definition->name\" " : '';
$for = (isset($definition->name)) ? "for=\"validation$definition->name\" " : '';

$minLength = (isset($custom->min)) ? "minlength=\"" . $custom->min . "\" " : '';
$value = (isset($custom->value)) ? "value=\"" . $custom->value . "\" " : '';
$hidden = (isset($custom->hidden)) ? "hidden=\"true\" " : '';
$placeholder = (isset($custom->placeholder)) ? "placeholder=\"" . $custom->placeholder . "\" " : "placeholder=\"Enter your data ...\"";
?>

<label class="form-label" <?= $for ?>><?= isset($custom->label) ? $custom->label : ucwords(str_replace('_', ' ', $definition->column))  ?>
  <span class="txt-danger">*</span>
</label>

<input class="form-control" <?= $id . $maxLength . $name . $required . $typeNum . $typeText . $minLength . $value . $hidden . $placeholder . $typeEmail ?>>

<div class="valid-tooltip">Looks Good !</div>
<div class="invalid-tooltip">Check Again !</div>