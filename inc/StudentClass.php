<?php require_once('config.php');
class Student extends DBController{
	private $conn;

	public function __construct(){
		$this->conn = new DBController();
	}

	public function getAllMarks(){
		$qry = "SELECT sd.id,sd.name, sm.* FROM tb_student_marks AS sm LEFT JOIN tb_student_details AS sd ON sd.id = sm.student_id";
		$data = $this->conn->getJsonArray($qry);
		return $data;
	}

	public function addStudentMark($id = null){
		$std = $this->conn->filterData($_POST['std']);
		$marks = $this->conn->filterData($_POST['marks']);
		$sid = (is_null($id) || !is_numeric($id))?0:$id;
		$qry = "SELECT COUNT(*) AS ct FROM tb_student_details WHERE id !=".$sid." AND name ='".$std['name']."'";
		$check = $this->conn->getCount($qry);
		if($check >= 1){
			return "Name Already exist.";
		}
		if(is_null($id) || !is_numeric($id)){
			$ins = $this->conn->mysqli->prepare("INSERT INTO tb_student_details (name) VALUES (?)");
			$ins->bind_param("s", $std['name']);
			if($ins->execute()){
				$id = $ins->insert_id;
				$ins2 = $this->conn->mysqli->prepare("INSERT INTO tb_student_marks (student_id,mark_1,mark_2,mark_3,total,rank,result) VALUES (?,?,?,?,?,?,?)");
				$ins2->bind_param("iiiiiss", $id,$marks['mark1'],$marks['mark2'],$marks['mark3'],$marks['total'],$marks['rank'],$marks['result']);
				$ins2->execute();
			}
		}
		else{
			$ins = $this->conn->mysqli->prepare("UPDATE tb_student_details SET name=? WHERE id = ?");
			$ins->bind_param("si", $std['name'],$id);
			if($ins->execute()){
				$ins2 = $this->conn->mysqli->prepare("UPDATE tb_student_marks SET mark_1=?,mark_2=?,mark_3=?,total=?,rank=?,result=? WHERE student_id = ?");
				$ins2->bind_param("iiiissi", $marks['mark1'],$marks['mark2'],$marks['mark3'],$marks['total'],$marks['rank'],$marks['result'],$id);
				$ins2->execute();
			}
		}
		return $id;
	}
}
