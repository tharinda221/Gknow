<?php

ini_set('error_log', 'ussd-app-error.log');

require 'libs/MoUssdReceiver.php';
require 'libs/MtUssdSender.php';
require 'class/operationsClass.php';
require 'log.php';
require 'db.php';

$con = mysqli_connect("localhost", "root", "" )or die(mysql_error()); 
$database = mysqli_select_db($con, "gknow") or die(mysql_error());  


$production=false;

	if($production==false){
		$ussdserverurl ='http://localhost:7000/ussd/send';
	}
	else{
		$ussdserverurl= 'https://api.dialog.lk/ussd/send';
	}


$receiver 	= new UssdReceiver();
$sender 	= new UssdSender($ussdserverurl,'APP_000001','password');
$operations = new Operations();

$receiverSessionId = $receiver->getSessionId();
$content 			= 	$receiver->getMessage(); // get the message content
$address 			= 	$receiver->getAddress(); // get the sender's address
$requestId 			= 	$receiver->getRequestID(); // get the request ID
$applicationId 		= 	$receiver->getApplicationId(); // get application ID
$encoding 			=	$receiver->getEncoding(); // get the encoding value
$version 			= 	$receiver->getVersion(); // get the version
$sessionId 			= 	$receiver->getSessionId(); // get the session ID;
$ussdOperation 		= 	$receiver->getUssdOperation(); // get the ussd operation



$user_no = $address;
$User_Name = $operations->return_username($user_no);

$responseMsg = array(
    "main" =>  
    "Puzzles-Enjoy your free times
0.leader board
1. Square
2. Series1


99. Exit"
,
	"main_menu" =>
			"Welcome ".(string)$User_Name."!
				 0.Leader Board
				 1.Start Game
				 2.Check Answered Questions
				99.Exit"

			
);



function search_user ($address) {
    $user_no = $address;
    $query = "SELECT Name FROM user where PhoneNo = '".$user_no."'";
    $name = mysql_query($query);

    if (mysql_num_rows($name)) {
        return 1;
    }
    else {
        return 0;
    }
}

