<?php
session_start();



class User{
    // les atributs
private $id;
 public $login;
 public $email;
 public $firstname;
public $lastname;
public $mysqli;
private $password;
public $_SESSION;


// methodes
public function __construct(){
    $this->mysqli = new mysqli('localhost', 'root', '', 'classes');
    
}
public function register($login, $password,
$email, $firstname,
$lastname){
    $request=$this->mysqli->query("INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `firstname`, `lastname`) VALUES (NULL, '$login', '$password', '$email', '$firstname', '$lastname');");
    $result = $request->fetch_all(MYSQLI_ASSOC);  
    $_SESSION = $result[0]; 
    return $result;
  
  
}
public function connect($login, $password){
$request=$this->mysqli->query("SELECT * FROM utilisateurs WHERE login='$login' AND password='$password'");
$result=$request->fetch_all(MYSQLI_ASSOC);  
if(mysqli_num_rows($request) == 0){
    $message = "votre login ou mdp est incorrect";}
    else{
        // $_SESSION['login'] = $login;
        // $_SESSION['password'] = $password;
        $_SESSION = $result[0];
$message = "vous etes connecté";
    }
echo $message;

}

public function disconnect(){
    session_destroy();
    echo " Vous avez été déconnecté";
    exit;
    
}
public function delete(){
    $request=$this->mysqli->query("DELETE FROM utilisateurs WHERE id='$_SESSION[id]' ");
    session_destroy();
    echo " Vous avez été delete";
    exit;
}
public function update($login, $password,
$email, $firstname,
$lastname){
    $request=$this->mysqli->query("UPDATE utilisateurs SET login='$login',password='$password', email='$email', firstname='$firstname',lastname='$lastname' WHERE id='$_SESSION[id]'");
}
public function isConnected() {
    if (isset($_SESSION['login'])) {
        return true;
    } else {
        return false;
    }
}
public function getAllInfos(){
    $request=$this->mysqli->query("SELECT * FROM utilisateurs WHERE id='$_SESSION[id]'");
    $result=$request->fetch_all(MYSQLI_ASSOC); 
   return $result ;
}
public function getLogin(){
    $request=$this->mysqli->query("SELECT login FROM utilisateurs WHERE id='$_SESSION[id]'");
    $result=$request->fetch_all(MYSQLI_ASSOC); 
   return $result ;
}
public function GetEmail(){
    $request=$this->mysqli->query("SELECT email FROM utilisateurs WHERE id='$_SESSION[id]'");
    $result=$request->fetch_all(MYSQLI_ASSOC); 
   return $result ;
}
public function getFirstname(){
    $request=$this->mysqli->query("SELECT firstname FROM utilisateurs WHERE id='$_SESSION[id]'");
    $result=$request->fetch_all(MYSQLI_ASSOC); 
   return $result ;
}
public function getLastName(){
    $request=$this->mysqli->query("SELECT lastname FROM utilisateurs WHERE id='$_SESSION[id]'");
    $result=$request->fetch_all(MYSQLI_ASSOC); 
   return $result ;
}
}

$user=new User();

// $user->register('cam6','cam6', 'cam@6', 'cam6', 'cam6');
// $user->register('cam11','cam11', 'cam11@', 'cam11', 'cam11');
// $user->register('cam2222','cam222', 'cam222@', 'cam222', 'cam222');
$user->connect('cam222','cam222');


// $user->disconnect();
// $user->delete();
// $user->update('cam20', 'cam20', 'cam20@', 'cam20', 'cam20' )
$user->getLogin();
// $user->getAllInfos();

?>