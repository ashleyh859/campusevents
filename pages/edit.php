<?php
$page_title = "Edit Event";

if (is_user_logged_in()) {

  require_once "includes/db.php";
  $db = init_sqlite_db("db/site.sqlite", "db/init.sql");

  define("MAX_FILE_SIZE", 10000000);

  $event_id = $_GET['id'] ?? NULL;

  $remove_tag_id = $_GET['remove_tag'] ?? NULL;

  if ($remove_tag_id && $event_id) {
    exec_sql_query(
      $db,
      "DELETE FROM event_tags WHERE event_id = :event_id AND tag_id = :tag_id;",
      array(
        ':event_id' => $event_id,
        ':tag_id' => $remove_tag_id
      )
    );
    header("Location: /admin/edit?id=" . $event_id);
    exit;
  }

  $sql_select_clause = "SELECT * FROM events";
  $sql_where_clause = "";

  if ($event_id) {
    $sql_where_clause = " WHERE (id=:event_id)";
  }

  $sql_query = $sql_select_clause . $sql_where_clause;

  if ($event_id) {
    $result = exec_sql_query($db, $sql_query, array(':event_id' => $event_id));
  } else {
    $result = exec_sql_query($db, $sql_query);
  }
  $events = $result->fetchAll();
  //find 1st record, if not set it as NULL
  $event = $events[0] ?? NULL;

  $sql_tags_query = "SELECT tags.id AS 'tags.id', tags.name AS 'tags.name'
                   FROM tags
                   INNER JOIN event_tags ON (tags.id = event_tags.tag_id)
                   WHERE (event_tags.event_id = :event_id)";

  if ($event_id) {
    $result_tags = exec_sql_query($db, $sql_tags_query, array(':event_id' => $event_id));
    $event_tags = $result_tags->fetchAll();
  } else {
    $event_tags = array();
  }

  $result_all_tags = exec_sql_query($db, "SELECT * FROM tags;");
  $all_tags = $result_all_tags->fetchAll();

  $current_tag_ids = array();
  foreach ($event_tags as $tag) {
    $current_tag_ids[] = $tag['tags.id'];
  }

  if (isset($_POST["submit"]) && $event) {

    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $time = trim($_POST["time"] ?? "");
    $location = trim($_POST["location"] ?? "");
    $host_organization = trim($_POST["host_organization"] ?? "");
    $new_tag_id = $_POST["new_tag"] ?? "";

    $upload = $_FILES["event-image"];

    $form_valid = true;

    if ($title == "" || $description == "" || $time == "" || $location == "" || $host_organization == "") {
      $form_valid = false;
      $error_message = "Please fill in all fields.";
    }

    if ($upload["error"] == UPLOAD_ERR_OK) {
      $upload_image_name = basename($upload["name"]);
      $upload_image_ext = strtolower(pathinfo($upload_image_name, PATHINFO_EXTENSION));

      $allowed_extensions = ['jpg', 'jpeg', 'png'];
      if (!in_array($upload_image_ext, $allowed_extensions)) {
        $form_valid = false;
        $error_message = "Only JPG, JPEG, and PNG files are allowed.";
      }
    } else if ($upload["error"] == UPLOAD_ERR_NO_FILE) {
      $upload_image_name = $event['image_file'];
      $upload_image_ext = $event['image_ext'];
    } else {
      $form_valid = false;
      $error_message = "Image upload failed";
    }

    if ($form_valid) {
      try {
        $result = exec_sql_query(
          $db,
          "UPDATE events
          SET title = :title,
             description = :description,
             time = :time,
             location = :location,
             host_organization = :host_organization,
             image_file = :image_file,
             image_ext = :image_ext
         WHERE id = :id;",
          array(
            ':title' => $title,
            ':description' => $description,
            ':time' => $time,
            ':location' => $location,
            ':host_organization' => $host_organization,
            ':image_file' => $upload_image_name,
            ':image_ext' => $upload_image_ext,
            ':id' => $event_id
          )
        );

        if ($result) {
          if ($new_tag_id != "" && !in_array($new_tag_id, $current_tag_ids)) {
            exec_sql_query(
              $db,
              "INSERT INTO event_tags (event_id, tag_id) VALUES (:event_id, :tag_id);",
              array(
                ':event_id' => $event_id,
                ':tag_id' => $new_tag_id
              )
            );
          }
          if ($upload["error"] == UPLOAD_ERR_OK) {
            $upload_storage_path = "public/uploads/events/" . $event_id . "." . $upload_image_ext;

            if (move_uploaded_file($upload["tmp_name"], $upload_storage_path)) {
              header("Location: /admin");
              exit;
            } else {
              $error_message = "Failed to save uploaded file.";
            }
          } else {
            header("Location: /admin");
            exit;
          }
        }
      } catch (PDOException $exception) {
        $error_message = "Database error: " . $exception->getMessage();
      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php" ?>

<body>
  <?php include "includes/header.php" ?>

  <main class="edit-event">
    <?php if (is_user_logged_in()) { ?>
      <div class="form-container">
        <h2>Edit Event</h2>

        <?php if (isset($error_message)) { ?>
          <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php } ?>

        <form method="post" enctype="multipart/form-data" novalidate>
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>">

          <div class="label-input">
            <label for="event-title">Event Name:</label>
            <input type="text" name="title" id="event-title" value="<?php echo htmlspecialchars($event['title']); ?>" />
          </div>

          <div class="label-input">
            <label for="event-image">Event Flyer:</label>
            <input id="event-image" type="file" name="event-image" accept=".jpeg, .jpg, .png">
          </div>

          <div class="label-input textarea-field">
            <label for="event-description">Description:</label>
            <textarea name="description" id="event-description" rows="5"><?php echo htmlspecialchars($event['description']); ?></textarea>
          </div>

          <div class="label-input">
            <label for="event-time">Time:</label>
            <input type="text" name="time" id="event-time" value="<?php echo htmlspecialchars($event['time']); ?>" />
          </div>

          <div class="label-input">
            <label for="event-location">Location:</label>
            <input type="text" name="location" id="event-location" value="<?php echo htmlspecialchars($event['location']); ?>" />
          </div>

          <div class="label-input">
            <label for="event-host">Host Organization:</label>
            <input type="text" name="host_organization" id="event-host" value="<?php echo htmlspecialchars($event['host_organization']); ?>" />
          </div>

          <div class="label-input tags-field">
            <label for="tag-select">Tags:</label>
            <div class="tags-section">
              <select name="new_tag" id="tag-select">
                <option value="" selected>-- Select new tags --</option>

                <?php foreach ($all_tags as $tag) { ?>
                  <option value="<?php echo htmlspecialchars($tag['id']); ?>">
                    <?php echo htmlspecialchars($tag['name']); ?>
                  </option>
                <?php } ?>
              </select>

              <div class="tag-list">
                <?php foreach ($event_tags as $tag) { ?>
                  <div class="tag-with-remove">
                    <p><?php echo htmlspecialchars($tag['tags.name']); ?></p>
                    <a href="?id=<?php echo htmlspecialchars($event_id); ?>&remove_tag=<?php echo htmlspecialchars($tag['tags.id']); ?>" class="remove-tag">✕</a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>

          <div class="align-right">
            <a href="/admin" class="cancel-button">Cancel</a>
            <button type="submit" name="submit">Save Changes</button>
          </div>

        </form>
      </div>
    <?php } else { ?>
      <div class="login-centered">
        <h2>Log In to View Admin Portal</h2>

        <?php echo login_form('/admin', $session_messages); ?>

        <p class="back-to-home">
          <a href="/">← Back to Home</a>
        </p>
      </div>
    <?php } ?>

  </main>

</body>

</html>
