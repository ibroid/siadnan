<?php

class R_Loader extends CI_Loader
{

    private $page;

    public function __construct()
    {
        parent::__construct();
    }

    public function component($comp, $vars = array())
    {
        $this->_ci_view_paths = array(APPPATH . "components/" => TRUE);
        return $this->_ci_load(array('_ci_view' => $comp, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => true));
    }

    public function page($view, $data = [])
    {
        $this->_ci_view_paths = array(APPPATH . "views/" => TRUE);
        $this->page = $this->view($view, $data, true);
        return $this;
    }

    public function layout($layout)
    {
        $this->_ci_view_paths = array(APPPATH . "layouts/" => TRUE);
        $this->_ci_load(array('_ci_view' => $layout, '_ci_vars' => $this->_ci_prepare_view_vars([
            'page' => $this->page
        ]), '_ci_return' => false));
    }

    /**
     * Unload Library
     */
    public function unload_library($name)
    {
        if (count($this->_ci_classes)) {
            foreach ($this->_ci_classes as $key => $value) {
                if ($key == $name) {
                    unset($this->_ci_classes[$key]);
                }
            }
        }

        if (count($this->_ci_loaded_files)) {
            foreach ($this->_ci_loaded_files as $key => $value) {
                $segments = explode("/", $value);
                if (strtolower($segments[sizeof($segments) - 1]) == $name . ".php") {
                    unset($this->_ci_loaded_files[$key]);
                }
            }
        }

        $CI = &get_instance();
        $name = ($name != "user_agent") ? $name : "agent";
        unset($CI->$name);
    }
}
