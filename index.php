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
   <link rel="manifest" href="manifest.json">
   
 	<script type="text/javascript">
	 if ('serviceWorker' in navigator) {
    console.log("Will the service worker register?");
    navigator.serviceWorker.register('service-worker.js')
      .then(function(reg){
         console.log("Yes, it did.");
		 alert("Yes, it did.");
		
     }).catch(function(err) {
        console.log("No it didn't. This happened:", err)
		alert(err);
    });
 	}
	</script>

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
#footer{
    display: table;
    text-align: center;
    margin-left: auto;
    margin-right: auto;
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
 				<!--<img class="img-logo" src="images/logo.png" alt="">
	   			<h5>Hello, World.</h5>-->
	   			<h1><font style="font-family:'Kanit',sans-serif; font-size:30px">Smart Laundry Tracking</font></h1>

	   			<!--<p class="intro-position">
	   				<span><font style="font-family:'Kanit',sans-serif; font-size:16px">Cleanmate</font></span>
	   				<span><font style="font-family:'Kanit',sans-serif; font-size:16px">Tracking</font></span> 
	   			</p>-->
                <h5 style="color:#0099cc"><font style="font-family:'Kanit',sans-serif; font-size:16px">กรอกเลขที่ใบรับฝากผ้าเพื่อค้นหาข้อมูล</font></h5>

	   		</div>
            <div align="center">
            <form method="post" action="tracking.php">
            <fieldset>
            <input name="OrderNo" type="text" id="OrderNo" placeholder="เลขที่ใบรับฝากผ้า" value="" maxlength="10" style="text-align: center; font-family:'Kanit',sans-serif; font-size:16px" required> 
            </div> 
   			<button class="submitform" type="submit" style="color:#fff; background-color:#00994d">ค้นหา</button>
            </fieldset>
            </form>
   		</div>   		 		
   	</div> <!-- /intro-content --> 

   	<!--<ul class="intro-social">        
         <li><a href="https://www.facebook.com/cleanmatedryclean/"><i class="fa fa-facebook" style="color:#b30000"></i></a></li>
         <li><a href="http://cleanmate.net/"><i class="fa fa-globe" style="color:#b30000"></i></a></li>
      </ul>-->     <!-- /intro-social -->      	

   </section> <!-- /intro -->

	
   


   <!-- footer
   ================================================== -->

   <footer>
   <br>
     	<div class="row">

      	<div class="col-twelve">
	      	<div class="copyright" align="center">
		        	<span>© <?php echo date('Y'); ?> Tech Logistic Enterprise Co., Ltd.</span>
		         </div>		                  
	      	</div>
      	</div> <!-- /row -->     	
   </footer>  

   <div id="preloader"> 
    	<div id="loader"></div>
   </div> <br>


   <!-- Java Script
   ================================================== --> 
   <script src="js/jquery-2.1.3.min.js"></script>
   <script src="js/plugins.js"></script>
   <script src="js/main.js"></script>
   

</body>

</html>