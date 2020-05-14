<?php
session_start();
echo var_export ($_SESSION,true);
require("config.php");
                $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
                $db = new PDO($connection_string, $dbuser, $dbpass);
if(isset($_GET['id'])){
 $stmt = $db->prepare("select * from todo where ID=:ID");
 $params = array(":ID"=>$_GET['id']);
                        $stmt->execute($params);
 $result = $stmt->fetch(PDO::FETCH_ASSOC); 
 echo var_export($stmt->errorInfo(), true);
 echo var_export($result, true);
}
if(isset($_POST['save'])){
require("config.php");
                $connection_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
                try {
                        $db = new PDO($connection_string, $dbuser, $dbpass);
                        $stmt = $db->prepare("UPDATE `todo` SET Completed=:c, Content=:con Where ID=:ID");
                        $ID = $_POST['ID'];
                        $content = $_POST['content'];
                        $completed = $_POST['completed'];
                        $userID=$_SESSION['user']['id'];
                        $params = array(":c"=> $completed,":con"=>$content,
                                                ":ID"=> $ID);
                        $stmt->execute($params);
                        echo "<pre>" . var_export($stmt->errorInfo(), true) . "</pre>";
                }
                catch(Exception $e){
                        echo $e->getMessage();
                        exit();
                }
}
?> 
<?php if(isset($result)):?>
<form name="loginform" id="myForm" method="POST">
			<label for="email">Todo: </label>
      <input type="hidden" id="email" name="ID" placeholder="todoitem" value="<?php echo $result['ID']; ?>"/>
			<input type="text" id="email" name="content" placeholder="todoitem" value="<?php echo $result['Content']; ?>"/>
      <input type="text" id="email" name="completed" placeholder="todoitem" value="<?php echo $result['Completed']; ?>"/>
			<input type="submit" name="save" value="save"/>
		</form>
   <?php endif;?>
   
