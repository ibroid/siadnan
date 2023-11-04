<?php

class Addons
{
    public $addonsjs = [];
    public $addonscss = [];


    public function __construct($addonsjs = [], $addonscss = [])
    {
        $this->addonsjs = $addonsjs;
        $this->addonscss = $addonscss;
    }

    public function init($addons)
    {
        $this->addonsjs = isset($addons['js']) ? $addons['js'] : [];
        $this->addonscss = isset($addons['css']) ? $addons['css'] : [];
    }

    public function js()
    {
        foreach ($this->addonsjs as $addon) {
            echo $addon;
        }
    }

    public function css()
    {
        foreach ($this->addonscss as $addon) {
            echo $addon;
        }
    }
}
