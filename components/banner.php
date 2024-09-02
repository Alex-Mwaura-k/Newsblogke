<?php
// Ensure this file is included only after session_start() is called in the main script

// Retrieve parameters from URL
$header = isset($_GET['header']) ? htmlspecialchars($_GET['header']) : 'Trending';
$bg = isset($_GET['bg']) ? htmlspecialchars($_GET['bg']) : 'default-bg'; // Default background if none is provided

// Check if user ID is available
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

// Function to get the current time of day and return an appropriate greeting
function getGreeting() {
    $hour = (int)date('H');
    if ($hour >= 5 && $hour < 12) {
        return ['Good morning', '👋'];
    } elseif ($hour >= 12 && $hour < 17) {
        return ['Good afternoon', '👋'];
    } elseif ($hour >= 17 && $hour < 21) {
        return ['Good evening', '👋'];
    } else {
        return ['Good night', '🌙'];
    }
}

// Determine if the current page is the home page
$is_home_page = basename($_SERVER['PHP_SELF']) === 'home.php';

if ($is_home_page) {
    // Get the greeting message and emoji
    list($greeting, $emoji) = getGreeting();

    if (!empty($user_id)) {
        // Prepare and execute SQL query to fetch user name
        $select_profile = $conn->prepare("SELECT name FROM `users` WHERE id = ?");
        $select_profile->execute([$user_id]);

        if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            $user_name = htmlspecialchars($fetch_profile['name']); // Sanitize user name

            // Output the greeting message with user name
            $greeting_message = "<p class='greeting'>$greeting $emoji, $user_name</p>";
        } else {
            // Output the generic greeting for a guest
            $greeting_message = "<p class='greeting'>$greeting $emoji</p>";
        }
    } else {
        // Output the generic greeting for a guest
        $greeting_message = "<p class='greeting'>$greeting $emoji</p>";
    }
} else {
    $greeting_message = "<h1>$header</h1>";
}
?>

<section class="page-banners">
   <div class="banner-image" style="background-image: linear-gradient(
    rgba(40, 42, 54, 0.4),
    rgba(29, 29, 29, 0.733)
  ), url('./img/banner/<?= $bg; ?>.jpg');">
      <section>
         <?= $greeting_message; ?>
      </section>
   </div>
</section>
