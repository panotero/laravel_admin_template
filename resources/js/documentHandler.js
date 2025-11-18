// ----------------------------
// Global function to populate Document Modal
// ----------------------------
async function populateDocumentModal(documentId) {
  try {
    const res = await fetch(`/api/documents/${documentId}`);
    const data = await res.json();

    // ------------------------
    // Check if document exists
    // ------------------------
    if (!data || Object.keys(data).length === 0) {
      hideModal("DocumentModal");
      showMessage({
        status: "error",
        message: "Document not found or does not exist.",
      });
      return;
    }

    // ------------------------
    // Populate Header
    // ------------------------
    setText("docControlNumber", data.document_control_number);
    setText("docStatus", data.status);

    // ------------------------
    // Populate Metadata
    // ------------------------
    setText("docTitle", data.particular);
    setText("docDept", data.office_origin);
    setText("docAuthor", data.signatory);
    setText("docDate", data.date_of_document);

    // ------------------------
    // Populate Files / Versions
    // ------------------------
    populateFileList(data.files || []);

    // ------------------------
    // Populate Activity Log
    // ------------------------
    populateActivityLog(data.activities || []);
  } catch (error) {
    console.error("Failed to populate document modal:", error);
  }
}

// ------------------------
// Helper: set textContent safely
// ------------------------
function setText(id, text) {
  const el = document.getElementById(id);
  if (el) el.textContent = text || "";
}

// ------------------------
// Helper: hide modal
// ------------------------
function hideModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) modal.classList.add("hidden");
}

// ------------------------
// Populate file list
// ------------------------
function populateFileList(files) {
  const fileList = document.getElementById("fileVersionsList");
  fileList.innerHTML = "";

  if (!files.length) {
    fileList.innerHTML = `
      <li class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
        No files available
      </li>`;
    return;
  }

  files.forEach((file, index) => {
    const li = document.createElement("li");
    li.classList.add(
      "flex",
      "items-center",
      "justify-between",
      "px-4",
      "py-3",
      "hover:bg-gray-50",
      "dark:hover:bg-gray-800",
      "cursor-pointer",
      "fileInfoButton",
      "modal-open"
    );

    li.dataset.version = `v${index + 1}.0`;
    li.dataset.fileId = file.file_id;

    li.innerHTML = `
      <div>
        <p class="text-gray-900 dark:text-gray-100 font-medium">${
          file.file_name
        }.0</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">
          Uploaded: ${file.uploaded_at.split(" ")[0]} by ${
      file.uploading_office
    }
        </p>
      </div>
      <a href="${file.file_path}"
         download
         class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition-colors duration-200"
         onclick="event.stopPropagation();">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v8m0-8l-4 4m4-4l4 4"/>
        </svg>
        Download
      </a>
    `;

    // Open PDF modal on LI click
    li.addEventListener("click", () => openPdfModal(file.file_path));

    fileList.appendChild(li);
  });
}

// ------------------------
// Open PDF modal and populate slides
// ------------------------
async function openPdfModal(filePath) {
  initModal({ modalId: "pdfPreviewModal" });

  const baseUrl = window.location.origin;
  const pdfUrl = `${baseUrl}/${filePath}`;

  const slides = await extractPdfImages(pdfUrl);
  loadSlidesFromArray(slides);
  initZoomFunction();
}

// ------------------------
// Populate Activity Log
// ------------------------
function populateActivityLog(activities) {
  const activityLog = document.getElementById("activityLog");
  activityLog.innerHTML = "";

  if (!activities.length) {
    activityLog.innerHTML = `<div class="text-sm text-gray-500 dark:text-gray-400">No activity yet.</div>`;
    return;
  }

  activities.forEach((act) => {
    const div = document.createElement("div");
    div.classList.add("text-sm", "text-gray-700", "dark:text-gray-300");

    const userName = act.user_id ? `User ${act.user_id}` : "Unknown";
    const timeAgo = new Date(act.created_at).toLocaleString();

    div.innerHTML = `<p><span class="font-semibold">${userName}</span> ${act.action}ed the document <span class="text-gray-500 text-xs">${timeAgo}</span></p>`;
    activityLog.appendChild(div);
  });
}

// ------------------------
// Zoom functionality
// ------------------------
function initZoomFunction() {
  let currentZoom = 1;
  const zoomStep = 0.2;
  const glideSlides = document.getElementById("glideSlides");

  const applyZoom = () => {
    glideSlides.querySelectorAll("img").forEach((img) => {
      img.style.transform = `scale(${currentZoom})`;
      img.style.transition = "transform 0.2s";
      img.style.transformOrigin = "center center";
    });
  };

  document.getElementById("zoomIn").addEventListener("click", () => {
    currentZoom += zoomStep;
    applyZoom();
  });
  document.getElementById("zoomOut").addEventListener("click", () => {
    currentZoom = Math.max(1, currentZoom - zoomStep);
    applyZoom();
  });

  const hammer = new Hammer(glideSlides);
  hammer.get("pinch").set({ enable: true });

  hammer.on("pinch", (ev) => {
    currentZoom = Math.max(1, ev.scale);
    applyZoom();
  });
  hammer.on("pinchend", (ev) => {
    currentZoom = Math.max(1, ev.scale);
  });
}

// Expose to global
window.populateDocumentModal = populateDocumentModal;
window.initZoomFunction = initZoomFunction;
