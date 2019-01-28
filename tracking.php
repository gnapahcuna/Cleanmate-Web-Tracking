<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Smart Laundry Tracking</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>

    <!-- script
    ================================================== -->

    <!-- favicons
     ================================================== -->
    <link rel="icon" type="image/png" href="favicon.png">

    <style>
        input:focus {
            outline: none !important;
            border-color: #719ECE;
            box-shadow: 0 0 10px #719ECE;
        }
        textarea:focus {
            outline: none !important;
            border-color: #719ECE;
            box-shadow: 0 0 10px #719ECE;
        }
        .fa-rotate-45 {
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            transform: rotate(90deg);
        }
		
        }
    </style>



</head>

<body id="top">

<!-- header 
================================================== -->
<header>

</header> <!-- /header -->

<!-- intro section
================================================== -->
<section id="intro">

    <div class="intro-overlay"></div>

    <div class="intro-content">
        <div class="row">
            <div class="col-twelve">

                <div class="col-twelve">
                    <section id="resume">
                        <h1><font style="font-family:'Kanit',sans-serif; font-size:30px">Smart Laundry Tracking</font></h1>
                        <!--<h5>Hello, World.</h5>
                        <h1>Cleanmate Tracking</h1>-->

                        <?php
	include("config.php");
    $stmt = "select  ROW_NUMBER() OVER(ORDER BY ops_transportpackage.OrderNo ASC) AS Row,ops_transportpackage.OrderNo,CONVERT(varchar, ops_order.CreatedDate, 120) as OrderDate,
