<?php

class MidtermDao {

    private $conn;

    /**
    * constructor of dao class
    */
    public function __construct(){
        try {

          $host = "db-mysql-nyc1-51552-do-user-3246313-0.b.db.ondigitalocean.com"; 
          $dbname = "midterm-2023"; 
          $user = "doadmin"; 
          $pass = "AVNS_sQwKZryHF62wtg6XNoi"; 


        /*options array neccessary to enable ssl mode - do not change*/
        $options = array(
        	PDO::MYSQL_ATTR_SSL_CA => 'https://drive.google.com/file/d/1g3sZDXiWK8HcPuRhS0nNeoUlOVSWdMAg/view?usp=share_link',
        	PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,

        );
        /** TODO
        * Create new connection
        * Use $options array as last parameter to new PDO call after the password
        */

        // set the PDO error mode to exception
          $this->conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

    /** TODO
    * Implement DAO method used to get cap table
    */
    public function cap_table(){
      $query = "SELECT share_classes.id, share_classes.description as class, share_class_categories.description as category, CONCAT(investors.first_name, investors.last_name) as name, cap_table.diluted_shares
      FROM share_classes JOIN share_class_categories ON share_classes.id = share_class_categories.share_class_id
      JOIN cap_table ON share_classes.id = cap_table.share_class_id
      JOIN investors ON cap_table.investor_id = investors.id";

      $stmt = $this->conn->query($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
    * Implement DAO method used to get summary
    */
    public function summary(){
        $query = "SELECT count(distinct investors.id), sum(cap_table.diluted_shares)
        from cap_table join investors on cap_table.investor_id = investors.id";

        $stmt = $this->conn->query($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
    * Implement DAO method to return list of investors with their total shares amount
    */
    public function investors(){

    }
}
?>
