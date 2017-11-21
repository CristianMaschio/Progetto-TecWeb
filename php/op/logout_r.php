<?php
	require_once('config.php');
	$_SESSION['user_id']=-1;
	$_SESSION['username']='anonymous';
	$_SESSION['user_tipo']='U';
	redirect($_SERVER['HTTP_REFERER']);
//	if(isset($_SESSION['redirect'])){
//            $to=$_SESSION['redirect'];
//            unset($_SESSION['redirect']);
//            redirect($to);
//        } else{
//                redirect('home.php');
//        }
//	
//	if(!isset($_SESSION['redirect']))
//		if(isset($_SERVER['HTTP_REFERER']))
//			redirect($_SERVER['HTTP_REFERER']);
?>