ops_order.AppointmentDate,ops_order.IsActive,ops_order.OrderNo,Barcode,CONVERT(varchar, ops_order.DeletedDate, 120) as DeletedDate,mas_branch.BranchNameTH,mas_branch.BranchCode,
case when DeliveryStatus IS NULL then 0 else DeliveryStatus end as DeliveryStatus,CONVERT(varchar, DeliveryDate, 120) as DeliveryDate,
case when IsDriverVerify IS NULL then 0 else IsDriverVerify end as IsDriverVerify,CONVERT(varchar, DriverVerifyDate, 120) as DriverVerifyDate,
case when IsCheckerVerify IS NULL then 0 else IsCheckerVerify end as IsCheckerVerify,CONVERT(varchar, CheckerVerifyDate, 120) as CheckerVerifyDate,
case when IsBranchEmpVerify IS NULL then 0 else IsBranchEmpVerify end as IsBranchEmpVerify,CONVERT(varchar, BranchEmpVerifyDate, 120) as BranchEmpVerifyDate,
case when IsReturnCustomer IS NULL then 0 else IsReturnCustomer end as IsReturnCustomer,CONVERT(varchar, ReturnCustomerDate, 120) as ReturnCustomerDate 
from ops_transportpackage left join 
(ops_order left join mas_branch on ops_order.BranchID=mas_branch.BranchID) 
on ops_transportpackage.OrderNo=ops_order.OrderNo  
where ops_order.OrderNo='".$_POST['OrderNo']."'
Order By DeliveryStatus DESC";
    $query = sqlsrv_query($conn, $stmt);
	$object_array = array();
	$arrStatus = array();
	$arrDate = array();
	$arrContent = array();
	$arrIcon = array();
     while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
    {
 		array_push($object_array,$row);
    }
	$chk=0;
	$chk=sizeof($object_array);
	
	if($object_array[0]['DeliveryStatus']==0&&$object_array[0]['IsDriverVerify']==0&&$object_array[0]['IsCheckerVerify']==0&&$object_array[0]['IsBranchEmpVerify']==0&&$object_array[0]['IsReturnCustomer']==0){
			array_push($arrIcon,'fa fa-hand-o-right');
			array_push($arrStatus,'ผ้าอยู่กับสาขา (Send)');
			array_push($arrContent,'ลูกค้าทำรายการซักแล้วนำสินค้าที่ต้องการซักพร้อมกับบาร์โค้ดชำระเงินในมือถือมาจ่ายเงินกับพนักงานที่ร้านสาขา');
			array_push($arrDate,$object_array[0]['OrderDate']);
		}elseif($object_array[0]['DeliveryStatus']==0&&$object_array[0]['IsDriverVerify']==1&&$object_array[0]['IsCheckerVerify']==0&&$object_array[0]['IsBranchEmpVerify']==0&&$object_array[0]['IsReturnCustomer']==0){
			array_push($arrIcon,'fa fa-hand-o-right');
			array_push($arrIcon,'fa fa-truck');
			array_push($arrStatus,'ผ้าอยู่กับสาขา (Send)');
			array_push($arrStatus,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrContent,'ลูกค้าทำรายการซักแล้วนำสินค้าที่ต้องการซักพร้อมกับบาร์โค้ดชำระเงินในมือถือมาจ่ายเงินกับพนักงานที่ร้านสาขา');
			array_push($arrContent,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrDate,$object_array[0]['OrderDate']);
			array_push($arrDate,$object_array[0]['DriverVerifyDate']);
		}elseif($object_array[0]['DeliveryStatus']==0&&$object_array[0]['IsDriverVerify']==1&&$object_array[0]['IsCheckerVerify']==1&&$object_array[0]['IsBranchEmpVerify']==0&&$object_array[0]['IsReturnCustomer']==0){
			array_push($arrIcon,'fa fa-hand-o-right');
			array_push($arrIcon,'fa fa-truck');
			array_push($arrIcon,'fa fa-indent');
			array_push($arrStatus,'ผ้าอยู่กับสาขา (Send)');
			array_push($arrStatus,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrStatus,'ผ้าอยู่กับแผนก Factory Checker In');
			array_push($arrContent,'ลูกค้าทำรายการซักแล้วนำสินค้าที่ต้องการซักพร้อมกับบาร์โค้ดชำระเงินในมือถือมาจ่ายเงินกับพนักงานที่ร้านสาขา');
			array_push($arrContent,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrContent,'พนักงานโรงงานกำลังตรวจสอบสินค้าที่ส่งซัก');
			array_push($arrDate,$object_array[0]['OrderDate']);
			array_push($arrDate,$object_array[0]['DriverVerifyDate']);
			array_push($arrDate,$object_array[0]['CheckerVerifyDate']);
		}elseif($object_array[0]['DeliveryStatus']==1&&$object_array[0]['IsDriverVerify']==0&&$object_array[0]['IsCheckerVerify']==1&&$object_array[0]['IsBranchEmpVerify']==0&&$object_array[0]['IsReturnCustomer']==0){
			array_push($arrIcon,'fa fa-hand-o-right');
			array_push($arrIcon,'fa fa-truck');
			array_push($arrIcon,'fa fa-indent');
			array_push($arrIcon,'fa fa-outdent');
			array_push($arrStatus,'ผ้าอยู่กับสาขา (Send)');
			array_push($arrStatus,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrStatus,'ผ้าอยู่กับแผนก Factory Checker In');
			array_push($arrStatus,'ผ้าอยู่กับแผนก Factory Checker Out');
			array_push($arrContent,'ลูกค้าทำรายการซักแล้วนำสินค้าที่ต้องการซักพร้อมกับบาร์โค้ดชำระเงินในมือถือมาจ่ายเงินกับพนักงานที่ร้านสาขา');
			array_push($arrContent,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrContent,'พนักงานโรงงานกำลังตรวจสอบสินค้าที่ส่งซัก');
			array_push($arrContent,'พนักงานโรงงานกำลังตรวจสอบและเตรียมจัดส่ง');
			array_push($arrDate,$object_array[0]['OrderDate']);
			array_push($arrDate,$object_array[0]['DriverVerifyDate']);
			array_push($arrDate,$object_array[sizeof($object_array)-1]['CheckerVerifyDate']);
			array_push($arrDate,$object_array[0]['CheckerVerifyDate']);
		}elseif($object_array[0]['DeliveryStatus']==1&&$object_array[0]['IsDriverVerify']==1&&$object_array[0]['IsCheckerVerify']==1&&$object_array[0]['IsBranchEmpVerify']==0&&$object_array[0]['IsReturnCustomer']==0){
			array_push($arrIcon,'fa fa-hand-o-right');
			array_push($arrIcon,'fa fa-truck');
			array_push($arrIcon,'fa fa-indent');
			array_push($arrIcon,'fa fa-outdent');
			array_push($arrIcon,'fa fa-truck');
			array_push($arrStatus,'ผ้าอยู่กับสาขา (Send)');
			array_push($arrStatus,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrStatus,'ผ้าอยู่กับแผนก Factory Checker In');
			array_push($arrStatus,'ผ้าอยู่กับแผนก Factory Checker Out');
			array_push($arrStatus,'ผ้าอยู่กับคนขับรถนำคืนร้านค้า');
			array_push($arrContent,'ลูกค้าทำรายการซักแล้วนำสินค้าที่ต้องการซักพร้อมกับบาร์โค้ดชำระเงินในมือถือมาจ่ายเงินกับพนักงานที่ร้านสาขา');
			array_push($arrContent,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrContent,'พนักงานโรงงานกำลังตรวจสอบสินค้าที่ส่งซัก');
			array_push($arrContent,'พนักงานโรงงานกำลังตรวจสอบและเตรียมจัดส่ง');
			array_push($arrContent,'พนักงานขับรถกำลังส่งผ้าที่ซักเสร็จแล้วไปที่ร้านสาขา');
			array_push($arrDate,$object_array[0]['OrderDate']);
			array_push($arrDate,$object_array[sizeof($object_array)-1]['DriverVerifyDate']);
			array_push($arrDate,$object_array[sizeof($object_array)-1]['CheckerVerifyDate']);
			array_push($arrDate,$object_array[0]['CheckerVerifyDate']);
			array_push($arrDate,$object_array[0]['DriverVerifyDate']);
		}elseif($object_array[0]['DeliveryStatus']==1&&$object_array[0]['IsDriverVerify']==1&&$object_array[0]['IsCheckerVerify']==1&&$object_array[0]['IsBranchEmpVerify']==1&&$object_array[0][
		'IsReturnCustomer']==0){
			array_push($arrIcon,'fa fa-hand-o-right');
			array_push($arrIcon,'fa fa-truck');
			array_push($arrIcon,'fa fa-indent');
			array_push($arrIcon,'fa fa-outdent');
			array_push($arrIcon,'fa fa-truck');
			array_push($arrIcon,'fa fa-home');
			array_push($arrStatus,'ผ้าอยู่กับสาขา (Send)');
			array_push($arrStatus,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrStatus,'ผ้าอยู่กับแผนก Factory Checker In');
			array_push($arrStatus,'ผ้าอยู่กับแผนก Factory Checker Out');
			array_push($arrStatus,'ผ้าอยู่กับคนขับรถนำคืนร้านค้า');
			array_push($arrStatus,'ผ้าอยู่กับร้านค้า');
			array_push($arrContent,'ลูกค้าทำรายการซักแล้วนำสินค้าที่ต้องการซักพร้อมกับบาร์โค้ดชำระเงินในมือถือมาจ่ายเงินกับพนักงานที่ร้านสาขา');
			array_push($arrContent,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrContent,'พนักงานโรงงานกำลังตรวจสอบสินค้าที่ส่งซัก');
			array_push($arrContent,'พนักงานโรงงานกำลังตรวจสอบและเตรียมจัดส่ง');
			array_push($arrContent,'พนักงานขับรถกำลังส่งผ้าที่ซักเสร็จแล้วไปที่ร้านสาขา');
			array_push($arrContent,'ร้านสาขารับผ้าที่ซักเสร็จแล้วเข้าระบบ รอลูกค้ามารับคืน');
			array_push($arrDate,$object_array[0]['OrderDate']);
			array_push($arrDate,$object_array[sizeof($object_array)-1]['DriverVerifyDate']);
			array_push($arrDate,$object_array[sizeof($object_array)-1]['CheckerVerifyDate']);
			array_push($arrDate,$object_array[0]['CheckerVerifyDate']);
			array_push($arrDate,$object_array[0]['DriverVerifyDate']);
			array_push($arrDate,$object_array[0]['BranchEmpVerifyDate']);
		}elseif($object_array[0]['DeliveryStatus']==1&&$object_array[0]['IsDriverVerify']==1&&$object_array[0]['IsCheckerVerify']==1&&$object_array[0]['IsBranchEmpVerify']==1&&$object_array[0]['IsReturnCustomer']==1){
			array_push($arrIcon,'fa fa-hand-o-right');
			array_push($arrIcon,'fa fa-truck');
			array_push($arrIcon,'fa fa-indent');
			array_push($arrIcon,'fa fa-outdent');
			array_push($arrIcon,'fa fa-truck');
			array_push($arrIcon,'fa fa-home');
			array_push($arrIcon,'fa fa-hand-o-left');
			array_push($arrStatus,'ผ้าอยู่กับสาขา (Send)');
			array_push($arrStatus,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrStatus,'ผ้าอยู่กับแผนก Factory Checker In');
			array_push($arrStatus,'ผ้าอยู่กับแผนก Factory Checker Out');
			array_push($arrStatus,'ผ้าอยู่กับคนขับรถนำคืนร้านค้า');
			array_push($arrStatus,'ผ้าอยู่กับร้านค้า');
			array_push($arrStatus,'ลูกค้ามารับผ้าคืน');
			array_push($arrContent,'ลูกค้าทำรายการซักแล้วนำสินค้าที่ต้องการซักพร้อมกับบาร์โค้ดชำระเงินในมือถือมาจ่ายเงินกับพนักงานที่ร้านสาขา');
			array_push($arrContent,'ผ้าอยู่กับคนขับรถนำส่งโรงงาน');
			array_push($arrContent,'พนักงานโรงงานกำลังตรวจสอบสินค้าที่ส่งซัก');
			array_push($arrContent,'พนักงานโรงงานกำลังตรวจสอบและเตรียมจัดส่ง');
			array_push($arrContent,'พนักงานขับรถกำลังส่งผ้าที่ซักเสร็จแล้วไปที่ร้านสาขา');
			array_push($arrContent,'ร้านสาขารับผ้าที่ซักเสร็จแล้วเข้าระบบ รอลูกค้ามารับคืน');
			array_push($arrContent,'ลูกค้ามารับผ้าคืนแล้ว');
			array_push($arrDate,$object_array[0]['OrderDate']);
			array_push($arrDate,$object_array[sizeof($object_array)-1]['DriverVerifyDate']);
			array_push($arrDate,$object_array[sizeof($object_array)-1]['CheckerVerifyDate']);
			array_push($arrDate,$object_array[0]['CheckerVerifyDate']);
			array_push($arrDate,$object_array[0]['DriverVerifyDate']);
			array_push($arrDate,$object_array[0]['BranchEmpVerifyDate']);
			array_push($arrDate,$object_array[0]['ReturnCustomerDate']);
		}
