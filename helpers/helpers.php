<?php

class Helpers {

    public static function deleteCurrentSession($session_name) {
        if (isset($_SESSION[$session_name])) {
            $_SESSION[$session_name] = null;
            unset($_SESSION[$session_name]);
        }

        return $session_name;
    }

    public static function validateFields($field, $method = null) {
        if (isset($method) && !empty($method)) {
            $stateFields = false;

            foreach($field as $currentField){
                if ($currentField) {
                    $stateFields = true;
                    continue;
                } else {
                    $stateFields = false;
                    break;
                }
            }

            return $stateFields;
        } else {
            return isset($field) ? $field : false;
        }
    }

    public static function isAdmin() {
        if (!isset($_SESSION[admin_login])) {
            header("Location: ".base_url);
        } else return true;
    }

    public static function showCategorias() {
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        return $categoria->getAll();
    }

}