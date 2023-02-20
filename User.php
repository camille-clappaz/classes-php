<?php
session_start();
// $mysqli = new mysqli('localhost', 'root', '', 'classes');


class User{
    // les atributs
private $id;
 public $login;
 public $email;
 public $firstname;
public $lastname;
public $mysqli;
public $_SESSION;


// methodes
public function __construct(){
    $this->mysqli = new mysqli('localhost', 'root', '', 'classes');
    
}
public function register($login, $password,
$email, $firstname,
$lastname){
    $request=$this->mysqli->query("INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `firstname`, `lastname`) VALUES (NULL, '$login', '$password', '$email', '$firstname', '$lastname');");
    $request2=$this->mysqli->query("SELECT * FROM utilisateurs ");
    $result = $request2->fetch_all(MYSQLI_ASSOC);  
    $_SESSION = $result[0]; 
  
}
public function connect($login, $password){
$request=$this->mysqli->query("SELECT * FROM utilisateurs WHERE login='$login' AND password='$password'");
$result=$request->fetch_all(MYSQLI_ASSOC);  
if(mysqli_num_rows($request) == 0){
    $message = "votre login ou mdp est incorrect";}
    else{
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
public function isConnected(){
    
}
public function getAllInfos(){
    
}
public function getLogin(){
    
}
public function GetEmail(){
    
}
public function getFirstname(){
    
}
public function getLastName(){}
}

$user=new User();
// $user->register('cam','cam', 'cam@', 'cam', 'cam');
// $user->register('cam1','cam1', 'cam1@', 'cam1', 'cam1');
// $user->register('cam2','cam2', 'cam2@', 'cam2', 'cam2');
$user->connect('cam2','cam2');
// $user->disconnect();
// $user->delete();
// $user->update('cam20', 'cam20', 'cam20@', 'cam20', 'cam20' )

?>