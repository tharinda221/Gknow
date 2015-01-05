<?php

class Operations
{
	
	public $session_id='';
	public $session_menu='';
	public $session_pg=0;
	public $session_tel='';
	public $session_others='';
    //leaderboard
    public $phoneNo = '';
    public $username = '';
    public $points = 0;
	//check user
    public $check_id='';
    public $check_getuser=0;
    public $check_enterpoints=0;

	public function setSessions($sessions){

		$sql_sessions="INSERT INTO `sessions` (`sessionsid`, `tel`, `menu`, `pg`, `created_at`,`others`) VALUES 
			('".$sessions['sessionid']."', '".$sessions['tel']."', '".$sessions['menu']."', '".$sessions['pg']."', 'CURRENT_TIMESTAMP','".$sessions['others']."')";

		$quy_sessions=mysql_query($sql_sessions);
	}
    public function setUser($sessions){
        
		$sql_setUser="INSERT INTO `user` (`PhoneNo`, `Name`, `Points`) VALUES 
			('".$sessions['phoneNo']."', '".$sessions['username']."', '".$sessions['points']."')";

		$quy_sessions=mysql_query($sql_setUser);
	}

	public function getSession($sessionid){	

		$sql_session="SELECT *  FROM  `sessions` WHERE  sessionsid='". $sessionid."'";
		$quy_sessions=mysql_query($sql_session);
		$fet_sessions=mysql_fetch_array($quy_sessions);
		$this->session_others=$fet_sessions['others'];
		return $fet_sessions;	
	}
	
	public function setcheckuser($sessions){

		$sql_sessions="INSERT INTO `checkuser` (`sessionsid`, `getuser`, `enterpoints`) VALUES 
			('".$sessions['sessionid']."', '".$sessions['getuser']."', '".$sessions['enterpoints']."')";

		$quy_sessions=mysql_query($sql_sessions);
	}
	public function getcheckuser($sessionsid){

		$sql_sessions="SELECT getuser  FROM checkuser WHERE sessionsid ='". $sessionsid."'";

		$quy_sessions=mysql_query($sql_sessions);
		
		$is_user_there = mysql_fetch_array($quy_sessions, MYSQL_NUM);
		
		
		return  $is_user_there[0];
	}


	public function saveSesssion()
	{
		$sql_session="UPDATE  `sessions` SET 
									`menu` =  '".$this->session_menu."',
									`pg` =  '".$this->session_pg."',
									`others` =  '".$this->session_others."'
									WHERE `sessionsid` =  '".$this->session_id."'";
		$quy_sessions=mysql_query($sql_session);
	}
	
	public function updatecheckuser($uservalue,$sessionId)
	{
		$sql_session="UPDATE  `checkuser` SET 
									`getuser` =  '". $uservalue."'
									
									WHERE `sessionsid` =  '". $sessionId."'";
		$quy_sessions=mysql_query($sql_session);
	}
	
	public function Update_Q_Num($Q_Num,$Phone_Num)
	{
		$sql_session="UPDATE  answered SET 
									Question_Number =  '". $Q_Num."'
									
									WHERE Phone_Number =  '". $Phone_Num."'";
		$quy_sessions=mysql_query($sql_session);	
	}
	
	public function updatepoints($sessionId,$enterpoints)
	{
		$sql_session="UPDATE  `checkuser` SET 
									`enterpoints` =  '".$enterpoints."'
									
									WHERE `sessionsid` =  '".$sessionId."'";
		$quy_sessions=mysql_query($sql_session);
	}
	
	public function n_of_incorrect($sessionId)
	{
		$sql_session="SELECT enterpoints FROM checkuser WHERE `sessionsid` =  '".$sessionId."'";	
		$quy_sessions=mysql_query($sql_session);
		$get_Last_Num = mysql_fetch_array($quy_sessions, MYSQL_NUM);
		
		return $get_Last_Num[0];
	}
 
	
	public function update_qno($Phone_Number,$Q_Number)
	{
		$sql_session="UPDATE  `answered` SET 
									`Question_Number` =  '".$Q_Number."'
									
									WHERE `Phone_Number` =  '".$Phone_Number."'";
		$quy_sessions=mysql_query($sql_session);
	}
	
