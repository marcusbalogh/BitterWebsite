<?php


class Student
{
    private $name;
    private $studentId;
    protected $address; // can only be accessed by child subclasses
    CONST numCourses = 5; // no dollar sign for constants, can't be overwritten

    //use this
    final public function __get($property) // can not be overridden in subclass
    {
        return $this->$property;
    }
    public function __set($property,$value)
    {
        $this->$property = $value;
    }



    // dont use this
//    public function getName(){
//        return $this->name;
//    }
//    public function setName($n){
//        $this->name = $n;
//    }

    //constructor
    public function __construct($name,$studentId)
    {
        $this -> studentId = $studentId;
        $this -> name = $name;
    }
    // this is not java, you can not overload methods.functions
//    public function __construct()
//    {
//        $this -> studentId = $studentId;
//        $this -> name = $name;
//    }

    //destructor
    //gets called at the end of page load
    public function __destruct()
    {
        echo "<BR>" . "OBJECT DESTROYED" ."<BR>";

        // TODO: Implement __destruct() method.
        // close db con here
        // or file con
    }

    public static function PrintSchool(){
        echo "<br>NBCC<br>";
    }

    //public abstract function SomeMethod(); // yeey i'm abstract

}