<?php 
    Class Database
    {
        private $host = "localhost";
        private $db_name = "api_test";
        private $username = "root";
        private $password = "";
        public $conn;

        public function connect()
        {
            $this->conn = null;

            try 
            {
                $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
                echo "Connected\n";
            }
            catch(mysqli $ex)
            {
                echo "errore";
            }

            return $this->conn;
        }
    }
?>