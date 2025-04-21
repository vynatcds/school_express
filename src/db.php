<?
$db = new PDO('sqlite:mydatabase.sqlite');
if (isset($db)) {
   
} else {
    echo "Database Connection Failed.";
}
?>