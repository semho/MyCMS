<?php

class Template {
    public $values = array();
    public $html;

    //метод загрузки шаблона
    public function get_tpl($tpl_name)
    {
        if(empty($tpl_name) || !file_exists($tpl_name)){
            return false;
        } else {
            $this->html = file_get_contents($tpl_name);
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