
<?php


    include("zklib/zklib.php");


date_default_timezone_set('Asia/dhaka');
 
echo date('h:i:s') . " Auto Receive Started ...\n";
$noofdata = 0;

	$ip = "192.168.0.201";
 	$port = "4370";

    $zk = new ZKLib($ip, $port);


     $ret = $zk->connect();
        sleep(1);
        if ( !$ret ) {
		    echo date('h:i:s') . " Error"."\n";
		    echo date('h:i:s') . " Complete"."\n";
		}
        else {
	        $zk->disableDevice();
	        sleep(1);
	        echo date('h:i:s') ." Online"."\n"; 
 		}
    // Application Url 
   $attendance = $zk->getAttendance();
                sleep(1);
                
        while(list($idx, $attendancedata) = each($attendance)) {
                 
	        $checktime = date( "Y-m-d\TH:i:sO" , strtotime($attendancedata[3]) - 60 * 60 * 4);
	        $checktype = (string)$attendancedata[4];
	        $documentno = (string)$attendancedata[2];

	        echo $checktime ."\n";
	        //echo $attendancedata[2]."\n";

	        $noofdata = (int)$noofdata + 1;
	        
	        }
echo $noofdata ."\n";;

   $zk->enableDevice();
    sleep(1);
    $zk->disconnect();
    echo date('h:i:s') . " Complete\n";
       
		
?>
