<?php
$server = 'localhost';
$name = 'root';
$pwd = '';
$base = 'slt';

$conn = mysqli_connect($server, $name, $pwd, $base);

function dbquery($sql)
{
  global $conn;
  $result = mysqli_query($conn, $sql);
  $res = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
  return $res;
}

function dbexecute($sql)
{
  global $conn;
  if(mysqli_query($conn, $sql))
  {
    return true;
  }
  return false;
}
