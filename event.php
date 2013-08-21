<?php
session_start();
date_default_timezone_set('America/Los_Angeles');

$ID = $_GET['ID'];
			
$accounts = mysql_connect("", "", "") or die(mysql_error());
mysql_select_db("eventspark", $accounts);
$sql = "SELECT * FROM events WHERE ID = ".$ID."";
$result = mysql_query($sql, $accounts);
$row = mysql_fetch_array($result);

$eventID = $row['ID'];
$event = $row['Event'];
$olddate = $row['Date'];
$day = date('l',strtotime($olddate));
$date = date('F j, Y',strtotime($olddate));
$location = $row['Location'];
$mainGenre = $row['Genre'];
$price = $row['Price'];
$link = $row['Link'];
$popular = $row['Popularity'];
$picture = $row['Picture'];
$youtube = $row['Youtube'];
$song = $row['SongName'];
$ticket = $row['TicketDate'];
$ticketDate = date('F j, Y',strtotime($ticket));
$ticketT = $row['TicketTime'];
$age = $row['Age'];
$onSale = $row['OnSale'];
$soldOut = $row['SoldOut'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $event;?> - Event Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/favicon.png">
    
     <script type="text/javascript">
	<!--
	if (screen.width <= 699) {
	document.location = "http://www.ventspark.com/mevent.php?ID=<?php echo $eventID?>";
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
	function follow(type, id)
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
		document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
		}
	  }
	xmlhttp.open("GET","follow.php?type=" + type + "&id=" + id,true);
	xmlhttp.send();
	}
	
	$(document).ready(function(){
	  $("button").click(function(){
		$("pre").toggle();
	  });
	});
	</script>
    
  </head>

  <body>
  <div id="fb-root"></div>
	<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=253913974733941";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
	<br>
    <br>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-header">
          <a class="brand" href="home.php"><img src="img/evsclear.png"></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              <?php if (isset($_SESSION["sessionID"])): ?>
              		<font size="4">WELCOME <a class="username" href="user.php"><?php echo strtoupper($_SESSION["username"]);?></a></font>
                    <font size="1"><a class="username" href="logout.php">LOGOUT</a></font>
              <?php else: ?>
              		<font size="4"><a class ="login" href="facebook_login.php">LOGIN</a></font>
              <?php endif ?> 
              <img src="img/evslogo.png">
            </p>
            <ul class="nav">
              <li><a href="home.php">HOME</a></li>
              <li><a href="explore.php">EXPLORE</a></li>
              <li><a href="about.php">ABOUT</a></li>
              <li><a href="contact.php">CONTACT</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    
    
    <div class="container-fluid">
        <div style="width:1200px;">
        
        <?php
			
			echo '<div class="event-entry">';
		    echo '<a href="'.$link.'" target="_blank" class="event_title"><img src="img/logos/'.$event.'.png" alt="'.strtoupper($event).'"></a><hr>';
			
            ?>
            
            <div style="float:left; width:26%;">
            
            <?php
			
			echo '<a href="'.$link.'" target="_blank"><img src="'.$picture.'" class="img-polaroid" height="300" width="300"></a><hr>';
				
				
			//venue information
			$sql2 = "SELECT * FROM venues WHERE Venue = '".$location."'";
			$result2 = mysql_query($sql2, $accounts);
			if($row2 = mysql_fetch_array($result2)) {
				$address = $row2['Address'];
				$pos = strpos($address, ',');
				$addy1 = substr($address, 0, $pos);
				$addy2 = substr($address, $pos + 1);
				$venuephone = $row2['Phone'];
				$phoneformat = '('.substr($venuephone, 0, 3).') '.substr($venuephone, 3, 3).'-'.substr($venuephone, 6, 4);
				$website = $row2['Website'];
				$gmaps = $row2['Gmaps'];
				echo 'Location<br>';
				echo '<a href="'.$website.'" target="_blank">'.$location.'</a></br>';
				echo $addy1.'</br>'.$addy2.'</br>';
				echo $phoneformat.'</br></br>';
				echo $gmaps.'</br>';
			}
			
			echo '<hr>';
			
			
			?>
            
            <?php if (isset($_SESSION["sessionID"])): ?> 