if ($ussdOperation  == "mo-init") { 
   
	try {
		$sessionArrary=array( "sessionid"=>$sessionId,"tel"=>$address,"menu"=>"main","pg"=>"","others"=>"");

  		$operations->setSessions($sessionArrary);
	
        $bl = search_user ($address);
		
		$userArrary=array( "sessionid"=>$sessionId,"getuser"=>$bl,"enterpoints"=>1);
		$operations->setcheckuser($userArrary);
		
		
		if($bl == 0){
            $sender->ussd($sessionId,'Welcome to GKnow ! Please enter your name to proceed...' ,$address );
        }else{
            $sender->ussd($sessionId, $responseMsg["main_menu"],$address );
  	        $sessiondetails=  $operations->getSession($sessionId);
        }
        
		
		
		$cuch_menu=$sessiondetails['menu'];
		$operations->session_id=$sessiondetails['sessionsid'];
		$operations->session_menu="selection";
		$operations->saveSesssion();
		

	} catch (Exception $e) {
			$sender->ussd($sessionId, 'Sorry error occured try again',$address );
	}
	
}else {
    
	
    $checkuser=$operations->getcheckuser($sessionId);
	$sessiondetails=  $operations->getSession($sessionId);

    if($checkuser == 0){
	
        $username = $receiver->getMessage();
		$leadArrary = array( "userid"=>$sessionId, "phoneNo" =>$address, "username"=>$username, "points"=>$point); 
		$operations -> setUser($leadArrary);
		
		//$User_Name1 = $operations->return_username($user_no);
		$main_menu =
			"Welcome ".(string)$username."!
				 0.Leader Board
				 1.Start Game
				 2.Check Answered Questions
				99.Exit";

        $sender->ussd($sessionId, $main_menu,$address );
		$operations->updatecheckuser(1,$sessionId);
		
		//$operations->session_menu="main1";
		//$operations->saveSesssion();
		
		$cuch_menu=$sessiondetails['menu'];
		$operations->session_id=$sessiondetails['sessionsid'];
		$operations->session_menu="selection";
		$operations->saveSesssion();
		
		//$sender->ussd($sessionId,$cuch_menu,$address );
		
    }else{ 
	
  	$cuch_menu=$sessiondetails['menu'];
	//$sender->ussd($sessionId,$cuch_menu,$address );
  	$operations->session_id=$sessiondetails['sessionsid'];
	
	$user_no = $address;

	
		switch($cuch_menu ){
		
			case "selection":
				$Get_Num = $receiver->getMessage();
				
				
					if($Get_Num == '1'){
						//$operations->session_menu="main";
						//$operations->saveSesssion();
						
						$user_no = $address;
						$questionNo = $operations->get_last_q_num($user_no);
						$questionNo++;
						$point=$operations->get_points($questionNo);
						
							
							$operations->session_menu="answers";
							$operations->saveSesssion();
							$question=$operations->get_q((int)$questionNo);
							
							$Num_With_Q = "Difficulty Level: ".$point/100 ."\n"."Question Number: ".$questionNo."\n".$question;
							$sender->ussd($sessionId,$Num_With_Q,$address );
						
					break;
					
					}else if($Get_Num == '0'){
						//$sender->ussd($sessionId,$user_no,$address );
						$Leaderboard=$operations->show_leaderboard($user_no,$con);
						$Leaderboard="rank"." "."name"." "."pts"."\n".$Leaderboard."\n\n"."1.Start Game"."\n"."2.Check Answered Questions"."\n"."99.Exit";
						
						$sender->ussd($sessionId,$Leaderboard,$address );
						
						$operations->session_menu="selection";
						$operations->saveSesssion();
						
						break;
						
					}else if($Get_Num == '2'){
						$questionNo = $operations->get_last_q_num($user_no);
						if((int)$questionNo==0){
							$ans_msg="You did not answer any question."."\n\n"." 0.Leader Board"."\n"." 1.Start Game"."\n"."99.Exit";
						
							$sender->ussd($sessionId,$ans_msg,$address );
							$operations->session_menu="selection";
							$operations->saveSesssion();
						}else{
							if((int)$questionNo == 1){
								$ans_get_msg ="You Have Answered only one question."."\n"."Please Enter Number 1 to Select the Question." ;	
							}else{
								$ans_get_msg ="You Have Answered ".$questionNo." Questions."."\n"."Please Enter a Number between 1-".$questionNo." Select the Question." ;
							}
							$sender->ussd($sessionId,$ans_get_msg,$address );
							$operations->session_menu="Get_Answer";
							$operations->saveSesssion();
							
						}
						break;
					
					}else if($Get_Num == '99'){
						 $sender->ussd($sessionId,'Thank you for using!!!',$address ,'mt-fin');
                         break;
					}else{
						$operations->session_menu="selection";
						$operations->saveSesssion();
						$error_msg="Incorrect Option "."\n\n"." 0.Leader Board"."\n"." 1.Start Game"."\n"." 2.Check Answered Questions"."\n"."99.Exit";
						$sender->ussd($sessionId, $error_msg ,$address );
						break;
					}
					
			case "Get_Answer":
					$Get_Num_Of_Q= $receiver->getMessage();
					$questionNo = $operations->get_last_q_num($user_no);
					$questionNo++;
						
					if((int)$questionNo>(int)$Get_Num_Of_Q && (int)$Get_Num_Of_Q>0){
						$question=$operations->get_q((int)$Get_Num_Of_Q);
						$Correct_Anws = $operations->Correct_Val($questionNo);
						$show_msg=$question."\n"."Answer"."\n".$Correct_Anws."\n"." 0.Leader Board"."\n"." 1.Start Game"."\n"."99.Exit";
						$sender->ussd($sessionId,$show_msg,$address);
						$operations->session_menu="selection";
						$operations->saveSesssion();
						
					}else if((int)$questionNo<=(int)$Get_Num_Of_Q){
						$show_msg="You did not answer that question yet."."\n"." 0.Leader Board"."\n"." 1.Start Game"."\n"."99.Exit";
						$sender->ussd($sessionId,$show_msg,$address);
						$operations->session_menu="selection";
						$operations->saveSesssion();
					}else{
						$show_msg ="You Have Answered ".$questionNo." Questions."."\n"."Please Enter a Number between 1-".$questionNo." Select the Question." ;
						$sender->ussd($sessionId,$show_msg,$address);
						$operations->session_menu="Get_Answer";
						$operations->saveSesssion();
					}
					
					break;
					
			case "main": 	// Following is the main menu
					$user_no = $address;
					$questionNo = $operations->get_last_q_num($user_no);
					$questionNo++;
					$point=$operations->get_points($questionNo);
					
					if((int)$questionNo>0 || (int)$questionNo<50){
						
						$operations->session_menu="answers";
						$operations->saveSesssion();
						$question=$operations->get_q((int)$questionNo);
						
						$Num_With_Q = "Difficulty Level: ".$point/100 ."\n"."Question Number: ".$questionNo."\n".$question;
						$sender->ussd($sessionId,$Num_With_Q,$address );
						
					
					}else{
						$operations->session_menu="main";
						$operations->saveSesssion();
						$error_msg="Incorrect Option "."\n\n"."0.Leader Board"."1.Start Game"."\n"."2.Check Answered Questions"."\n"."99.Exit";
						$sender->ussd($sessionId, $error_msg ,$address );
						break;
					
					} 
					
					break;
			case "answers":
					
					$answer=$receiver->getMessage();
					$questionNo = $operations->get_last_q_num($user_no);
					$questionNo++;
					$Correct_Anws = $operations->Correct_Val($questionNo);
					
					if($answer == $Correct_Anws){
						
						$Incorrect_Num = $operations->n_of_incorrect($sessionId);
						
						if((int)$Incorrect_Num == 1){
						
							$point=$operations->get_points($questionNo);
							$point1 = $point/1;
							$operations->addpoints($user_no,$point1);
							
						}else if((int)$Incorrect_Num == 2){
							
							$point=$operations->get_points($questionNo);
							$point1 = $point/2;
							$operations->addpoints($user_no,$point1);
							
						}else{
							
							$point=$operations->get_points($questionNo);
							$point1 = $point/4;
							$operations->addpoints($user_no,$point1);
							
						}
						
						$Incorrect_Num_Update = 1;
						$operations->updatepoints($sessionId,$Incorrect_Num_Update);
						
						$usern=$operations->return_username($user_no);	
				        $c_opt="well done ".$usern."\n"."you got ".$point1." points"."\n"."0.Leader Board"."\n"."1.Next Question"."\n"."2.Check Answered Questions"."\n"."99.Exit";	
				        $sender->ussd($sessionId, $c_opt,$address );
						
						$operations->session_menu="selection";
				        $operations->saveSesssion();
						
						$operations->Update_Q_Num((int)$questionNo,$user_no);
						
					
					}else if($answer != "1" && $answer != "2" && $answer != "3" && $answer != "4"){
					
						$question=$operations->get_q((int)$questionNo);
						$sender->ussd($sessionId,"Please enter a choice no.."."\n".$question,$address );
					
					}else{
						
						//count number of  incorrects
						
						$Incorrect_Num = $operations->n_of_incorrect($sessionId);
						$Incorrect_Num++;
						if($Incorrect_Num < 4){
							$operations->updatepoints($sessionId,$Incorrect_Num);
							
							$question=$operations->get_q((int)$questionNo);
							
							$sender->ussd($sessionId,"Incorrect Answer"."\n".$question,$address );
							$operations->session_menu="answers";
							$operations->saveSesssion();
						
						}else{
													
							$usern=$operations->return_username($user_no);
				        	$show_point=$operations->return_points($user_no);
							$ans=$operations->Correct_Val($questionNo);
							$u_wrong="Nice try ".$usern."\n"."But answer is ".$ans."\n"."You didn't score on that question."."\n"."0.Leader Board"."\n"."1.Next Question"."\n"."2.Check Answered Questions"."\n"."99.Exit";						
							$sender->ussd($sessionId, $u_wrong,$address );
							
							$Incorrect_Num_Update = 1;
							$operations->updatepoints($sessionId,$Incorrect_Num_Update);
							
							$questionNo = $operations->get_last_q_num($user_no);
							$questionNo++;
							$operations->session_menu="selection";
							$operations->saveSesssion();
							$operations->Update_Q_Num((int)$questionNo,$user_no);
							
							
						}	
					}
					break;
		}
		
	}	
}