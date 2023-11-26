<?php
class Database 
{
    private $db_host = '';
    private $db_user = '';
    private $db_pass = '';
    private $db_name = '';
    private $con;
    
    public function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    public function connect()
    {
        $this->con = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    
        if ($this->con->connect_errno) {
            error_log('Failed to connect to MySQL: ' . $this->con->connect_error);
    
            return false; 
        }
    
        return true; 
    }

    public function disconnect() 
    {
        if ($this->con) {
            $this->con->close();
            $this->con = null; 
            return true;
        } else {
            return false;
        }
    }

    private function tableExists($table) 
    {
        $tablesInDb = mysqli_query($this->con, 'SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
        if($tablesInDb) {
            if(mysqli_num_rows($tablesInDb) == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function insert($table, $data)
    {
        $keys = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
    
        $query = "INSERT INTO $table ($keys) VALUES ($values)";
        $stmt = $this->con->prepare($query);
    
        if (!$stmt) {
            die('Error in preparing the SQL query: ' . $this->con->error);
        }
    
        // Bind parameters if the statement is prepared successfully
        $types = str_repeat('s', count($data)); 
    
        $bindParams = [$types];
        foreach ($data as $key => $value) {
            $bindParams[] = &$data[$key]; 
        }
    
        call_user_func_array([$stmt, 'bind_param'], $bindParams);
    
        // Execute the statement
        $result = $stmt->execute();
    
        if (!$result) {
            die('Error in executing the SQL query: ' . $stmt->error);
        }
    
        $stmt->close();
    }

    public function query($query)
    {
        $result = $this->con->query($query);

        if (!$result) {
            error_log('Error in query: ' . $this->con->error);
            // Return false to indicate an error
            return false;
        }
    
        return $result;
    }
}

