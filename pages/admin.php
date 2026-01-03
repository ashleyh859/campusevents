<?php
$page_title = "Admin Portal";

if (is_user_logged_in()) {

  $filter_base_url = "/admin";

  require_once "includes/db.php";
  $db = init_sqlite_db("db/site.sqlite", "db/init.sql");

  $confirm_delete_id = $_GET['confirm_delete'] ?? NULL;
  $delete_id = $_GET['delete'] ?? NULL;

  if ($delete_id) {
    exec_sql_query(
      $db,
      "DELETE FROM event_tags WHERE event_id = :event_id;",
      array(':event_id' => $delete_id)
    );
    exec_sql_query(
      $db,
      "DELETE FROM events WHERE id = :event_id;",
      array(':event_id' => $delete_id)
    );
    header("Location: /admin");
    exit;
  }


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
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php"; ?>

<body>
  <?php include "includes/header.php" ?>

  <main class="admin-layout">
    <?php if (is_user_logged_in()) { ?>

      <?php include "includes/filters.php"; ?>

      <div class="events-section">
        <div class="events-header">
          <h2>Events</h2>
          <a href="/admin/create" class="create-button">+ Create Event</a>
        </div>

        <?php if ($confirm_delete_id) {
          $confirm_event = exec_sql_query($db, "SELECT * FROM events WHERE id = :id;", array(':id' => $confirm_delete_id))->fetch();
          if ($confirm_event) {
        ?>
            <div class="delete-confirmation">
              <p>Are you sure you want to delete "<strong><?php echo htmlspecialchars($confirm_event['title']); ?></strong>"?</p>
              <div class="confirmation-buttons">
                <a href="/admin" class="cancel-delete-btn">Cancel</a>
                <a href="?delete=<?php echo htmlspecialchars($confirm_delete_id); ?>" class="confirm-delete-btn">Yes, Delete</a>

              </div>
            </div>
        <?php
          }
        } ?>

        <div class="admin-events">
          <?php
          foreach ($events as $event) {
            $title = htmlspecialchars($event['title']);
            $time = htmlspecialchars($event['time']);
            $location = htmlspecialchars($event['location']);
            $event_id = $event['id'];

            include "includes/event-tile.php";
          }
          ?>
        </div>
      </div>
    <?php } else { ?>
      <div class="login-centered">
        <h2>Admin Login</h2>

        <?php echo login_form('/admin', $session_messages); ?>

        <p class="back-to-home">
          <a href="/">← Back to Home</a>
        </p>
      </div>

    <?php } ?>

  </main>

</body>

</html>
