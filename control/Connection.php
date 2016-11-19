<?php
final class Connection{

  public static function open(){
      $conn = mysqli_connect('localhost:3306', 'root','','2101_airlines');
      mysqli_set_charset($conn, "utf8");
      if (!$conn) {
         $conn=null;
      }
      return $conn;
  }

  public static function closeConnection($conn){
             mysqli_close($conn);
  }
}
?>
