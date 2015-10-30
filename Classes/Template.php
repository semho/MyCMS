<?php

class Template {
    public $values = array();
    public $html;
    public $path;

    //метод загрузки шаблона
    public function get_tpl($tpl_name)
    {
        $this->path = $_SERVER["DOCUMENT_ROOT"].'/Views/'.$tpl_name;
        if(empty($this->path) || !file_exists($this->path)){
            return false;
        } else {
            $this->html = file_get_contents($this->path);
        }
    }
    //метод установки значений
    public function set_value($key, $var)
    {
        $key = '{'.$key.'}';
        $this->values[$key] = $var;
    }
    //парсинг шаблона
    public function tpl_parse()
    {
        foreach ($this->values as $find => $replace) {
            $this->html = str_replace($find, $replace, $this->html);
        }

    }
}

$tpl = new Template();