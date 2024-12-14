// comment paayos nlng nag try lng ako 
document.addEventListener('DOMContentLoaded', () => {
  const submitButtons = document.querySelectorAll('.submit-comment');

  submitButtons.forEach((button) => {
    button.addEventListener('click', (e) => {
      const commentSection = e.target.parentElement;
      const textarea = commentSection.querySelector('textarea');
      const commentText = textarea.value.trim();

      if (commentText) {
        const commentsList = commentSection.querySelector('.comments-list');

        // Add new comment
        const newComment = document.createElement('div');
        newComment.classList.add('comment');
        newComment.textContent = commentText;

        commentsList.appendChild(newComment);
        textarea.value = ''; // Clear the input
      } else {
        alert('Please write something before posting!');
      }
    });
  });
});
