<?php
session_start();
date_default_timezone_set('America/Los_Angeles');
$ip = $_SERVER['REMOTE_ADDR'];
$dateTime = date("m/d/y : h:i:s", time());
$accounts = mysql_connect("", "", "") or die(mysql_error());	
mysql_select_db("eventspark", $accounts);
$sql = "INSERT INTO log (IP, Date, User) VALUES
	('".$ip."', '".$dateTime."', '".$_SESSION["username"]."')";
mysql_query($sql, $accounts);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>eVent Spark - Event Information Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/favicon.png">
    <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    
    <script type="text/javascript">
	<!--
	if (screen.width <= 699) {
	document.location = "mhome.php";
	}
	//-->
	</script>
    
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-40340478-1', 'ventspark.com');
	  ga('send', 'pageview');
	
	</script>

    <!-- Le styles -->
    <link href="css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    
    <script type="text/javascript">
	function altRows(id)
	{
		if(document.getElementsByTagName)
		{  
			
			var table = document.getElementById(id);  
			var rows = table.getElementsByTagName("tr"); 
			 
			for(i = 0; i < rows.length; i++)
			{          
				if(i % 2 == 0)
				{
					rows[i].className = "evenrowcolor";
				}
				else
				{
					rows[i].className = "oddrowcolor";
				}      
			}
		}
	}
	
	window.onload=function()
	{
		altRows('alternatecolor');
	}
	
	
	function action(elem, type, row)
	{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			if (type == 1)
				document.getElementById("alternatecolor").innerHTML=xmlhttp.responseText;
			else if (type == 2)
			{
				document.getElementById("audio").innerHTML=xmlhttp.responseText;
			}
			else if (type == 3 || type == 4)
				document.getElementById("hearticon" + row).innerHTML=xmlhttp.responseText;
		}
	  }
	if (type == 1)
	{
		xmlhttp.open("GET","change.php?id=" + elem + "&special=" + row,true);
		xmlhttp.send();
		setTimeout(function() {
		altRows('alternatecolor');
		}, 1000);
	}
	else if (type == 2)
	{
		xmlhttp.open("GET","audio.php?id=" + elem + "&rand=" + row,true);
		xmlhttp.send();
	}
	else if (type == 3 || type == 4)
	{
		xmlhttp.open("GET","heart.php?id=" + elem + "&type=" + type + "&row=" + row,true);
		xmlhttp.send();
	}
	}
	
	function music(youtube, song)
	{
	var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			document.getElementById("musicp").innerHTML=xmlhttp.responseText;
	  }
	  xmlhttp.open("GET","music.php?yt=" + youtube + "&song=" + song,true);
	  xmlhttp.send();
	}
	
	$(document).ready(function(){
	  	$("a#fade").fadeTo('slow', 1)
	});
	
	</script>

  </head>

  <body>
    <div id="audio">
      <br>
    </div>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-header">
          <a id="fade" class="brand almost" href="home.php"><img src="img/evsclear.png"></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              <?php if (isset($_SESSION["sessionID"])): ?>
              		<font size="4">WELCOME <a class="username" href="user.php"><?php echo strtoupper($_SESSION["username"]);?></a></font>
                    <font size="1"><a class="username" href="logout.php">LOGOUT</a></font>
              <?php else: ?>
              		<font size="4"><a class ="login" href="facebook_login.php">SIGNUP/LOGIN</a></font>
              <?php endif ?> 
              <a href="home.php"><img src="img/evslogo.png"></a>
            </p>
            <ul class="nav">
              <li class="active"><a href="home.php">EDM</a></li>
              <li><a href="sparks.php">ACTIVITIES</a></li>
              <li><a href="night.php">NIGHT LIFE</a></li>
              <li><a href="explore.php">EXPLORE</a></li> <!--change this to be points of interest-->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    <br>
    
    <div class="container-fluid">
        <div class="span10">
          <div class="event-entry">
          <div class="slider-wrapper theme-default" style="display: inline">
          <img src="img/topevents.png">
            <div id="slider" class="nivoSlider">
            <?php
			$sql = "SELECT * FROM events WHERE Date >= CURDATE() AND Popularity > 3 AND LocationGeneral != 'Las Vegas' ORDER BY Date";
			$result = mysql_query($sql, $accounts);
			for($i = 1; $i <= 5; $i++) {
				$row = mysql_fetch_array($result);
				while ($event == $row['Event'])
					$row = mysql_fetch_array($result);
				$event = $row['Event'];
				$ID = $row['ID'];
				$olddate = $row['Date'];
				$date = date('l, F j',strtotime($olddate));
				$location = $row['Location'];
				$price = $row['Price'];
				if ($price != 0)
					$price = ' - Starting at $'.$price;
				else
					$price = '';
				$link = $row['Link'];
				$picture = $row['Picture'];
				$banner = $row['Banner'];
				if (!is_null($banner))
					$picture = $banner;
				
				echo '<a href="event.php?ID='.$ID.'"><img src="'.$picture.'" alt="" title="'.$event.' - '.$date.' at '.$location.$price.'"/></a>';
			}
			$profileLink = "<a href='user.php'>profile</a>";
			echo '<a href="user.php"><img src="http://i.imgur.com/E5tCOTJ.png" alt="" title="Change between EMAIL and TEXT notifications in your '.$profileLink.'"/></a>';
			?>
            </div>
       	  </div>
          <img src="img/upcomingl.png">
          <div class="btn-group" style="display: inline">
              <button class="btn" onclick="action('Rec', 1, 0)">Recommended</button>
              <button class="btn" onclick="action('Pop', 1, 0)">Popular</button>
              <button class="btn" onclick="action('All', 1, 0)">All</button>
		  </div>
              <button class="btn" onclick="action('Veg', 1, 0)">VEGAS</button>
          </div>
          
          <table class="altrowstable" id="alternatecolor">
          <tr>
          	 <th></th><th></th><th><button class="text_button" onclick="action('Event', 1, 0)" title="Sort by event name">Event</button></th><th><button class="text_button" onclick="action('Date', 1, 0)" title="Sort by event date">Date</button></th><th><button class="text_button" onclick="action('Venue', 1, 0)" title="Sort by venue name">Venue</button></th><th><button class="text_button" onclick="action('Genre', 1, 0)" title="Sort by music genre">Music</button></th><th><button class="text_button" onclick="action('Price', 1, 0)" title="Sort by starting price">Price</button></th><th><button class="text_button">&nbsp;&nbsp;&nbsp;Link</button></th><th>&nbsp;&nbsp;&nbsp;</th>
          </tr>
          
            <?php
			$rowNumber = 1;
			$sql = "SELECT * FROM events WHERE Date >= CURDATE() AND LocationGeneral IS NOT NULL AND LocationGeneral != 'Las Vegas' AND Popularity > 1 ORDER BY Date";
			$result = mysql_query($sql, $accounts);
			while($row = mysql_fetch_array($result)) {
			
				$ID = $row['ID'];
				$event = $row['Event'];
				$olddate = $row['Date'];
				$day = date('l',strtotime($olddate));
				$date = date('D, M j',strtotime($olddate));
				$date2 = date('F j',strtotime($olddate));
				$location = $row['Location'];
				$lg = $row['LocationGeneral'];
				$genre = $row['Genre'];
				$price = $row['Price'];
				$link = $row['Link'];
				$ticket = $row['TicketDate'];
				$age = $row['Age'];
				$onSale = $row['OnSale'];
				$soldOut = $row['SoldOut'];
				$today = date('Y-m-d');
				$followCount = $row['Followings'];
				
				
				//Automate fetching of city of venue
				$sql3 = "SELECT * FROM venues WHERE Venue = '".$location."'";
				$result3 = mysql_query($sql3, $accounts);
				$row3 = mysql_fetch_array($result3);
				$city = $row3['City'];
				
				//Automate randomizing one of two possible youtube songs from artist table
				$sql4 = "SELECT * FROM artists WHERE Artist = '".$event."'";
				$result4 = mysql_query($sql4, $accounts);
				$row4 = mysql_fetch_array($result4);
				$rand = rand(0, 1);
				if ($rand == 0)
				{
					$youtube = $row4['Youtube'];
					$song = $row4['SongName'];
				}
				else
				{
					$youtube = $row4['Youtube2'];
					$song = $row4['SongName2'];
				}
				
				$key = "'";
				$string = '"action('.$ID.', 2, '.$rand.'); music('.$key.$youtube.$key.', '.$key.$song.$key.')"';
				
				if ($genre != 'Massive') //Automate genre fetching by artist
				{
					$sql5 = "SELECT * 
							FROM  `artistgenre` 
							WHERE  Artist = '".$event."' AND `Primary` =1";
					$result5 = mysql_query($sql5, $accounts);
					$row5 = mysql_fetch_array($result5);
					if ($row5['Genre'] != '')
						$genre = $row5['Genre'];
				}
				
				//Fetching of followings (hearts)
				$sql2 = "SELECT * FROM userevents WHERE AccountID = ".$_SESSION["sessionID"]." AND EventID = ".$ID;
				$result2 = mysql_query($sql2, $accounts);
				$row2 = mysql_fetch_array($result2);
				
				$click = "document.getElementById('form-id').submit();";
				
				$key1 = "'".$location."'";
				$key2 = "'".$genre."'";
				
				
				//Fetch total followings for each event
				//$followCount = 0; //show true
				$sql6 = "SELECT * FROM userevents WHERE EventID = ".$ID." AND Following = 1";
				$result6 = mysql_query($sql6, $accounts);
				while ($row6 = mysql_fetch_array($result6))
					$followCount += 1;
				
				//Price to show
				if ($price == 0)
					$priceShown = 'N/A';
				else
					$priceShown = '$'.$price;
				
				
				
				//<img src="img/logos/'.$event.'.png" alt="'.strtoupper($event).'" height="30" width="120">
				
				echo '<tr><td width=1%></td>';
				echo '<td width=4% id="hearticon'.$rowNumber.'">';
					if ($row2['Following'] == 1)
						echo '<div class="imageContainer2 hand" onclick="action('.$ID.', 3, '.$rowNumber.')" title="Click to unfollow">'.$followCount.'</div>';
					else
						echo '<div class="imageContainer hand" onclick="action('.$ID.', 4, '.$rowNumber.')" title="Click this heart to follow this event!">'.$followCount.'</div>';
						//<b onclick="action('.$ID.', 4, '.$rowNumber.')"><i class="icon-heart shade hand"></i></b>&nbsp;
				echo '</td>
					<td width=25%><a href="event.php?ID='.$ID.'" class="table_pad">'.strtoupper($event).' </a></td>
					<td width=20%>'.$date2.'<br><font size="2">'.$day.'</font></td>
					<td width=25%><a class="hand hard_link" onclick="action('.$key1.', 1, 1)" title="View all events at this location">'.$location.'<br><font size="2">'.$city.'</font></a></td>
					<td width=15%><a class="hand hard_link" onclick="action('.$key2.', 1, 2)" title="View all events of this genre">'.$genre.'</a><br>';
					if ($youtube != '')
						echo '<a class="hand hard_link" onclick='.$string.' title="Listen to a sample track of this artist"><font size="2">LISTEN</font></a>&nbsp;';
					echo '</td>
					<td width=7%>'.$priceShown.'</td>';
					echo '<td width=5%><a href="'.$link.'" target="_blank" STYLE="text-decoration: none"><center>
				  BUY TICKETS</center></a></td>
					<td width=3%><a href="'.$link.'" target="_blank" STYLE="text-decoration: none">
					<i class="icon-chevron-right"></i></a></td>
				</td>';
			$rowNumber ++;
			
			}
			?>
          </table>
          
          <div class="progress progress-danger progress-striped active">
          	<div class="bar" style="width: 100%;"></div>
       	  </div>
          
          <br>
          
        </div><!--/span-->
        <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
          	<ul class="nav nav-list">
            <li class="music"><img src="img/Beat.gif"> Now Playing:</li>
            <li id="musicp" class="music"><a class="musicplayer">CURRENTLY OFF</a></li>
            <li class="music hand"><b onClick="action(0, 2, 0); music('', 'CURRENTLY OFF')"><i class="icon-volume-off"></i> Stop Music</b></a></li> 
            </ul>
          	<hr>
            <ul class="nav nav-list">
            <b>We've got you covered!<br>
            We have all the top EDM listings from the following areas:</b>
            </ul>
          	<hr>
            <ul class="nav nav-list">
              <li class="nav-header">LA/OC Venues</li>
              <li><a href="http://www.sutraoc.com/">Sutra OC</a></li>
              <li><a href="http://www.exchangela.com/calendar/event-calendar">Exchange LA</a></li>
              <li><a href="http://www.yosttheater.com/nightclubs/">Yost Theater</a></li>
              <li><a href="http://www.createnightclub.com/shows.cfm">Create</a></li>
              <li><a href="http://www.ticketmaster.com/The-Wiltern-tickets-Los-Angeles/venue/73790">The Wiltern</a></li>
              <li><a href="http://www.avalonhollywood.com/calendar/">Avalon</a></li>
              <li><a href="http://www.belascoguestlist.com/category/events/">Belasco</a></li>
              <li><a href="http://www.foxpomona.com/">The Fox Theater</a></li>
              <li><a href="http://www.lurehollywood.com/events/">Lure</a></li>
              <li><a href="http://www.livenation.com/venues/14586/hollywood-palladium">Palladium</a></li>
              <li><a href="http://www.shrineauditorium.com/events">Shrine Expo Hall</a></li>
              <li class="nav-header">Vegas</li>
              <li><a href="http://www.marqueelasvegas.com/events/">Marquee</a></li>
              <li><a href="http://www.taolasvegas.com/events/">TAO</a></li>
              <li><a href="http://www.hakkasanlv.com/events/">Hakkasan</a></li>
              <li><a href="http://www.xslasvegas.com/">XS</a></li>
              <li><a href="http://www.wynnlasvegas.com/NightClubs/EncoreBeachClub">Encore</a></li>
              <li><a href="http://www.surrendernightclub.com/calendar/">Surrender</a></li>
              <li><a href="http://thelightvegas.com/">Light</a></li>
              <li class="nav-header">Ticketing</li>
              <li><a href="http://www.flavorus.com/">Flavorus</a></li>
              <li><a href="http://www.insomniac.com/">Insomniac</a></li>
              <li><a href="http://www.ticketmaster.com/">Ticketmaster</a></li>
              <li><a href="http://www.wantickets.com/">Wantickets</a></li>
              <li><a href="http://www.eventbrite.com/">Eventbrite</a></li>
              <li><a href="http://www.ticketfly.com/">Ticketfly</a></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
      </div><!--/row-->

    </div><!--/.fluid-container-->
    <footer>
        <div class="footer_box">
        	<div class="footer_text">
            	<br>
                <div style="width:100px; float:left;">
                <img src="img/block.png">
                </div>
            	<div style="width:200px; float:left;">
                <p>Features</p>
                <a class="nochange" href="about.php#accordion2">Email/Text Reminders</a><br>
                <a class="nochange" href="about.php#collapseTwo">Music Player</a><br>
                <a class="nochange" href="about.php#collapseThree">Personalized Event Recommendations</a><br>
                </div>
                <div style="width:200px; float:left;">
                <p>About</p>
                <a class="nochange" href="company.php#goal">Our Goal</a><br>
                <a class="nochange" href="company.php#about">Who We Are</a><br>
                <a class="nochange" href="company.php#support">Support Us</a><br>
                </div>
                <div style="width:200px; float:left;">
                <p>Contact</p>
                <a class="nochange" href="contact.php">Comments & Feedback</a><br>
                <a class="nochange" href="contact.php#bugs">Bug Submission</a><br>
                </div>
                <div style="width:200px; float:left;">
                <p>Careers</p>
                Internships<br>
                Join the Team!<br>
                </div>
                <br><br><br><br><br><br><br>
           		&copy; eVent Spark 2013
            </div>
        </div>
    </footer>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
    <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
		animSpeed: 500,	
		pauseTime: 5000,
		randomStart: false,
		controlNav: false
		});
    });
    </script>

  </body>
</html>