	public function get_q ($questionNo)
	{
		$sql_session="SELECT Question,Ans_1,Ans_2,Ans_3,Ans_4 FROM question WHERE Q_no =  '". $questionNo."'";
		
		$quy_sessions=mysql_query($sql_session);
		$get_question = mysql_fetch_array($quy_sessions, MYSQL_NUM);
		$question=$get_question[0] ."\n"."1.".$get_question[1]." "."2.".$get_question[2]."\n"."3.".$get_question[3]." "."4.".$get_question[4];
		return $question;
		
	}
	
	public function get_last_q_num($Phone_Number)
	{
		$sql_session="SELECT Question_Number FROM answered WHERE Phone_Number =  '". $Phone_Number."'";	
		$quy_sessions=mysql_query($sql_session);
		$get_Last_Num = mysql_fetch_array($quy_sessions, MYSQL_NUM);
		
		return $get_Last_Num[0];
	}
	
	public function Correct_Val($Q_Num)
	{
		$sql_session="SELECT Correct_Ans FROM question WHERE Q_No =  '". $Q_Num."'";
		$quy_sessions=mysql_query($sql_session);
		$Correct_Val = mysql_fetch_array($quy_sessions, MYSQL_NUM);
		
		return $Correct_Val[0];	
	
	}
    
    public function updateRank()
	{
		$sql_session="UPDATE  `user` SET 
									`Points` =  '".$this->points."',
									`Rank` =  '".$this->position."'
									WHERE `PhoneNo` =  '".$this->PhoneNo."'";
		$quy_sessions=mysql_query($sql_session);
	}
	public function addpoints($user_no,$point)
	{
		$sql_session="UPDATE  `user` SET 
									`Points` =  `Points`+'".$point."'
									
									WHERE `PhoneNo` =  '".$user_no."'";
		$quy_sessions=mysql_query($sql_session);
	}

	public function get_points($questionNo)
	{
		$sql_session="SELECT Difficulty FROM question WHERE Q_no =  '". $questionNo."'";	
		$quy_sessions=mysql_query($sql_session);
		$get_Last_Num = mysql_fetch_array($quy_sessions, MYSQL_NUM);
		
		return $get_Last_Num[0];
	}
	
	public function return_username($user_no)
	{
		$sql_session="SELECT Name FROM user WHERE `PhoneNo` =  '".$user_no."'";
		$quy_sessions=mysql_query($sql_session);
		$Correct_Val = mysql_fetch_array($quy_sessions, MYSQL_NUM);
		
		return $Correct_Val[0];	
	
	}
	public function return_points($user_no)
	{
		$sql_session="SELECT Points FROM user WHERE `PhoneNo` =  '".$user_no."'";
		$quy_sessions=mysql_query($sql_session);
		$Correct_Val = mysql_fetch_array($quy_sessions, MYSQL_NUM);
		
		return $Correct_Val[0];	
	
	}
	
	public function show_leaderboard ($user_no, $con) {

    // Strings of querries to be executed
    $query1_string = "set @rank = 0";
    $query2_string = "CREATE TEMPORARY TABLE Leaderboard AS SELECT @rank := @rank + 1 as Rank, Name, Points, PhoneNo FROM user ORDER BY Points DESC";
    $query3_string = "SELECT Rank, Name, Points FROM Leaderboard";
    $query4_string = "SELECT Rank, Name, Points FROM Leaderboard WHERE PhoneNo = '".$user_no."'";
    $query5_string = "DROP TABLE Leaderboard";

    // Doing the queries
    $query1 = mysqli_query($con, $query1_string) or die(mysqli_error($con));
    $query2 = mysqli_query($con, $query2_string) or die(mysqli_error($con));
    $query3 = mysqli_query($con, $query3_string) or die(mysqli_error($con));
    $query4 = mysqli_query($con, $query4_string) or die(mysqli_error($con));

    // Initializing the count
    $count = 0;

    // Making an array of strings including Rank, Name and Points of the Top 5 Players
    while (($count < 5) && ($row = mysqli_fetch_array($query3, MYSQL_NUM))) {
        $results[$count] = $row[0] . "   " . $row[1] . "    " . $row[2];
        $count++;
    }
    
    // Adding User details into the array
    $row = mysqli_fetch_array($query4, MYSQL_NUM);
    $results[$count + 1] = "You are \n" . $row[0] . "   " . $row[1] . "    " . $row[2];
    
    // Dropping the view.
    $end_query = mysqli_query($con, $query5_string) or die(mysqli_error($con));
    
    //Returning the array
    $leader = implode("\n", $results);
    return $leader;    
	}
	
	


}

?>