<?php
  ob_start();
  require_once "../constants/users.php";
  require_once "../constants/posts.php";
  require_once "../utils/db/crud.php";
  require_once "../utils/db/routes.php";

  $crud = new Crud();
  $post_C = new PostConstants();
  $user_C = new UserConstants();
  $routes = new Routes();

  $is_valid_session = $routes->check_session($user_C->getSessionToken());
  $post_content = $crud->getAllData($post_C->getTableName());

  function getTimeAgo($createdAt)
  {
      $timezone = new DateTimeZone('GMT+8');  
      $createdAt = new DateTime($createdAt, $timezone);
  
      $now = new DateTime('now', $timezone);
      $interval = $now->diff($createdAt);
  
      if ($interval->d > 0) {
          return $interval->d . ' days ago';
      } elseif ($interval->h > 0) {
          return $interval->h . ' hours ago';
      } elseif ($interval->i > 0) {
          return $interval->i . ' minutes ago';
      } else {
          return 'just now';
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camarines Norte Festivals Feed</title>
    <link rel="stylesheet" href="../styles/newsfeed.css">
    <link rel="stylesheet" href="../styles/post.css">
  </head>
  <body>
    <?php include "../components/navbar.php"?>

    <div class="newsfeed-container">
      <!-- button para  maopen modal -->
    <button id="openModalBtn">Create Post</button>

  <!-- modal -->
  <div id="postModal" class="modal">
      <div class="modal-content">
        <form action="<?php echo $crud->getCurrentPage()?>" method="post" enctype="multipart/form-data">

            <!-- close button -->
            <span class="close-btn" id="closeModalBtn">&times;</span>
            <h2>Create a Post</h2>
            
            <!-- post -->
            <textarea id="postText" placeholder="What's on your mind?" name="post-content" required></textarea>
            <input type="file" id="imageInput" accept="image/*" name="image-input" required>

            <img id="imagePreview" src="" alt="Image Preview" style="display: none;">
            
            <!-- submit -->
            <button id="submitPost" type="submit">Post</button>
        </form>
      </div>
  </div>

  <!-- try posted content pabago o paalis if di need -->
    <?php foreach ($post_content as $post): ?>
        <!-- Post 1 -->
        <div class="post" post_id="<?= htmlspecialchars($post[$post_C->getPostId()]); ?>">
          <?php
              $postedBy = $crud->getRowByValue($user_C->getTableName(), $user_C->getUserId(), $post[$post_C->getUserId()]);
          ?>
            
          <div class="post-header">
            <div class="post-info">
              <p class="profile-name"><?= htmlspecialchars($postedBy[0][$usr_C->getUsername()]) ?></p>
              <p class="post-time"><?= htmlspecialchars(getTimeAgo($post[$post_C->getDateAdded()])); ?></p>
            </div>
          </div>

          <p class="post-content">
            <?= htmlspecialchars($post[$post_C->getDescription()]) ?>
          </p>

          <div class="post-gallery">
            <img src="../assets/server/<?= htmlspecialchars($post[$post_C->getImage()])?>" alt="Post Image">
          </div>

          <div class="comment-section">
            <textarea placeholder="Write your thoughts..."></textarea>
            <button class="submit-comment">Post Comment</button>
            <div class="comments-list"></div>
          </div>
      </div>
    <?php endforeach; ?>
 
    <script src="../scripts/newsfeed.js"></script>
    <script src="../scripts/post.js"></script> 
 

  </body>
</html>

<?php 
    if ($crud->checkMethod()) {
      
      // go to login if not logged

      if (!$is_valid_session) {
        header("Location: ./log-in.php");
        exit;   
      }

      // manage post
      $post_imgName = $_FILES["image-input"]["name"];
      $post_temp = $_FILES["image-input"]["tmp_name"];
      $folder = "../assets/server/" . $post_imgName;

      $post_content = $crud->sanitize("post-content");
      $getuser = $crud->getRowByValue($user_C->getTableName(), $user_C->getSessionToken(), $_SESSION[$user_C->getSessionToken()]);
      
      if (count($getuser) > 0) {

        $insert_data = [
          $post_C->getUserId() => $getuser[0][$user_C->getUserId()],
          $post_C->getImage() => $post_imgName,
          $post_C->getDescription() => $post_content
        ];
        
        if ($crud->insertRecord($post_C->getTableName(), $insert_data)) {

          if (move_uploaded_file($post_temp, $folder)) {
            echo "<h3>&nbsp; Image uploaded successfully!</h3>";
          } else {
            echo "<h3>&nbsp; Failed to upload image!</h3>";
          }

          header("Refresh: 0");
          exit();
        };
      }
    }

    ob_end_flush();
?>