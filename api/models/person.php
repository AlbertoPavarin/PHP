<?php 
Class Person
{
    protected $conn;
    protected $table_name = "person";

    protected $name;
    protected $surname;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT p.id, p.name, p.surname
                  FROM $this->table_name p
                  WHERE 1=1";

        $stmt = $this->conn->query($query);

        return $stmt;
    }

    function create($name, $surname)
    {
        $this->name = $name;
        $this->surname = $surname;

        $query = "INSERT INTO " .  $this->table_name . " (name, surname)" . " VALUES(?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ss', $this->name, $this->surname);
        if ($stmt->execute())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
?>