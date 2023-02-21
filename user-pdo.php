<?php


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
    public $_SESSION;


    // methodes
    public function __construct()
    {
        $username="root";
        $password="";
        try{
            $this->bd = new PDO("mysql:host=localhost;dbname=classes;charset=utf8mb4", $username, $password); 
            // sans le charset, la bdd ne se connecte pas
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        }catch (PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
        

    }
    public function register(
        $login,
        $password,
        $email,
        $firstname,
        $lastname
    ) {
        $request = $this->bd->query('INSERT INTO `utilisateurs` (id, login, password, email, firstname, lastname) VALUES (NULL, "$login", "$password", "$email", "$firstname", "$lastname");');
        $result = $request->fetch_all(MYSQLI_ASSOC);
        $_SESSION = $result[0];
        return $result;
    }
    public function connect($login, $password)
    {
        $request = $this->$bd->query("SELECT * FROM utilisateurs WHERE login='$login' AND password='$password'");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        if (mysqli_num_rows($request) == 0) {
            $message = "votre login ou mdp est incorrect";
        } else {
            $_SESSION = $result[0];
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
        $request = $this->mysqli->query("DELETE FROM utilisateurs WHERE id='$_SESSION[id]' ");
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
        $request = $this->mysqli->query("UPDATE utilisateurs SET login='$login',password='$password', email='$email', firstname='$firstname',lastname='$lastname' WHERE id='$_SESSION[id]'");
    }
    public function isConnected()
    {
        if (!empty($_SESSION)) {
            return;
        }
    }
    public function getAllInfos()
    {
        $request = $this->mysqli->query("SELECT * FROM utilisateurs WHERE id='$_SESSION[id]'");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getLogin()
    {
        $request = $this->mysqli->query("SELECT login FROM utilisateurs WHERE id='$_SESSION[id]'");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function GetEmail()
    {
        $request = $this->mysqli->query("SELECT email FROM utilisateurs WHERE id='$_SESSION[id]'");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getFirstname()
    {
        $request = $this->mysqli->query("SELECT firstname FROM utilisateurs WHERE id='$_SESSION[id]'");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    public function getLastName()
    {
        $request = $this->mysqli->query("SELECT lastname FROM utilisateurs WHERE id='$_SESSION[id]'");
        $result = $request->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}

$user=new UserPDO();

// // $user->register('cam6','cam6', 'cam@6', 'cam6', 'cam6');
// // $user->register('cam11','cam11', 'cam11@', 'cam11', 'cam11');
// // $user->register('cam2222','cam222', 'cam222@', 'cam222', 'cam222');
// $user->connect('cam222','cam222');


// // $user->disconnect();
// // $user->delete();
// // $user->update('cam20', 'cam20', 'cam20@', 'cam20', 'cam20' )
// $user->getLogin();
// // $user->getAllInfos();
