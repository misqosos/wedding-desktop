<?php
    include ("../database.class.php")
?>

<?php
    class Mitko {
        // private $id;
        // private $surname;
        // private $dob;
        // private $meetingPlace;
        // private $age;
        // private $hobbies = [];
        // private $car;
        // private $height;
        // private $favSport;
        // private $hasSeenParentsFirst;
        // private $isAllCorrect;

        // public function __construct() {}

        // public function __construct1($id, $surname, $dob, $meetingPlace, $hobbies, $car, $height, $favSport, $hasSeenParentsFirst) {
        //     $this->id = $id;
        //     $this->surname = $surname;
        //     $this->dob = $dob;
        //     $this->meetingPlace = $meetingPlace;
        //     $this->hobbies = $hobbies;
        //     $this->car = $car;
        //     $this->height = $height;
        //     $this->favSport = $favSport;
        //     $this->hasSeenParentsFirst = $hasSeenParentsFirst;
        // }

        // public function __construct2($surname, $dob, $meetingPlace, $hobbies, $car, $height, $favSport, $hasSeenParentsFirst) {
        //     $this->surname = $surname;
        //     $this->dob = $dob;
        //     $this->meetingPlace = $meetingPlace;
        //     $this->hobbies = $hobbies;
        //     $this->car = $car;
        //     $this->height = $height;
        //     $this->favSport = $favSport;
        //     $this->hasSeenParentsFirst = $hasSeenParentsFirst;
        // }

        // public function __construct3($surname, $dob, $meetingPlace, $hobbies, $car, $height, $favSport, $hasSeenParentsFirst, $isAllCorrect) {
        //     $this->surname = $surname;
        //     $this->dob = $dob;
        //     $this->meetingPlace = $meetingPlace;
        //     $this->hobbies = $hobbies;
        //     $this->car = $car;
        //     $this->height = $height;
        //     $this->favSport = $favSport;
        //     $this->hasSeenParentsFirst = $hasSeenParentsFirst;
        //     $this->isAllCorrect = $isAllCorrect;
        // }

        function postMitko($mitko){
            $sql = 'INSERT INTO wedding.mitko (surname, dob, meetingPlace, age, hobbies, car, height, favSport, hasSeenParentsFirst, isAllCorrect) 
                    VALUES 
                    (
                        /*surname*/?,
                        /*dob*/?,
                        /*meetingPlace*/?,
                        /*age*/?,
                        /*hobbies*/?,
                        /*car*/?,
                        /*height*/?,
                        /*favSport*/?,
                        /*hasSeenParentsFirst*/?,
                        /*isAllCorrect*/?
                    )';
            
            $stmt = DbConnection::getDatabaseConnection()->prepare($sql); /*mysqli_prepare($db->getDatabaseConnection(), $sql);*/
            $stmt->bind_param('sssissisii', $surname, $dob, $meetingPlace, $age, $hobbies, $car, $height, $favSport, $hasSeenParentsFirst, $isAllCorrect);
            
            $surname = $mitko->surname;
            $dob = $mitko->dob;
            $meetingPlace = $mitko->meetingPlace;
            $age = $mitko->age;
            $hobbies = json_encode($mitko->hobbies);
            $car = $mitko->car;
            $height = $mitko->height;
            $favSport = $mitko->favSport;
            $hasSeenParentsFirst = $mitko->hasSeenParentsFirst == "true" ? 1 : (is_null($mitko->hasSeenParentsFirst) ? null : 0);
            $isAllCorrect = $mitko->isAllCorrect == "true" ? 1 : (is_null($mitko->isAllCorrect) ? null : 0);

            $stmt->execute();

            return $this->getPostedRecord();
    
            if($stmt->num_rows() > 0)
            {
                return $arr_json = array('status' => 200);
            }else{
                return $arr_json = array('status' => 400);
            }
        }

        function getCorrectMitko(){
            $sql = 'SELECT * FROM wedding.mitko WHERE id = 1';
            
            $result = DbConnection::getDatabaseConnection()->query($sql); /*mysqli_query($db->getDatabaseConnection(), $sql);*/
            $row = $result->fetch(PDO::FETCH_ASSOC); /*mysqli_fetch_assoc($result);*/
            return json_encode($row);
        }

        function getPostedRecord(){
            $sql = 'SELECT * FROM wedding.mitko ORDER BY id DESC LIMIT 1';
            
            $result = DbConnection::getDatabaseConnection()->query($sql); /*mysqli_query($db->getDatabaseConnection(), $sql);*/
            $row = $result->fetch(PDO::FETCH_ASSOC); /*mysqli_fetch_assoc($result);*/
            return json_encode($row);
        }


    }
?>