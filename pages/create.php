<?php
$page_title = "Create Event";

if (is_user_logged_in()) {

  require_once "includes/db.php";
  $db = init_sqlite_db("db/site.sqlite", "db/init.sql");

  define("MAX_FILE_SIZE", 10000000);

  $result_all_tags = exec_sql_query($db, "SELECT * FROM tags;");
  $all_tags = $result_all_tags->fetchAll();

  $upload_image_name = NULL;
  $upload_image_ext = NULL;

  if (isset($_POST["submit"])) {

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

    if ($upload["error"] != UPLOAD_ERR_OK) {
      $form_valid = false;
      $error_message = "Please upload an image file.";
    }

    if ($form_valid) {
      $upload_image_name = basename($upload["name"]);
      $upload_image_ext = strtolower(pathinfo($upload_image_name, PATHINFO_EXTENSION));

      $allowed_extensions = ['jpg', 'jpeg', 'png'];
      if (!in_array($upload_image_ext, $allowed_extensions)) {
        $form_valid = false;
        $error_message = "Only JPG, JPEG, and PNG files are allowed.";
      }

      try {
        $result = exec_sql_query(
          $db,
          "INSERT INTO events (title, description, time, location, host_organization, image_file, image_ext)
      VALUES (:title, :description, :time, :location, :host_organization, :image_file, :image_ext)",
          array(
            ':title' => $title,
            ':description' => $description,
            ':time' => $time,
            ':location' => $location,
            ':host_organization' => $host_organization,
            ':image_file' => $upload_image_name,
            ':image_ext' => $upload_image_ext
          )
        );

        if ($result) {
          $new_id = $db->lastInsertId("id");

          $upload_storage_path = "public/uploads/events/" . $new_id . "." . $upload_image_ext;

          if (move_uploaded_file($upload["tmp_name"], $upload_storage_path)) {

            if ($new_tag_id != "") {
              exec_sql_query(
                $db,
                "INSERT INTO event_tags (event_id, tag_id) VALUES (:event_id, :tag_id);",
                array(
                  ':event_id' => $new_id,
                  ':tag_id' => $new_tag_id
                )
              );
            }
            header("Location: /admin");
            exit;
          } else {
            $error_message = "Failed to save uploaded file.";
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
        <h2>Create Event</h2>
        <?php if (isset($error_message)) { ?>
          <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php } ?>

        <form method="post" action="/admin/create" enctype="multipart/form-data" novalidate>
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>">

          <div class="label-input">
            <label for="event-title">Event Name:</label>
            <input type="text" name="title" id="event-title" />
          </div>

          <div class="label-input">
            <label for="event-image">Event Flyer:</label>
            <input id="event-image" type="file" name="event-image" accept=".jpeg, .jpg, .png">
          </div>

          <div class="label-input textarea-field">
            <label for="event-description">Description:</label>
            <textarea name="description" id="event-description" rows="5"></textarea>
          </div>

          <div class="label-input">
            <label for="event-time">Time:</label>
            <input type="text" name="time" id="event-time" />
          </div>

          <div class="label-input">
            <label for="event-location">Location:</label>
            <input type="text" name="location" id="event-location" />
          </div>

          <div class="label-input">
            <label for="event-host">Host Organization:</label>
            <input type="text" name="host_organization" id="event-host" />
          </div>

          <div class="label-input tags-field">
            <label for="tag-select">Tags:</label>
            <div class="tags-section">
              <select name="new_tag" id="tag-select">
                <option value="" selected>-- Select a tag --</option>
                <?php foreach ($all_tags as $tag) { ?>
                  <option value="<?php echo htmlspecialchars($tag['id']); ?>">
                    <?php echo htmlspecialchars($tag['name']); ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="align-right">
            <a href="/admin" class="cancel-button">Cancel</a>
            <button type="submit" name="submit">Create Event</button>
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
