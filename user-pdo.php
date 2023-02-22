<?php
session_start();
class UserPDO
{
    // les atributs
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    public $mysqli;
    private $password;
   


    // methodes
    public function __construct()
    {
        $username="root";
        $password="";
        try{
            $this->bd = new PDO("mysql:host=localhost;dbname=classes;charset=utf8mb4", $username, $password);
            // $this->bd = new PDO("mysql:host=localhost;dbname=classes;charset=utf8mb4", "root", ""); marche aussi
            // même sans le charset, la bdd ne se connecte pas
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        }catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        

    }
    public function register($login,
    $password,
    $email,
    $firstname,
    $lastname){
        $req = $this->bd->prepare("INSERT INTO utilisateurs(login,password,email,firstname,lastname)VALUES(?,?,?,?,?)");
        $req->execute([$login, $password, $email, $firstname, $lastname]);

        $req2 = $this->bd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $req2->execute([$_SESSION['login']]);
        $result = $req2->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($result);
        return $result;
    
    }
    public function connect($login, $password)
    {
        $req=$this->bd->prepare("select * from utilisateurs where login=? and password=?");
        $req->execute([$login, $password]);
        $count = $req->rowCount();
        if ($count == 0) {
            $message = "votre login ou mdp est incorrect";
        } else {
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;
            $message = "vous etes connecté";
        }
        echo $message;
    }

    public function disconnect()
    {
        session_destroy();
        echo " Vous avez été déconnecté";
        exit;
    }
    public function delete()
    {
        $req=$this->bd->prepare("delete from utilisateurs where login=?");
        $req->execute([$_SESSION['login']]);
        session_destroy();
        echo " Vous avez été delete";
        exit;
    }
    public function update(
        $login,
        $password,
        $email,
        $firstname,
        $lastname
    ) {
        $req=$this->bd->prepare("UPDATE utilisateurs SET login=?, password=?, email=?, firstname=?, lastname=? WHERE login = ?");
        $req->execute([$login, $password, $email, $firstname, $lastname, $_SESSION['login']]);
    }
    public function isConnected()
    {
        if (isset($_SESSION['login'])) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllInfos()
    {
        $req = $this->bd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $req->execute([$_SESSION['login']]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        return $result;;
    }
    public function getLogin()
    {
        $req = $this->bd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $req->execute([$_SESSION['login']]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result[0]['login']);
        return $result[0]['login'];
    }
    public function GetEmail()
    {
        $req = $this->bd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $req->execute([$_SESSION['login']]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result[0]['email']);
        return $result[0]['email'];
    }
    public function getFirstname()
    {
        $req = $this->bd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $req->execute([$_SESSION['login']]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result[0]['firstname']);
        return $result[0]['firstname'];
    }
    public function getLastName()
    {
        $req = $this->bd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $req->execute([$_SESSION['login']]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result[0]['lastname']);
        return $result[0]['lastname'];
    }
}

$user=new UserPDO();
var_dump($_SESSION);
// $user->register("cam1","cam1", "cam1@", "cam1", "cam1");
// $user->register("cam22","cam22", "cam22@", "cam22", "cam22");
// $user->register('cam6','cam6', 'cam@6', 'cam6', 'cam6');
// // $user->register('cam2222','cam222', 'cam222@', 'cam222', 'cam222');
// $user->connect("cam20","cam20");
// $user->disconnect();
// $user->delete();
// $user->update('cam20', 'cam20', 'cam20@', 'cam20', 'cam20');
// $user->isConnected();
// $user->getAllInfos();
// $user->getLogin();
// $user->getEmail();
// $user->getFirstname();
// $user->getLastname();

