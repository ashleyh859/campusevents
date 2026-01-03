<header>
  <h1><a href="/">Campus Events</a></h1>
  <nav>
    <?php if (is_user_logged_in()) { ?>
      <a href="/">Student View</a>
      <a href="/admin">Admin Portal</a>
      <a href="<?php echo logout_url(); ?>">Log Out</a>
    <?php } else { ?>
      <a href="/admin">Log In</a>
    <?php } ?>
  </nav>
</header>
