<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

   <a href="home.php" class="logo"><img src="./img/logo.png" alt="web_logo"></a>
   <nav class="navigation">
         <ul class="navlinks">
         <a href="home.php" data-bg="default-bg"><li>Home</li></a>
         <a href="category.php?category=technology&header=Tech&bg=technology-bg"><li>Tech</li></a>
         <a href="category.php?category=general&header=General&bg=general-bg"><li>General</li></a>
         <a href="category.php?category=AI&header=AI&bg=ai-bg"><li>AI</li></a>
         <a href="category.php?category=cyberattacks&header=Cyber Attacks&bg=cyberattacks-bg"><li>Cyber Attacks</li></a>
         <a href="category.php?category=education&header=Tech StartUps&bg=startup-bg"><li>Tech StartUps</li></a>
         <a href="category.php?category=education&header=Education&bg=education-bg"><li>Education</li></a>
         <a href="category.php?category=contact&header=Contact&bg=contact-bg"><li>Contact</li></a>
      </ul>

   </nav>

      <div class="icons">
      <form action="search.php" method="POST" class="search-form">
         <input type="text" name="search_box" class="box" maxlength="100" placeholder="search..." required>
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
      </div>

      <nav class="navbar">
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="posts.php"> <i class="fas fa-angle-right"></i> posts</a>
         <a href="all_category.php"> <i class="fas fa-angle-right"></i> category</a>
         <a href="authors.php"> <i class="fas fa-angle-right"></i> authors</a>
         <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>
         <a href="register.php"> <i class="fas fa-angle-right"></i> register</a>
      </nav>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <a href="update.php" class="btn">update profile</a>
         <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         <?php
            }else{
         ?>
            <a href="login.php" class="option-btn">login</a>
         <?php
            }
         ?>
      </div>

   </section>
</header>
