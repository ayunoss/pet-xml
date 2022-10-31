<?php

namespace app\Controller;

use DateTime;

class User extends Controller {

    private ?string $_login;
    private ?string $_password;
    private ?string $_email;
    private ?string $_phone;

    public function __construct() {
        parent::__construct();
        $this->_createUserTable();

        $this->_login    = $_POST['login'] ?? null;
        $this->_password = $_POST['password'] ?? null;
        $this->_email    = $_POST['email'] ?? null;
        $this->_phone    = $_POST['phone'] ?? null;
    }

    public function signUpAction(): void {
        $creationDate = new DateTime();

        $query  = 'INSERT INTO user (login, password, email, phone, creation_date) VALUES (:login, :password, :email, :phone, :creation_date)';
        $params = [
            'login'         => $this->_login,
            'password'      => md5($this->_password),
            'email'         => $this->_email,
            'phone'         => $this->_phone,
            'creation_date' => $creationDate->format('Y-m-d H:i:s')
        ];

        try {
            $this->db->queryPDO($query, $params);
        } catch (\PDOException $e) {
            echo "Error while creating user: {$e->getMessage()}";
        }
    }

    public function signInAction(): void {
        $pwdHash = md5($this->_password);
        $query   = "SELECT id FROM user WHERE login='{$this->_login}' AND password='{$pwdHash}'";
        $userId  = $this->db->getData($query)['id'] ?? null;
        if ($userId !== null) {
            setcookie('session_id', md5($userId), time() + 3600);
        }
    }

    private function _createUserTable(): void {
        $sql = "CREATE TABLE IF NOT EXISTS `user` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `login` varchar(255) DEFAULT NULL,
              `password` varchar(255) DEFAULT NULL,
              `email` varchar(255) DEFAULT NULL,
              `phone` varchar(255) DEFAULT NULL,      
              `creation_date` datetime DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY (`email`),
              KEY (`creation_date`)
            ) DEFAULT CHARSET=utf8;";
        try {
            $this->db->queryPDO($sql);
        } catch (\PDOException $e) {
            echo "Error while creating 'user' table: {$e->getMessage()}";
        }
    }
}