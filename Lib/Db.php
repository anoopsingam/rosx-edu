<?php 
class database
{
    /*
    @override 
    Edit Server Details to Proceed for CRUD Database Class 
*/
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database_name = "rosx_edu";

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database_name);

        if (!$this->conn) {
            $this->error = "Connection failed: " . $this->conn->connect_error;
            return false;
            error_loger($this->conn->connect_error, __FILE__, "DB CONNECTION ERROR");
        }
    }

    public function insert(string $table_name, array $data)
    {
        unset($data['csrf']);
        $table_columns = implode(',', array_keys($data));
        $table_value = implode("','", $data);

        $sql = "INSERT INTO $table_name($table_columns) VALUES('$table_value')";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function update(string $table_name, array $data, string $id)
    {
        unset($data['csrf']);
        foreach ($data as $key => $value) {
            $args[] = "$key = '$value'";
        }

        $sql = "UPDATE  $table_name SET " . implode(',', $args);

        $sql .= " WHERE $id";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete(string $table_name, string $key)
    {
        $sql = "DELETE FROM $table_name";
        $sql .= " WHERE $key";
        $sql;
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function select(string $table, string $rows = "*", string $where = "null",string $like='')
    {
        if ($where != null) {
            $sql = "SELECT $rows FROM $table WHERE $where";
        } else {
            $sql = "SELECT $rows FROM $table";
        }
        if($like!=''){
            $sql." $like";
        }
        $this->sql = $this->conn->query($sql);
        //usage
        // $d = new database();
        // $d->select("student", "*", '');
        // $result = $d->sql;

        // while ($r = mysqli_fetch_assoc($result)) {
        //     print_r($r);
        // }
    }
}