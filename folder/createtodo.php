<?php
session_start();
echo var_export ($_SESSION,true);
require("config.php");
                $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
                $db = new PDO($connection_string, $dbuser, $dbpass);

if(isset($_POST['save'])){
                        $stmt = $db->prepare("INSERT INTO `todo`
                                                        (Content, UserID) VALUES
                                                        (:c, :u)");
                        $content = $_POST['content'];
                        $userID=$_SESSION['user']['id'];
                        $params = array(":c"=> $content,
                                                ":u"=> $userID);
                        $stmt->execute($params);
                        echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
}
?> 

<form name="loginform" id="myForm" method="POST">
			<label for="email">Todo: </label>
			<input type="text" id="email" name="content" placeholder="todoitem"/>
			<input type="submit" name="save" value="save"/>
		</form>
