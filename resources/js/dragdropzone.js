// dropzone-handler.js
function initPDFDropzone({ dropzoneId, fileInputId, fileInfoId, clearBtnId }) {
  const dropzone = document.getElementById(dropzoneId);
  const fileInput = document.getElementById(fileInputId);
  const fileInfo = document.getElementById(fileInfoId);
  const clearBtn = document.getElementById(clearBtnId);

  if (!dropzone || !fileInput || !fileInfo || !clearBtn) {
    console.warn("❗ Missing dropzone elements. Check your IDs.");
    return;
  }

  // Highlight dropzone on drag
  dropzone.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropzone.classList.add("border-blue-400", "bg-blue-50");
  });

  // Remove highlight when leaving dropzone
  dropzone.addEventListener("dragleave", () => {
    dropzone.classList.remove("border-blue-400", "bg-blue-50");
  });

  // Handle dropped file
  dropzone.addEventListener("drop", (e) => {
    e.preventDefault();
    dropzone.classList.remove("border-blue-400", "bg-blue-50");

    const files = e.dataTransfer.files;
    if (files.length > 1) {
      alert("Please upload only one PDF file.");
      return;
    }

    const file = files[0];
    if (file && file.type === "application/pdf") {
      showFile(file);
    } else {
      alert("Only PDF files are allowed.");
    }
  });

  // Open file picker when clicked
  dropzone.addEventListener("click", () => {
    fileInput.click();
  });

  // Handle selected file
  fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (!file) return;

    if (file.type !== "application/pdf") {
      alert("Only PDF files are allowed.");
      fileInput.value = "";
      return;
    }

    showFile(file);
  });

  // Clear selected file
  clearBtn.addEventListener("click", () => {
    fileInput.value = "";
    fileInfo.textContent = "";
    clearBtn.classList.add("hidden");
  });

  // Display file info
  function showFile(file) {
    fileInfo.textContent = `📄 ${file.name} (${(file.size / 1024).toFixed(
      1
    )} KB)`;
    clearBtn.classList.remove("hidden");
  }
}

//function for modal operations
function initModal({ modalId }) {
  const modal = document.getElementById(modalId);
  const openBtn = document.querySelector(".modal-open");
  const closeBtn = document.querySelector(".modal-close");
  //   console.log(closeBtn);

  if (!modal || !openBtn || !closeBtn) {
    console.warn("❗ Missing modal elements. Check your IDs.");
    return;
  }

  // Open modal
  openBtn.addEventListener("click", () => {
    modal.classList.remove("hidden");
    document.body.classList.add("overflow-hidden"); // prevent background scroll
  });

  // Close modal (button)
  closeBtn.addEventListener("click", () => {
    modal.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
  });

  // Close modal by clicking outside
  window.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.classList.add("hidden");
      document.body.classList.remove("overflow-hidden");
    }
  });
}
//this section initializes function globally
window.initModal = initModal;
window.initPDFDropzone = initPDFDropzone;
