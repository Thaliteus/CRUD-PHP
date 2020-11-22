<?php

class Database
{
	
	private $db_host = "localhost";  // Change as required
	private $db_user = "root";  // Change as required
	private $db_pass = "";  // Change as required
	private $db_name = "test";	// Change as required
	private $myconn;
	/*
	 * Extra variables that are required by other function such as boolean con variable
	 */
	private $con = false; // Check to see if the connection is active
	private $result = array(); // Any results from a query will be stored here
	private $myQuery = ""; // used for debugging process with SQL return
	private $numResults = ""; // used for returning the number of rows
	public function __construct()
	{
		$this->myconn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
		if ($this->myconn->connect_errno) {
			printf("Connect failed: %s\n", $this->myconn->connect_error);
			exit();
		}
	}

	

	

	// Function to SELECT from the database
	public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null)
	{
		// Create query from the variables passed to the function
		$q = 'SELECT ' . $rows . ' FROM ' . $table;
		if ($join != null) {
			$q .= ' JOIN ' . $join;
		}
		if ($where != null) {
			$q .= ' WHERE ' . $where;
		}
		if ($order != null) {
			$q .= ' ORDER BY ' . $order;
		}
		if ($limit != null) {
			$q .= ' LIMIT ' . $limit;
		}
		$this->myQuery = $q; // Pass back the SQL
		// Check to see if the table exists

		// The table exists, run the query
		$res = $this->myconn->query($q);
		if ($res) {
			// If the query returns >= 1 assign the number of rows to numResults
			$res->data_seek(0);
			while ($row = $res->fetch_assoc()) {
				array_push($this->result, $row);
			}
			return true; // Query was successful
		} else {

			return false; // No rows where returned
		}
	}

	// Function to insert into the database
	public function insert($table, $data)
	{
		$cols = implode(',', array_keys($data));
		$vals = implode(',', array_values($data));
		$sql = 'INSERT INTO ' . $table . ' (' . $cols . ') VALUES (' . $vals . ')';
		print($sql);
		// Make the query to insert to the database
		$this->myconn->query($sql);
		print($this->myconn->error);
		array_push($this->result, $this->myconn->insert_id);
		return true; // The data has been inserted


	}

	//Function to delete table or row(s) from database
	public function delete($table, $sku)
	{
		$mysqli = $this->myconn;
		$delete = 'DELETE FROM ' . $table . ' WHERE SKU = ' . $sku; // Create query to delete rows

		// Submit query to database
		if ($del = $mysqli->query($delete)) {
			array_push($this->result, $mysqli->affected_rows);
			$this->myQuery = $delete; // Pass back the SQL
			return true; // The query exectued correctly
		} else {
			array_push($this->result, $mysqli->error);
			return false; // The query did not execute correctly
		}
	}

	// Function to update row in database
	public function update($table, $data , $where)
	{
		$mysqli = $this->myconn;

		// Check to see if table exists
		$cols = array_keys($data);
		$vals = array_values($data);
		
		$args = array();
		
		$count = count($data);
	
		for ($i=0; $i < $count ; $i++) { 
		// Seperate each column out with it's corresponding value
		
			array_push($args,$cols[$i] . '=' . $vals[$i] );

		}
			
	
		// Create the query
		$sql = 'UPDATE ' . $table . ' SET ' . implode(',', $args) . ' WHERE ' . $where;
		// Make query to database
		
		$this->myQuery = $sql; // Pass back the SQL

		if ($query = $mysqli->query($sql)) {
			array_push($this->result, $mysqli->affected_rows);
			return true; // Update has been successful
		} else {
			array_push($this->result, $mysqli->error);
			return false; // Update has not been successful
		}
	}



	// Public function to return the data to the user
	public function getResult()
	{
		$val = $this->result;
		$this->result = array();
		return $val;
	}

	//Pass the SQL back for debugging
	public function getSql()
	{
		$val = $this->myQuery;
		$this->myQuery = array();
		return $val;
	}

	//Pass the number of rows back
	public function numRows()
	{
		$val = $this->numResults;
		$this->numResults = array();
		return $val;
	}

}
