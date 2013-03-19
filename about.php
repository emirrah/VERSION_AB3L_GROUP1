<!--
Page Description:
	This page is the ordinary 'about' page.
	This is where information about the features are explained.	
-->

<?php require_once ("header.php");			 // acts like include(); displays the header of the html ?>
	<article id="greet">
		<?php
			//checks if logged in. if not, redirect to main page
			if (isset ($_SESSION['username'])) {
				$user = $_SESSION['username'];
				echo "<h3 style=\"text-align:right;\"> Hello, <a href=\"viewAccount.php\">$user</a>! ";
				echo " | <a href=\"logout.php\"> Logout </a></h3>";
				
				}
			else {
				header ("Location: index.php");
				}
		?>
	</article>
	
	<center>
	<article id="content">		
			<h2 style="text-align:right;"> <a href="user.php"> Home</a> | <a href='favorites.php' >Favorites</a></h2>
			
			<br/>
			<center><h2 style='color:#08c; font-size:30px;'> About the Online Food Ordering System</h2></center>
			
			<ol>
				<li><h2 class='about'> Freebies</h2>
					<p> The original price of the food item availed will be deducted from the current reward point(s).</p>
				<table>
					<tr> <td> Reward Points</td> <td> Corresponding All Food Items</td></tr>
					<tr> <td> 30 - 44</td> <td> < 30php</td></tr>
					<tr> <td> 45 - 59</td> <td> < 40php</td></tr>
					<tr> <td> 60 - 79</td> <td> < 50php</td></tr>
					<tr> <td> 80- 99</td> <td> < 60php</td></tr>
					<tr> <td> 100 - 149</td> <td> < 80php</td></tr>
					<tr> <td> 150 above</td> <td> <= 100php</td></tr>
				</table></li>
				
				<li><h2 class='about'> Reward Points</h2>
					<p> For every P 50.00 purchase of our food, customer will earn 1 point.</p>
				</li>
				
				<li><h2 class='about'> Favorites</h2>
					<p> Favorites Page contains the list of all food combinations of the logged in customer.<br/> This makes ordering faster and easier because customer can order multiple items rather than individually adding food items in the tray.</p>
				</li>
			</ol>
			<br/>
	</article>
	</center>
	<div style="clear:both;">
		<center><a href="user.php" > Return to Main Page</a> </center>
		<?php require_once ("footer.php");			// acts like include(); displays the footer of the html ?>
	</div>