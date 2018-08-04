
<?php


include("zklib/zklib.php");

	$url = "http://jsonuser:jsonuser1!@114.130.80.115:8080/openbravo//org.openbravo.service.json.jsonrest/THR_Hw_Device?_sortBy=searchKey"; 
	

		$ch = curl_init($url);
       	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	$result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
        $data = $result->response->data;
        
    
        foreach ($data as $value) 
        {
            $searchKey = $value->searchKey;
            $ip = $value->ip;
            $port = $value->port;
            $_identifier = $value->_identifier;

            echo date('h:i:s') . " Device : ". $_identifier. " | " . $ip  . " | " . $searchKey . "<br>"; 
        }


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

   $attendance = $zk->getAttendance();
                sleep(1);
                
        while(list($idx, $attendancedata) = each($attendance)) {
                 
	        $checktime = date( "Y-m-d\TH:i:sO" , strtotime($attendancedata[3]) - 60 * 60 * 4);
	        $checktype = (string)$attendancedata[4];
	        $verify_mode = (string)$attendancedata[2];
	        $id = (string)$attendancedata[1];

	        echo "Check Time : ". $checktime ."<br>";
	        echo "Check Type : ". $checktype ."<br>";
	        echo "Verify Mode : ". $verify_mode ."<br>";
	        echo "ID : ".$id ."<br>";

	        $noofdata = (int)$noofdata + 1;    
	    }
		echo "Total Data : ". $noofdata ."\n";;

$zk->enableDevice();
    sleep(1);
$zk->disconnect();

    echo date('h:i:s') . " Complete\n";
       
		
?>
