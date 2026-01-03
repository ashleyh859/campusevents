<?php
$page_title = "Home";
$filter_base_url = "/";

require_once "includes/db.php";
$db = init_sqlite_db("db/site.sqlite", "db/init.sql");

$tag_param = $_GET["tag"] ?? NULL;

$sql_select_clause = "SELECT DISTINCT events.* FROM events";

$sql_where_clause = "";

if ($tag_param) {
  $sql_where_clause = " INNER JOIN event_tags ON (events.id = event_tags.event_id)
                        INNER JOIN tags ON (event_tags.tag_id = tags.id)
                        WHERE (tags.name = :tag_name)";
}

$sql_query = $sql_select_clause . $sql_where_clause;

if ($tag_param) {
  $result = exec_sql_query($db, $sql_query, array(':tag_name' => $tag_param));
} else {
  $result = exec_sql_query($db, $sql_query);
}
$events = $result->fetchAll();

$result_tags = exec_sql_query($db, "SELECT * FROM tags;");
$tags = $result_tags->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php" ?>

<body>
  <?php include "includes/header.php" ?>

  <div class="hero-banner">
    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?w=1600" alt="Campus Events">
    <div class="hero-content">
      <h1>Discover Your Next Experience</h1>
      <p>Find the best campus events and activities</p>
      <a href="#events-section" class="hero-cta">Browse Events</a>
    </div>
  </div>
  <main class="consumer-layout">
    <?php include "includes/filters.php"; ?>

    <div class="events-section" id="events-section">
      <h2>Events</h2>
      <div class="events-grid">

        <?php
        foreach ($events as $event) {
          $title = htmlspecialchars($event['title']);
          $time = htmlspecialchars($event['time']);
          $location = htmlspecialchars($event['location']);
          $event_id = $event['id'];

          include "includes/event-card.php";
        }
        ?>

      </div>
    </div>
  </main>


</body>

</html>