<button>Edit/Update Event Information</button>   
<pre style="display:none"><form action="editEvent.php" method="post">
<b> Event Name </b>
<input type="text" name="event" value="<?php echo $event;?>" required>
<b> Event Date </b>
<input type="date" name="date" value="<?php echo $olddate;?>" required>
<b> Event Location </b>
<input type="text" name="location" value="<?php echo $location;?>" required>
<b> Price </b>
<input type="number" name="price" value="<?php echo $price;?>" >
<b> Link to source </b>
<input type="url" name="link" value="<?php echo $link;?>" >
<b> Link to picture </b>
<input type="url" name="picture" value="<?php echo $picture;?>" >
<b> Tickets go on sale </b>
<input type="date" name="ticketDate" value="<?php echo $ticket;?>">
<b> At what time </b>
<input type="text" name="ticketTime" value="<?php echo $ticketT;?>">
<input type="checkbox" name="sale" value="1" <?php if($onSale == 1) echo 'checked';?>><b> On Sale Now? </b>
<input type="checkbox" name="sold" value="1" <?php if($soldOut == 1) echo 'checked';?>><b> Sold Out? </b>
<input type="checkbox" name="age" value="1" <?php if($age == 1) echo 'checked';?>><b> 21 and over? </b>
<input type="hidden" name="id" value="<?php echo $ID;?>">
<INPUT TYPE="submit"> 
</form></pre>
<?php endif ?>
            
            <img src="img/horblock.png"><br><img src="img/horblock.png">
            
            </div>
            <div style="float:left; width:2%;">
            <img src="img/hbar.png"><br><img src="img/hbar.png"><br><img src="img/hbar.png">
            </div>
            
            <?php
			
			echo '<a class="btn btn-danger" href="'.$link.'" target="_blank">Buy Tickets</a> ';
			
			
			//For following
			$sql = "SELECT Following FROM userevents WHERE EventID = ".$ID." AND AccountID = ".$_SESSION['sessionID']."";
			$result = mysql_query($sql, $accounts);
			$row = mysql_fetch_array($result);
			if ($row['Following'] == '' && isset($_SESSION["sessionID"])) //if not in records, create new
			{
				echo '<div id="myDiv" style="display: inline"><a class="btn btn-info" onclick="follow(0, '.$ID.')">Follow Event</a></div>';
			}
			else if($row['Following'] == 0 && isset($_SESSION["sessionID"])) //if not following, show follow button
			{
				echo '<div id="myDiv" style="display: inline"><a class="btn btn-info" onclick="follow(1, '.$ID.')">Follow Event</a></div>';
			}
			else if($row['Following'] == 1 && isset($_SESSION["sessionID"])) //if following, show currently following
			{
				echo '<div id="myDiv" style="display: inline"><a class="btn btn-success" onclick="follow(2, '.$ID.')">&nbsp;&nbsp;&nbsp;Following&nbsp;&nbsp;</a></div>';
			}
			
			echo '<br>';
			
			//Ticketing On Sale Later
			$ticketMessage = '';
			if ($ticketDate != null && $ticketDate != 'December 31, 1969')
			{
				$ticketMessage = 'Tickets go on sale: '.$ticketDate;
				if ($ticketT != null)
				{
					$ticketMessage .= ' at '.$ticketT;
				}
				$ticketMessage .= '</br>';
			}	
				
			echo '<br><font size="6">'.strtoupper($event).'</br>
				'.$day.'</br>
				'.$date.'</br>
				Starting at $'.$price.'</br>
				'.$ticketMessage;
				
			if ($age == 1)
				echo 'This event is 21+';
				
			echo '</font>';
			
			echo '<hr>';
			
			//artist information
			echo 'Artist(s)<br>';
			
			$sql5 = "SELECT * FROM eventartist WHERE EventID = '".$eventID."'";
			$result5 = mysql_query($sql5, $accounts);
			while($row5 = mysql_fetch_array($result5)) {
				$artists = $row5['Artist'];
				$artistLikeID = $row5['ArtistID'];
				
				$sql3 = "SELECT * FROM artists WHERE Artist = '".$artists."'";
				$result3 = mysql_query($sql3, $accounts);
				if($row3 = mysql_fetch_array($result3)) {
					$artistID = $row3['ID'];
					$yt = $row3['Youtube'];
					$song = $row3['SongName'];
					$yt2 = $row3['Youtube2'];
					$song2 = $row3['SongName2'];
					$rank = $row3['Rank'];
				}
				else
					$artistID = 0;
					
				
				echo '<a href="artist.php?ID='.$artistID.'" class="btn btn-info button_list">'.$artists.'</a>';
				
				//select artist genres
				$sql4 = "SELECT * FROM artistgenre WHERE Artist = '".$artists."'";
				$result4 = mysql_query($sql4, $accounts);
				while($row4 = mysql_fetch_array($result4)) {
					$genre = $row4['Genre'];
					//add only if new unique genre
					if (strstr($genres, $genre) == false)
						$genres .= '<a class="btn btn-warning button_list" disabled>'.$genre.'</a>';
				}
			}
			
			if ($_SESSION["admin"] == 1)
			{
				?>
                <br> <br> 
                <form action="addArtist.php" method="post">
                Add Artist
                <input type="text" name="artist" required>
                <input type="hidden" name="event" value="<?php echo $event;?>">
                <input type="hidden" name="eventID" value="<?php echo $eventID;?>">
                <input type="hidden" name="eventDate" value="<?php echo $olddate;?>">
				<input type="hidden" name="redirect" value="<?php echo 'http://www.ventspark.com/event.php?ID='.$EventID;?>">
                <INPUT TYPE="submit"> 
                </form>
				<br>
                <?php
			}
			
			echo '<hr>';
			
			//print out the previously selected genres
			echo 'Genre(s)<br>';
			echo $genres;
			
			echo '<hr>';
			
			//youtube fetching moved up to where artists are generated
			
			//youtube display
			if ($yt != '')
			{
				echo 'Listen<br>';
				$cut = strpos($yt, '?v=') + 3;
				$use = substr($yt, $cut, 11);
				echo '<iframe width="300" height="200" src="//www.youtube.com/embed/'.$use.'" frameborder="0" allowfullscreen></iframe> ';
				if ($yt2 != '')
				{
					$cut = strpos($yt2, '?v=') + 3;
					$use = substr($yt2, $cut, 11);
					echo '<iframe width="300" height="200" src="//www.youtube.com/embed/'.$use.'" frameborder="0" allowfullscreen></iframe> ';
				}
				echo '<hr>';
			}
			
			//Details: 21+, Attire, Sold out, On sale, etc.
			
			//echo 'Similar Events';
			
			
			echo '<div class="fb-comments" data-href="http://www.ventspark.com/event.php?ID='.$ID.'" data-width="470"></div>';
			
			echo '<br><br><br><br><br><br><br>';
			
			
		?>
        

        </div>
          
          
          
        </div><!--/span-->
        <div class="row-fluid">
        <div class="span2">
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
                Email/Text Reminders<br>
                Music Player<br>
                Personalized Event Recommendations<br>
                </div>
                <div style="width:200px; float:left;">
                <p>About</p>
                Who We Are<br>
                Our Goal<br>
                Support Us<br>
                </div>
                <div style="width:200px; float:left;">
                <p>Contact</p>
                Comments & Feedback<br>
                Bug Submission<br>
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

  </body>
</html>
