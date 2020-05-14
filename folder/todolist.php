<?php
session_start();

echo var_export ($_SESSION,true);

require("config.php");
	$connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
		$db = new PDO($connection_string, $dbuser, $dbpass);
		$stmt = $db->prepare("SELECT * from todo");
		
       // $params = array(":email"=> $email);
        $stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
    echo "<pre>" . var_export($result, true) . "</pre>";

?>
<ul>

<?php foreach($result as $index=>$row):?>
<li>
	<?php echo $row['Content'];?>
</li> 
<?php endforeach;?>

</ul>
