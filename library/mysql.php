<?php

class database {

    var $conn_id;
    var $query_id;
    var $result;
    var $record;
    var $db = array("host" => '', "user" => "", "pass" => "", "db" => "");
    var $port;
    var $AddQuoteOnExecQuery = true;
    var $query_string;
    var $querynum;
    var $CacheData;
    var $Debug = true;

    /*
      // Constructor
     */

    function database() {

        if (strpos($this->db['host'], ":")) {

            list($host, $port) = explode(":", $this->db['host']);
            $this->port = $port;
        } else {
            // default mysql port
            $this->port = 3306;
        }
    }

    // =========================================
    // CacheData
    // =========================================
    function Cache($k, $v) {
        $this->CacheData[$k] = $v;
    }

    function CleanCache() {
        $this->CacheData = null;
    }

    // =========================================
    // Connection
    // =========================================
    /*
      // mysql connection
     */
    function connect() {

        $this->conn_id = @mysql_connect(
                        $this->db['host'] . ":" . $this->port,
                        $this->db['user'],
                        $this->db['pass'],
                        true
        );

        if (!$this->conn_id)
            $this->sql_error("Connection Error", 'N/A');

        if (!mysql_select_db($this->db['db'], $this->conn_id))
            $this->sql_error("Database Error", 'N/A');

        return $this->conn_id;
    }

    // =========================================
    // Data handling
    // =========================================
    function quote($value) {
        if (is_array($value)) {
            foreach ($value as $k => $item) {
                if (get_magic_quotes_gpc ()) {
                    $value[$k] = stripslashes($item);
                }
                if (!is_numeric($value)) {
                    $value[$k] = "'" . mysql_real_escape_string($item) . "'";
                } else
                    $value[$k] = "'" . $item . "'";
            }
            return $value;
        }
        else {
            if (get_magic_quotes_gpc ()) {
                $value = stripslashes($value);
            }
            if (!is_numeric($value)) {
                $value = "'" . mysql_real_escape_string($value) . "'";
            } else
                $value = "'" . $value . "'";
            return $value;
        }
    }

    // =========================================
    // Query
    // =========================================
    /*
      // get last insert id
     */
    function mysql_insert_id() {
        $id = mysql_insert_id($this->conn_id);
        return $id;
    }
    /*
      // query execute
     */
    function query($query_string) {
        $this->querynum++;
        $this->result = mysql_query($query_string, $this->conn_id);
        if (!$this->result)
            $this->sql_error("Query Error", $query_string);
        $this->query_string = $query_string;
        return $this->result;
        $this->free_result($this->result);
    }

    /*
      // query execute
      // return query result
     */

    function query_first($query_string) {
        $this->query_string = $query_string;
        $this->query($query_string);
        $returnarray = $this->fetch_array($this->result);
        $this->free_result($this->result);
        return $returnarray;
    }

    /*
      // Execute SELECT Query
      // Field type: string
     */

    function exec_select($table, $field, $exp, $return=false) {
        $this->is_table($table);
        if ($field) {
            $this->query_string = "SELECT $field FROM $table $exp";
            if ($return == false) {
                return $this->query("SELECT $field FROM $table $exp");
            } else {
                return $this->query_first("SELECT $field FROM $table $exp");
            }
        }
    }

    /*
      // Execute INSERT Query
      // $Data[$field_array][$data_array]
     */

