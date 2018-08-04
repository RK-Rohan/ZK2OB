 <?php

$conn = oci_connect('bgdattn', 'bgdattn', '//192.168.0.105/ORCL');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

                $THR_ATTENDANCERAW_ID = 'AAANttAAMAAANG1ABF';
                $AD_CLIENT_ID = '8D8C2A846B2545128823CC7611C9EF80';
                $AD_ORG_ID = 'BB7935DD9F9F46B8A3CEBFB8CA73929B';
                $ISACTIVE = 'Y';
                $CREATED = '03/21/2018 10:20:12';
                $CREATEDBY = '0';
                $UPDATED = '03/21/2018 10:20:12';
                $UPDATEDBY = '0';
                $CHECKTIME ="TO_DATE('02/27/2018 21:58:27', 'MM/DD/YYYY HH24:MI:SS')'";
                $USERNO = '10842803';
                $DOCUMENTNO = '0010842803';
                $ISMANUAL = 'N';
                $DEVICENO = '2';
                $ATTENDANCETYPE = '0';
                $ERROR_CODE = '0';
                $PRODUCTNAME = 'NULL';
                $SERIAL_NUMBER = 'NULL';
                $ACCOUNT_NUMBER = 'NULL';
                $NAME = 'NULL';
                $S_TIME = 'NULL';
                $MACHINE = 'NULL';
                $VERIFY_MODE = 'NULL';

                oci_bind_by_name($compiled1, ':THR_ATTENDANCERAW_ID', $THR_ATTENDANCERAW_ID);
                oci_bind_by_name($compiled1, ':AD_CLIENT_ID', $AD_CLIENT_ID);
                oci_bind_by_name($compiled1, ':AD_ORG_ID', $AD_ORG_ID);
                oci_bind_by_name($compiled1, ':ISACTIVE', $ISACTIVE);
                oci_bind_by_name($compiled1, ':CREATED', $CREATED);
                oci_bind_by_name($compiled1, ':CREATEDBY', $CREATEDBY);
                oci_bind_by_name($compiled1, ':UPDATED', $UPDATED);
                oci_bind_by_name($compiled1, ':UPDATEDBY', $UPDATEDBY);
                oci_bind_by_name($compiled1, ':CHECKTIME', $CHECKTIME);
                oci_bind_by_name($compiled1, ':USERNO', $USERNO);
                oci_bind_by_name($compiled1, ':DOCUMENTNO', $DOCUMENTNO);
                oci_bind_by_name($compiled1, ':ISMANUAL', $ISMANUAL);
                oci_bind_by_name($compiled1, ':DEVICENO', $DEVICENO);
                oci_bind_by_name($compiled1, ':ATTENDANCETYPE', $ATTENDANCETYPE);
                oci_bind_by_name($compiled1, ':ERROR_CODE', $ERROR_CODE);
                oci_bind_by_name($compiled1, ':PRODUCTNAME', $PRODUCTNAME);
                oci_bind_by_name($compiled1, ':SERIAL_NUMBER', $SERIAL_NUMBER);
                oci_bind_by_name($compiled1, ':ACCOUNT_NUMBER', $ACCOUNT_NUMBER);
                oci_bind_by_name($compiled1, ':NAME', $NAME);
                oci_bind_by_name($compiled1, ':S_TIME', $S_TIME);
                oci_bind_by_name($compiled1, ':MACHINE', $MACHINE);
                oci_bind_by_name($compiled1, ':VERIFY_MODE', $VERIFY_MODE);


                
                $sql1 = "
                INSERT INTO THR_ATTENDANCERAW (THR_ATTENDANCERAW_ID, AD_CLIENT_ID, AD_ORG_ID, ISACTIVE, CREATED, 
                            CREATEDBY, UPDATED, UPDATEDBY, CHECKTIME, USERNO, 
                            DOCUMENTNO, ISMANUAL, DEVICENO, ATTENDANCETYPE, ERROR_CODE, 
                            PRODUCTNAME, SERIAL_NUMBER, ACCOUNT_NUMBER, NAME, S_TIME, 
                            MACHINE, VERIFY_MODE) 
                VALUES (
                    ':THR_ATTENDANCERAW_ID,:AD_CLIENT_ID,:AD_ORG_ID,:ISACTIVE,:CREATED,:CREATEDBY,:UPDATED,:UPDATEDBY,:CHECKTIME,:USERNO,:DOCUMENTNO,:ISMANUAL,:DEVICENO,:ATTENDANCETYPE,:ERROR_CODE,:PRODUCTNAME,:SERIAL_NUMBER,:ACCOUNT_NUMBER,:NAME,:S_TIME,:MACHINE,:VERIFY_MODE')" ;
                //echo $sql1;
           $compiled1 = oci_parse($conn, $sql1);

           
            oci_execute($compiled1); 

            ?>