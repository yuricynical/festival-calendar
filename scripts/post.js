// para modal elements
const modal = document.getElementById("postModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");
const submitPostBtn = document.getElementById("submitPost");
const postsContainer = document.getElementById("postsContainer");

// Input elements
const postText = document.getElementById("postText");
const imageInput = document.getElementById("imageInput");
const imagePreview = document.getElementById("imagePreview");

// if click ma open yung post
openModalBtn.addEventListener("click", () => {
  modal.style.display = "flex";
});

// pag pinondot x maalis yung modal
closeModalBtn.addEventListener("click", () => {
  modal.style.display = "none";
  resetModal();
});

// image preview functionality
imageInput.addEventListener("change", (e) => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (event) => {
      imagePreview.src = event.target.result;
      imagePreview.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});

// submit post 
submitPostBtn.addEventListener("click", () => {
  const text = postText.value.trim();
  const imageSrc = imagePreview.src;

  // check if may laman yun post
  if (text || imageSrc) {
    const postDiv = document.createElement("div");
    postDiv.classList.add("post");

    // add text 
    if (text) {
      const textP = document.createElement("p");
      textP.textContent = text;
      postDiv.appendChild(textP);
    }

    // add image
    if (imageSrc) {
      const img = document.createElement("img");
      img.src = imageSrc;
      postDiv.appendChild(img);
    }

    // pang append post to container
    postsContainer.prepend(postDiv);
  }

  // close modal at pang reset
  modal.style.display = "none";
  resetModal();
});

// function to reset modal inputs
function resetModal() {
  postText.value = "";
  imageInput.value = "";
  imagePreview.style.display = "none";
  imagePreview.src = "";
}

// close modal when click outsi
window.addEventListener("click", (e) => {
  if (e.target === modal) {
    modal.style.display = "none";
    resetModal();
  }
});


