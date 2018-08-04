
<?php

ini_set('max_execution_time', 3600);

include("zklib/zklib.php");


	date_default_timezone_set('Asia/dhaka');
	echo date('h:i:s') . ": Auto Receive Started ..."."\n";

	$noofdata = 0;

		$ip = "192.168.0.201";
	 	$port = 4370;

    $zk = new ZKLib($ip, $port);

$ret = $zk->connect();
    sleep(1);
        if ( !$ret ) {
		    echo date('h:i:s') . ": Error"."\n";
		    echo date('h:i:s') . ": Complete"."\n";
		}
        else {
	        $zk->disableDevice();
	        sleep(1);
	        echo date('h:i:s') .": Online"."\n";
 		}

   $attendance = $zk->getAttendance();
                sleep(1);
                ?>
           

<?php
              
        while(list($idx, $attendancedata) = each($attendance)) {
                 
	        $checktime = date( "Y-m-d\TH:i:sO" , strtotime($attendancedata[3]) - 60 * 60 * 4);
	        $checktype = $attendancedata[4];
	        $verify_mode = $attendancedata[2];
	        $id = $attendancedata[1];
	        $uid = $attendancedata[0];

	        $noofdata = (int)$noofdata + 1; 
            echo "U ID : ". $uid."\n"; 
            echo "ID : ". $id."\n"; 
            echo "Check Type : ". $checktype."\n"; 
            echo "Verify Mode : ". $verify_mode."\n"; 
            echo "Check Time : ". $checktime."\n"; 
	    } // end while
	    
	?>
			
<?php
		echo "Total Data : ". $noofdata ."\n";

$zk->enableDevice();
    sleep(1);
$zk->disconnect();

    echo date('h:i:s') . ": Complete\n";
		
?>