?>

                        <?php if($chk!=0){
							if($object_array[0]['IsActive']==0){?>
                             <h5 style="color:#b32400"><font style="font-family:'Kanit',sans-serif; font-size:16px">รายการซักถูกยกเลิก</font></h5>
                            <?php }else{?>
                        	
						<h5 style="color:#0099cc"><font style="font-family:'Kanit',sans-serif; font-size:16px">สาขา : <?php echo $object_array[0]['BranchNameTH'].'('.$object_array[0]['BranchCode'].')';?></font></h5>
                        <h5 style="color:#0099cc"><font style="font-family:'Kanit',sans-serif; font-size:16px">ใบรับฝากผ้าเลขที่ : <?php echo $object_array[0]['OrderNo'];?></font></h5>
                        <h5 style="color:#0099cc"><font style="font-family:'Kanit',sans-serif; font-size:16px">วันที่นัดรับผ้า : <?php echo $object_array[0]['AppointmentDate'];?></font></h5>
                        <div class="row section-intro">
                            <div class="col-twelve">
                            </div>
                        </div> <!-- /section-intro-->

                        <div class="row resume-timeline">

                            <div class="col-twelve resume-header">

                            </div> <!-- /resume-header -->

                            <div class="col-twelve">

                                <div class="timeline-wrap">

                                    <?php for($i=0;$i<sizeof($arrStatus);$i++){?>
                                    <div class="timeline-block">

                                        <div class="timeline-ico" style="background-color:#0086b3">
                                            <i class="<?php echo $arrIcon[$i];?>" aria-hidden="true"></i>
                                        </div>

                                        <div class="timeline-header">
                                            <h3><font style="font-family:'Kanit',sans-serif; font-size:16px"><?php echo $arrStatus[$i];?></font></h3>
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px"><?php echo $arrDate[$i];?></font></p>
                                        </div>
                                        <div class="timeline-content">
                                            <h4><font style="font-family:'Kanit',sans-serif; font-size:14px"><?php echo $arrStatus[$i];?></font></h4>
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px; color:#cc0000"><?php echo $arrContent[$i];?></font></p>
                                        </div>

                                    </div> <!-- /timeline-block -->

                                    <?php }?>

                                    <!--<div class="timeline-block">

                                        <div class="timeline-ico" style="background-color:#0086b3">
                                            <i class="fa fa-truck"></i>
                                        </div>

                                        <div class="timeline-header">
                                            <h3><font style="font-family:'Kanit',sans-serif; font-size:16px">ผ้าอยู่กับคนขับรถนำส่งโรงงาน</font></h3>
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px">May 2013 - June 2014</font></p>
                                        </div>
                                        <div class="timeline-content">
                                            &lt;!&ndash;<h4><font style="font-family:'Kanit',sans-serif; font-size:14px">ผ้าอยู่กับคนขับรถนำส่งโรงงาน</font></h4>&ndash;&gt;
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px; color:#cc0000">พนักงานขับรถมารับผ้าที่ร้านเพื่อนำไปซักที่โรงงาน</font></p>
                                        </div>
                                    </div> &lt;!&ndash; /timeline-block &ndash;&gt;

                                    <div class="timeline-block">

                                        <div class="timeline-ico" style="background-color:#0086b3">
                                            <i class="fa fa-indent"></i>
                                        </div>

                                        <div class="timeline-header">
                                            <h3><font style="font-family:'Kanit',sans-serif; font-size:16px">ผ้าอยู่กับแผนก Factory Checker In</font></h3>
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px">May 2013 - June 2014</font></p>
                                        </div>
                                        <div class="timeline-content">
                                            &lt;!&ndash;<h4><font style="font-family:'Kanit',sans-serif; font-size:14px">ผ้าอยู่กับแผนก Factory Checker In</font></h4>&ndash;&gt;
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px; color:#cc0000">พนักงานโรงงานกำลังตรวจสอบสินค้าที่ส่งซัก</font></p>
                                        </div>

                                    </div> &lt;!&ndash; /timeline-block &ndash;&gt;
                                    <div class="timeline-block">

                                        <div class="timeline-ico" style="background-color:#0086b3">
                                            <i class="fa fa-outdent"></i>
                                        </div>

                                        <div class="timeline-header">
                                            <h3><font style="font-family:'Kanit',sans-serif; font-size:16px">ผ้าอยู่กับแผนก Factory Checker Out</font></h3>
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px">May 2013 - June 2014</font></p>
                                        </div>
                                        <div class="timeline-content">
                                            &lt;!&ndash;<h4><font style="font-family:'Kanit',sans-serif; font-size:14px">ผ้าอยู่กับแผนก Factory Checker Out</font></h4>&ndash;&gt;
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px; color:#cc0000">พนักงานโรงงานกำลังตรวจสอบและเตรียมจัดส่ง</font></p>
                                        </div>

                                    </div> &lt;!&ndash; /timeline-block &ndash;&gt;
                                    <div class="timeline-block">

                                        <div class="timeline-ico" style="background-color:#0086b3">
                                            <i class="fa fa-truck"></i>
                                        </div>

                                        <div class="timeline-header">
                                            <h3><font style="font-family:'Kanit',sans-serif; font-size:16px">ผ้าอยู่กับคนขับรถนำส่งสาขา</font></h3>
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px">May 2013 - June 2014</font></p>
                                        </div>
                                        <div class="timeline-content">
                                            &lt;!&ndash;<h4><font style="font-family:'Kanit',sans-serif; font-size:14px">ผ้าอยู่กับคนขับรถนำส่งสาขา</font></h4>&ndash;&gt;
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px; color:#cc0000">พนักงานขับรถกำลังส่งผ้าที่ซักเสร็จแล้วไปที่ร้านสาขา</font></p>
                                        </div>
                                    </div> &lt;!&ndash; /timeline-block &ndash;&gt;
                                    <div class="timeline-block">

                                        <div class="timeline-ico" style="background-color:#0086b3">
                                            <i class="fa fa-home"></i>
                                        </div>

                                        <div class="timeline-header">
                                            <h3><font style="font-family:'Kanit',sans-serif; font-size:16px">ผ้าอยู่กับสาขา (Back)</font></h3>
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px">May 2013 - June 2014</font></p>
                                        </div>
                                        <div class="timeline-content">
                                            &lt;!&ndash;<h4><font style="font-family:'Kanit',sans-serif; font-size:14px">ผ้าอยู่กับสาขา (Back)</font></h4>&ndash;&gt;
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px; color:#cc0000">ร้านสาขารับผ้าที่ซักเสร็จแล้วเข้าระบบ รอลูกค้ามารับคืน</font></p>
                                        </div>
                                    </div> &lt;!&ndash; /timeline-block &ndash;&gt;
                                    <div class="timeline-block">

                                        <div class="timeline-ico" style="background-color:#0086b3">
                                            <i class="fa fa-hand-o-left"></i>
                                        </div>

                                        <div class="timeline-header">
                                            <h3><font style="font-family:'Kanit',sans-serif; font-size:16px">ลูกค้ามารับผ้าคืน</font></h3>
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px">May 2013 - June 2014</font></p>
                                        </div>
                                        <div class="timeline-content">
                                            &lt;!&ndash;<h4><font style="font-family:'Kanit',sans-serif; font-size:14px">ลูกค้ามารับผ้าคืน</font></h4>&ndash;&gt;
                                            <p><font style="font-family:'Kanit',sans-serif; font-size:14px; color:#cc0000">ลูกค้ามารับผ้าที่ซักเสร็จแล้วคืน</font></p>
                                        </div>
                                    </div> &lt;!&ndash; /timeline-block &ndash;&gt;-->

                                </div> <!-- /timeline-wrap -->

                            </div> <!-- /col-twelve -->

                        </div> <!-- /resume-timeline -->
                        
                        <?php }}else{?>
                        <h5 style="color:#b32400"><font style="font-family:'Kanit',sans-serif; font-size:16px">ไม่พบเลขที่ใบรับฝากผ้าในระบบ</font></h5>
                        <?php }?>
                </div>
            </div> <!-- /intro-content -->

            <!-- footer
            ================================================== -->

            <div align="center">
                <form method="post" action="index.php">
                    <fieldset>
            </div>
            <button class="submitform" type="submit" style="color:#fff; background-color:#00994d">กลับไปหน้าค้นหา</button>
            </fieldset>
            </form>

            <!-- Java Script
            ================================================== -->
            <script src="js/jquery-2.1.3.min.js"></script>
            <script src="js/plugins.js"></script>
            <script src="js/main.js"></script>

</body>

</html>