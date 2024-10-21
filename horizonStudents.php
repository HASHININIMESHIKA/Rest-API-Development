<?php
class horizonStudents {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllStudents() {
        $stmt = $this->db->prepare("SELECT * FROM horizonstudents ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getStudent($id) {
        $stmt = $this->db->prepare("SELECT * FROM horizonstudents WHERE IndexNo = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    
       
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
       
        if ($result) {
            return $result;
        } else {
            
            return array('message' => 'No student found with the given ID.');
        }
    }
    

    public function addStudent($data) {
     
            $stmt = $this->db->prepare("INSERT INTO horizonstudents (IndexNo, FirstName, LastName, City, District, Province, EmailAddress, MobileNumber) VALUES (:index_no, :first_name, :last_name, :city, :district, :province, :email_address, :mobile_number)");
        
            
            $stmt->bindParam(':index_no', $data['IndexNo']);
            $stmt->bindParam(':first_name', $data['FirstName']);
            $stmt->bindParam(':last_name', $data['LastName']);
            $stmt->bindParam(':city', $data['City']);
            $stmt->bindParam(':district', $data['District']);
            $stmt->bindParam(':province', $data['Province']);
            $stmt->bindParam(':email_address', $data['EmailAddress']);
            $stmt->bindParam(':mobile_number', $data['MobileNumber']);
        
            
            $stmt->execute();
        
            return $this->db->lastInsertId();
        
        
    }

    public function updateStudent($id, $data) {

        $stmt = $this->db->prepare("UPDATE horizonstudents SET FirstName = :First_Name, LastName = :Last_Name, City = :City, District = :District, Province = :Province, EmailAddress = :Email_Address, MobileNumber = :Mobile_Number WHERE IndexNo = :id");

           
            $stmt->bindParam(':First_Name', $data['FirstName']);
            $stmt->bindParam(':Last_Name', $data['LastName']);
            $stmt->bindParam(':City', $data['City']);
            $stmt->bindParam(':District', $data['District']);
            $stmt->bindParam(':Province', $data['Province']);
            $stmt->bindParam(':Email_Address', $data['EmailAddress']);
            $stmt->bindParam(':Mobile_Number', $data['MobileNumber']);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            
            return $stmt->rowCount();

    }
    public function deleteStudent($id) {
        $stmt = $this->db->prepare("DELETE FROM horizonstudents WHERE IndexNo = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    
    
}
?>