    function exec_insert($table, $data) {
        $this->is_table($table);
        if (is_array($data)) {
            // parse data
            $field_arr = array();
            $data_arr = array();

            $i = 0;
            foreach ($data as $key => $value) {
                $field_arr[$i] = $key;
                $data_arr[$i] = $this->quote($value);

                $i++;
            }

            $field_list = implode(',', $field_arr);
            $data_list = implode(',', $data_arr);

            $this->query_string = "INSERT INTO $table ($field_list) VALUES ($data_list)";
            // executing query
            $this->query($this->query_string);

            return true;
        } else {
            $this->exec_error('Error occurred during INSERT QUERY executing.
			Data is not an array
			');
        }

        return false;
    }

    /*
      // Execute UPDATE Query
      // $Data[$field_array][$data_array]
     */

    function exec_update($table, $data, $exp) {
        $this->is_table($table);
        if (is_array($data)) {
            if ($exp) {
                $set_value_string = '';
                $i = 0;
                foreach ($data as $key => $item) {
                    if ($this->AddQuoteOnExecQuery == "true")
                        $set_value_string .= $key . "=" . $this->quote($item) . ",";
                    else
                        $set_value_string .= $key . "='" . $item . "',";
                    $i++;
                }
                $set_value_string = substr($set_value_string, 0, -1);
                $this->query_string = "UPDATE $table SET $set_value_string WHERE $exp";
                $this->query($this->query_string);
            } else {
                $this->exec_error('Error occurred UPDATE QUERY executing');
            }
        } else {
            $this->exec_error('Error occurred during UPDATE QUERY executing.
			Data is not an array
			');
        }
    }

    /*
      // Execute DELETE Query
     */

    function exec_delete($table, $exp) {
        $this->is_table($table);
        if ($exp) {
            $this->query_string = "DELETE FROM $table WHERE $exp";
            $this->query($this->query_string);
            return true;
        } else {
            $this->exec_error('Error occurred DELETE QUERY executing');
            return false;
        }
    }

    // =========================================
    // Fetch data and data returning
    // =========================================
    /*
      // fetch array
     */
    function fetch_array($query_id) {
        $this->record = mysql_fetch_array($query_id);
        return $this->record;
    }

    /*
      // fetch row
     */

    function fetch_row($query_id) {
        $this->record = mysql_fetch_array($query_id);
        return $this->record;
    }

    /*
      // fetch all
     */

    function fetch_all($obj) {

        $return_data = array();

        while ($r = $this->fetch_array($obj)) {
            $return_data[] = $r;
        }

        return $return_data;
    }

    /*
      // query execute
      // return num rows
     */

    function num_rows($query_id=-1) {
        if ($query_id != -1)
            $this->query_id = $query_id;
        return mysql_num_rows($this->query_id);
    }

    /*
      // Free query result
     */

    function free_result($query_id) {
        return @mysql_free_result($query_id);
    }

    /*
      // Return tables information from DB selected
     */

    function tbl_list() {
        $sql = mysql_query("SHOW TABLE STATUS FROM " . $this->db['db']);
        while ($row = mysql_fetch_array($sql)) {
            $tbl[] = $row;
        }
        return $tbl;
        mysql_free_result($sql);
    }

    // =========================================
    // Required methods
    // =========================================
    /*
      // Valid table name
     */
    function is_table($table) {
        $tbl_list = array();
        $result = mysql_list_tables($this->db['db']);
        while ($row = mysql_fetch_row($result)) {
            $tbl_list[] = $row[0];
        }
        if (in_array($table, $tbl_list) == true) {
            return true;
        } else {
            $this->exec_error("Table doesn't exists");
            return false;
        }
    }

    // =========================================
    // API returning
    // =========================================
    function api_querystr() {
        return $this->query_string;
    }

    // =========================================
    // Error reporting
    // =========================================
    /*
      // Executing error
     */
    function exec_error($error) {
        if ($error) {
            $this->sql_error($error, 'N/A');
        }
    }

    /*
      // Error handle
     */

    function sql_error($message, $query) {

        if (function_exists(ob_start()))
            ob_clean();

        if ($this->Debug == true) {
            die("
			<font style='font-family:tahoma;font-size:11px;'>
			<strong>MySQL Error:</strong> $message<br>
			<strong>Error number:</strong> " . mysql_errno() . " " . mysql_error() . "<br>
			<strong>Query String:</strong> " . $query . "<br>
			<strong>Date:</strong> " . date("D, F j,Y H:i:s") . "<br>
			<strong>Your IP:</strong> " . getenv("REMOTE_ADDR") . "<br>
			<strong>Your browser:</strong> " . getenv("HTTP_USER_AGENT") . "<br>
			<strong>Script:</strong> " . getenv("REQUEST_URI") . "<br>
			<strong>Referer:</strong> " . getenv("HTTP_REFERER") . "<br>
			<strong>PHP Version:</strong> " . PHP_VERSION . "<br>
			<strong>OS:</strong> " . PHP_OS . "<br>
			<strong>Server:</strong> " . getenv("SERVER_SOFTWARE") . "<br>
			<strong>Server name:</strong> " . getenv("SERVER_NAME") . "<br>
			");
        } else {
            $a = gmdate('h-i d-m-Y') . ": " . mysql_errno() . " " . mysql_error() . "\n";

            if (is_dir('.')) {
                $handle = gmdate('d-m-Y');

                if (($handle = fopen($handle, 'a+')) === FALSE) {
                    return false;
                } else {
                    if (fwrite($handle, $a) === FALSE) {
                        return false;
                    }
                    else
                        return true;

                    fclose($handle);
                }
            }
            header('location: ' . URL_ROOT . '/errors/500.html');
        }

        exit();
    }

    // =========================================
    // Mysql Close
    // =========================================
    function Close() {
        mysql_close();
    }

}

?>