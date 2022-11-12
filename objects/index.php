<?php 
    class User{
        protected $username;
        protected $password;

        function __construct(){
        }

        function setUsername($username){
            $this->username = $username;
        }

        function setPassword($password){
            $this->password = $password;
        }

        function getUsername(){
            return $this->username;
        }
    }

    class Person{
        protected $name;
        protected $surname;

        function setName($name){
            $this->name = $name;
        }
        
        function setSurname($surname){
            $this->surname = $surname;
        }

        function getName(){
            return $this->name;
        }
        
        function getSurname(){
            return $this->surname;
        }
    }

    class Student extends Person{
        protected $id;

        function setId($id){
            $this->id = $id;
        }

        function getId(){
            return $this->id;
        }

    }

    $user = new User();
    $user->setUsername("Urlo");
    $user->setPassword('Sium');

    echo "Username: " . $user->getUsername();

    $student = new Student();
    $student->setName("Mimmo");
    $student->setSurname("Criscito");
    $student->setId("15");

    echo "<br><br>Name: " . $student->getName() . "<br>Surname: " . $student->getSurname() , "<br>ID: " . $student->getId();
?>