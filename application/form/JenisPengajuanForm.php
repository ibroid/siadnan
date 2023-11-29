<?php

require_once APPPATH . "form/FormInput.php";

class JenisPengajuanForm extends FormInput
{
    public function targetEntity()
    {
        return JenisPengajuanEntity::class;
    }
}
