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
  

  <div class="newsfeed-container">
    <!-- button para  maopen modal -->
  <button id="openModalBtn">Create Post</button>

<!-- modal -->
<div id="postModal" class="modal">
  <div class="modal-content">
    <!-- close button -->
    <span class="close-btn" id="closeModalBtn">&times;</span>
    <h2>Create a Post</h2>
    
    <!-- post -->
    <textarea id="postText" placeholder="What's on your mind?"></textarea>
    <input type="file" id="imageInput" accept="image/*">
    <img id="imagePreview" src="" alt="Image Preview" style="display: none;">
    
    <!-- submit -->
    <button id="submitPost">Post</button>
  </div>
</div>

<!-- try posted content pabago o paalis if di need -->
<div id="postsContainer"></div>
    <!-- Post 1 -->
    <div class="post">
      <div class="post-header">
        <div class="post-info">
          <p class="profile-name">Camarines Norte Tourism</p>
          <p class="post-time">2 hours ago</p>
        </div>
      </div>
      <p class="post-content">
        Experience the beauty of the Pinyasan Festival! Celebrate the sweetness of Daet's famous pineapples with vibrant parades, street dances, and delicious food. 🥳🍍
      </p>
      <div class="post-gallery">
        <img src="../assets/images/pinyasan1.jpg" alt="Pinyasan 1">
        <img src="../assets/images/pinyasan2.jpg" alt="Pinyasan 2">
      </div>
      <div class="post-footer">
        <button class="comment-btn">Comment</button>
      </div>
      <div class="comment-section">
        <textarea placeholder="Write your thoughts..."></textarea>
        <button class="submit-comment">Post Comment</button>
        <div class="comments-list"></div>
      </div>
    </div>

    <!-- Post 2 -->
    <div class="post">
      <div class="post-header">
        <div class="post-info">
          <p class="profile-name">Paracale Events</p>
          <p class="post-time">5 hours ago Public</p>
        </div>
      </div>
      <p class="post-content">
        Join us for the Paracale's Pabirik Festival! Celebrate our rich mining heritage with cultural performances, gold exhibits, and local delicacies. ✨⛏️
      </p>
      <div class="post-gallery">
        <img src="../assets/images/pabirik1.jpg" alt="Gold Festival 1">
        <img src="../assets/images/pabirik2.jpg" alt="Gold Festival 2">
      </div>
      <div class="post-footer">
        <button class="comment-btn">Comment</button>
      </div>
      <div class="comment-section">
        <textarea placeholder="Write your thoughts..."></textarea>
        <button class="submit-comment">Post Comment</button>
        <div class="comments-list"></div>
      </div>
    </div>

    <!-- Post 3 -->
    <div class="post">
      <div class="post-header">
        <div class="post-info">
          <p class="profile-name">Talisay Tourist Committee</p>
          <p class="post-time">8 hours ago</p>
        </div>
      </div>
      <p class="post-content">
        Experience the Magic of Paruyan! 💫 Talisay, Camarines Norte is ready to dazzle you with its annual Paru-yan Festival!
      </p>
      <div class="post-gallery">
        <img src="../assets/images/paruyan1.jpeg" alt="Paruyan Festival 1">
        <img src="../assets/images/paruyan2.jpeg" alt="Paruyan Festival 2">
      </div>
      <div class="post-footer">
        <button class="comment-btn">Comment</button>
      </div>
      <div class="comment-section">
        <textarea placeholder="Write your thoughts..."></textarea>
        <button class="submit-comment">Post Comment</button>
        <div class="comments-list"></div>
      </div>
    </div>
  </div>

  <script src="../scripts/newsfeed.js"></script>
  <script src="../scripts/post.js"></script>
</body>
</html>
