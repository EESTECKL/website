<?php
class dbCnt /* {{{ */
{
	var $dbhost_ = 'localhost';
        var $dbuser_ = 'eestec';
        var $dbpass_ = 'KL#obs';
        var $database_;
        var $conn_;

	function connect($database)
	{
            $this->conn_ = mysql_connect($this->dbhost_,$this->dbuser_, $this->dbpass_);
            if (!mysql_select_db($database))
                die("Can't select database");
            else
                $this->database_ = $database;
            return $this->conn_;
	}
        function closeConn()
	{
            if($this->conn_)
            {
              mysql_close($this->conn_);
            }
	}
        
        function exeQuery($query)
        {
             return mysql_query($query);
        }
        
}

?>
