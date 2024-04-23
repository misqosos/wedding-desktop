<?php
    include ("../database.class.php")
?>

<?php
    class Domka {
        // private $id;
        // private $surname;
        // private $dob;
        // private $email;
        // private $age;
        // private $hobbies = [];
        // private $hairColor;
        // private $height;
        // private $favColor;
        // private $sentFirstMessage;
        // private $isAllCorrect;

        // public function __construct() {}

        // public function __construct1($id, $surname, $dob, $email, $hobbies, $hairColor, $height, $favColor, $sentFirstMessage) {
        //     $this->id = $id;
        //     $this->surname = $surname;
        //     $this->dob = $dob;
        //     $this->email = $email;
        //     $this->hobbies = $hobbies;
        //     $this->hairColor = $hairColor;
        //     $this->height = $height;
        //     $this->favColor = $favColor;
        //     $this->sentFirstMessage = $sentFirstMessage;
        // }

        // public function __construct2($surname, $dob, $email, $hobbies, $hairColor, $height, $favColor, $sentFirstMessage) {
        //     $this->surname = $surname;
        //     $this->dob = $dob;
        //     $this->email = $email;
        //     $this->hobbies = $hobbies;
        //     $this->hairColor = $hairColor;
        //     $this->height = $height;
        //     $this->favColor = $favColor;
        //     $this->sentFirstMessage = $sentFirstMessage;
        // }

        // public function __construct3($surname, $dob, $email, $hobbies, $hairColor, $height, $favColor, $sentFirstMessage, $isAllCorrect) {
        //     $this->surname = $surname;
        //     $this->dob = $dob;
        //     $this->email = $email;
        //     $this->hobbies = $hobbies;
        //     $this->hairColor = $hairColor;
        //     $this->height = $height;
        //     $this->favColor = $favColor;
        //     $this->sentFirstMessage = $sentFirstMessage;
        //     $this->isAllCorrect = $isAllCorrect;
        // }

        function postDomka($domka){
            $sql = 'INSERT INTO wedding.domka (surname, dob, email, age, hobbies, hairColor, height, favColor, sentFirstMessage, isAllCorrect) 
                    VALUES 
                    (
                        /*surname*/?,
                        /*dob*/?,
                        /*email*/?,
                        /*age*/?,
                        /*hobbies*/?,
                        /*hairColor*/?,
                        /*height*/?,
                        /*favColor*/?,
                        /*sentFirstMessage*/?,
                        /*isAllCorrect*/?
                    )';
            
            $stmt = DbConnection::getDatabaseConnection()->prepare($sql); /*mysqli_prepare($db->getDatabaseConnection(), $sql);*/
            $stmt->bind_param('sssissisii', $surname, $dob, $email, $age, $hobbies, $hairColor, $height, $favColor, $sentFirstMessage, $isAllCorrect);
            
            $surname = $domka->surname;
            $dob = $domka->dob;
            $email = $domka->email;
            $age = $domka->age;
            $hobbies = json_encode($domka->hobbies);
            $hairColor = $domka->hairColor;
            $height = $domka->height;
            $favColor = $domka->favColor;
            $sentFirstMessage = $domka->sentFirstMessage == "true" ? 1 : (is_null($domka->sentFirstMessage) ? null : 0);
            $isAllCorrect = $domka->isAllCorrect == "true" ? 1 : (is_null($domka->isAllCorrect) ? null : 0);

            $stmt->execute();

            return $this->getPostedRecord();
    
            if($stmt->num_rows() > 0)
            {
                return $arr_json = array('status' => 200);
            }else{
                return $arr_json = array('status' => 400);
            }
        }

        function getCorrectDomka(){
            $sql = 'SELECT * FROM wedding.domka WHERE id = 1';
            
            $result = DbConnection::getDatabaseConnection()->query($sql); /*mysqli_query($db->getDatabaseConnection(), $sql);*/
            $row = $result->fetch(PDO::FETCH_ASSOC); /*mysqli_fetch_assoc($result);*/
            return json_encode($row);
        }

        function getPostedRecord(){
            $sql = 'SELECT * FROM wedding.domka ORDER BY id DESC LIMIT 1';
            
            $result = DbConnection::getDatabaseConnection()->query($sql); /*mysqli_query($db->getDatabaseConnection(), $sql);*/
            $row = $result->fetch(PDO::FETCH_ASSOC); /*mysqli_fetch_assoc($result);*/
            return json_encode($row);
        }


    }
?>