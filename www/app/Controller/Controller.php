<?php

namespace app\Controller;

use app\Service\Db;

class Controller {

    public $db;

    public function __construct() {
        $this->_initServices();
    }

    private function _initServices(): void {
        $this->db = new Db();
    }
}