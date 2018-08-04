
<?php

if(!@fsockopen("114.130.80.115",8080))
{
echo "Server Offline"."\n";
}
else
{
    include("zklib/zklib.php");
// Application Url   
$url = "http://jsonuser:jsonuser!@114.130.80.115:8080/openbravo//org.openbravo.service.json.jsonrest/THR_Hw_Device?_where=searchKey='26'&_sortBy=searchKey";

date_default_timezone_set('Asia/dhaka');
 
echo date('h:i:s') . " Auto Receive Started ...\n";
$noofdata = 0;

//$url = 'http://jsonuser:jsonuser!@114.130.80.115:8080/openbravo//org.openbravo.service.json.jsonrest/thr_attendanceraw';
// Reading Data from url using Curl
  $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
 
            $result = json_decode($result);
            $data = $result->response->data;

   
                $searchKey = '';
                $ip = '';
                $port = 4370;
                $_identifier = '';
                foreach ($data as $value) {
               $searchKey = $value->searchKey;
               $ip = $value->ip;
               $port = $value->port;
               $_identifier = $value->_identifier;
 echo date('h:i:s') . " Device : ". $_identifier. " | " . $ip  . " | " . $searchKey . "\n"; 
                    //echo "Device No:" + $searchKey;
                   // echo "IP Address: " + $port;


//$deviceip = $_REQUEST['deviceip'];
//$deviceip = "192.168.0.201";
    $zk = new ZKLib($ip, $port);

if(!@fsockopen($ip,$port))
{
echo date('h:i:s') . " Offline"."\n";
}
else
{
     $ret = $zk->connect();
        sleep(1);
        if ( !$ret ):
    echo date('h:i:s') . " Error"."\n";
    echo date('h:i:s') . " Complete"."\n";
        elseif ( $ret ): 
        $zk->disableDevice();
        sleep(1);
         echo date('h:i:s') ." Online"."\n"; 
    // Application Url   
        $url = 'http://jsonuser:jsonuser!@114.130.80.115:8080/openbravo//org.openbravo.service.json.jsonrest/thr_attendanceraw?_where=deviceno=' . "'".$searchKey."'";

    // Reading Data from url using Curl
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);
 
            $result = json_decode($result);
            $data = $result->response->data;


/**
    // finding the Max date from url database.
                $max_date = '';
                foreach ($data as $value) {
                    if ($value->checktime > $max_date) {
                        $max_date = $value->checktime;
                    }
                }

    // Set TimeZone
                if($max_date == ''){
                    $max_date = '2018/01/01';
                }
                $maxdate = new DateTime($max_date, new DateTimeZone('UTC'));
                $maxdate->setTimezone(new DateTimeZone('Asia/Dhaka'));
 
                //echo "Attedance Max Time " . $maxdate->format('Y-m-d\TH:i:sO') ."\n";
                
**/

    // Retrieve data from Device
            $attendance = $zk->getAttendance();
                sleep(1);
                while(list($idx, $attendancedata) = each($attendance)):
                    if ( $attendancedata[2] == 14 )
                        $status = '1';
                    else
                        $status = '0';

    // Change Date format "checktime" value
        $checktime = date( "Y-m-d\TH:i:sO" , strtotime($attendancedata[3]) - 60 * 60 * 4);
        // $checktime = new DateTime($check_time, new DateTimeZone('Asia/Dhaka'));
         //$checktime->setTimezone(new DateTimeZone('Asia/Dhaka'));

        //if (date( "Y-m-d\TH:i:sO" , strtotime($attendancedata[3])) > $maxdate->format('Y-m-d\TH:i:sO') ) 
        //{
            $checktype = (string)$attendancedata[4];
            $documentno = (string)$attendancedata[2];

    // Get Data for "thr_attendanceraw" Table
                $jsonData = array(
                    'entityName' => 'thr_attendanceraw',
                    'userno' => $attendancedata[1] ,
                    'checktime' => $checktime,
                    'checktype' =>  $checktype,
                     'leaveApplicationNo' =>  $documentno,
                     'deviceno' => $searchKey, 
                    'manual' => 0
                );

            $data_string = json_encode(array("data" =>$jsonData));

    // POST Data Device To Application
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            echo $result ."\n";
            //echo date('h:i:s') . " Receiving " ."\n";
            curl_close($ch);
             $noofdata = (int)$noofdata + 1;
            



   //  }

           endwhile;
            
       $zk->enableDevice();
        sleep(1);
        $zk->disconnect();
        echo date('h:i:s') . " Complete\n";
        endif;
    }

?>
<?php

                }
        }


?>
