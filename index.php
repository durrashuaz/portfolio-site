<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <title>Welcome to My Professional Page </title>
   <link rel="stylesheet" href="reset.css" type="text/css"/>
   <link rel="stylesheet" href="index.css" type="text/css"/>
</head>
<body>

<!Header>
	<header>
	<h1 id = "name">Durra Shuazlan</h1>
			<nav>
			<a href="#about-myself">About Myself</a> </li>
			<a href="#education">Education</a> </li>
			<a href="#skills">Skills</a> </li>
			<a href="#portfolio">Portfolio</a> </li>
			<a href="#experience">Experience</a> </li>
			<a href="viewBlog.php">Blog Posts</a>
			<?php
				session_start(); //show logout link if user is logged in
				if(isset($_SESSION['status'])){
					echo "<a href='logout.php'>Logout</a></li>";
				}
				else{ //show sign up and login links if user is not logged in
					echo "<a href='signUp.html'>Sign Up/</a></li>";
					echo "<a href='login.html'>Login</a></li>";
				}
			?>
			</nav>
	</header>

<div id = "container">

<!Main Section>
<div id = "main">
	<div id = "aboutMyself">
	<section>
	<div class ="aboutMe">
				<figure>
	 		<img src= 'durraPic3.jpeg' width="245" height="300" title = "Durra Shuazlan"> <br /> <figcaption><i>Durra Shuazlan</i></figcaption>
	 		</figure>
		<h3 id="about-myself" class = "label"> About Myself </h3>
		<p>My name is Durra Shuazlan and I am a first year student in Queen Mary University of London studying Computer Science with Management (ITMB). Interested in technology and business, I aim to apply my knowledge in both fields to be of a valuable contribution to the technology industry. You can hopefully learn more about me and interact with me through this website! You can also create your own account to comment on my Blog Posts, check them out!</p>
	 </div>
 </section>

<article>
	<section>
	<div id = "ed">
	<h3 id = "education">Education and Qualifications</h3>
		<p> <b> 2017-2019 </b> International Baccalaureate Diploma - Nexus International School Putrajaya, Malaysia </p>
		<p> <b> 2019-2023 (Expected)</b> BSc Computer Science with Management (ITMB) with Industrial Placement - Queen Mary University of London </p>
	</div>
	</section>


	<section>
		<h3 id = "skills">Skills and Achievements </h3>
			<h2>Skills</h2>
			<ul>
				<li>Procedural and Object Oriented Programming- Java</li>
	 			<li>Web Development- CSS, Javascript, PHP</li>
				<li>Information System Analysis</li>
			</ul>
			<h2> Achievements </h2>
			<ul>
				<li>QMUL Global Science and Engineering Entrance Scholarship</li>
				<li>Runner-up prize at Tech Industry Gold ‘University Reimagined’ Competition</li>
			</ul>
	 </section>

	 <section>
		<h3 id = "portfolio">Portfolio</h3>
		<p> You can view my CV via this <a href="my_CV.html">link</a></p>
				<h2> Procedural Programming Mini Project </h2>
				<ul>
					<li>I desiged an impossible answer quiz that lets players choose a topic and keep track of points.</li>
				</ul>
				<h2> Object-Oriented Programming Mini Project</a></h2>
				<ul>
					<li>Implemented OOP concepts in my stock simulation program such as inheritance, polymorphism and abstraction.</li>
				</ul>
	</section>

	<section>
	<h3 id = "experience">Experience</h3>
		<p> I have gained valuable skills such as problem solving, communication, perseverance and many more through these experiences: </p>
		<ul>
			<li>Academic:</li>
			<ul>
				<li>Professional Research and Practice Module group presentation</li>
				<li>Collaborative IB Group 4 Project</li>
				<li>IB Philosophy Group Presentation</li>
			</ul>
			<li>Voluntary:</li>
			<ul>
				<li>Weekly bonding sessions with Myanmar refugees in Malaysia</li>
				<li>Local Pet Adoption Center Fundraising</li>
			</ul>
		</ul>
	</section>

</article>
</div> <!end main>
<!Right Section>
	<aside>
		<div class = "hobbiesBox">
			<h6> Last Updated: April 2020</h6>
			<h6> Post Blog</h6>
			<?php
			if(!isset($_SESSION)){
				session_start();
			}
			if(isset($_SESSION['status'])){
				echo "<p>Welcome " . $_SESSION["name"] . "</p>";
					if($_SESSION['status'] === "admin"){
						echo "<p><a href='redirect.php'>Create Blog Entry</a></p>";
					}
					else if($_SESSION['status'] === "guest"){
						echo "<p>Only admins can create blog entries.</p>";
					}
			}
			else{
				echo "<p><a href='redirect.php'>Create Blog Entry</a></p>";
			}
			?>
			</p>
		</div>

  		<div id = "hobbies" class ="hobbiesBox">
  			<h6> My Links</h6>
   			<p><a href="https://www.linkedin.com/in/durra-shuazlan-57b688195/"</a>Linked In</p>
			<p> <a href="https://github.com/durrashuaz">GitHub Profile</a> </p>
		</div>

		<div class = "hobbiesBox">
			<h6>Contact Me</h6>
			<p><a href="mailto: d.shuazlan@se19.qmul.ac.uk">Email</a> </p>
		</div>
	</aside>
<div> <!end container>

<!Footer>
	<footer>
		<p id = "copyright"> <em>Copyright Ⓒ Durra Shuazlan 2020 </em></p>
	</footer>

</body>
</html>
