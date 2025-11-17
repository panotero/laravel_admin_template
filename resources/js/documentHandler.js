// ----------------------------
// Global function to populate Document Modal
// ----------------------------
async function populateDocumentModal(documentId) {
  try {
    const res = await fetch(`/api/documents/${documentId}`);
    const data = await res.json();
    console.log(data);

    // Check if document exists
    if (!data || Object.keys(data).length === 0) {
      // Close modal if open
      const modal = document.getElementById("DocumentModal");
      if (modal) modal.classList.add("hidden");

      // Show error message
      showMessage({
        status: "error",
        message: "Document not found or does not exist.",
      });
      return; // stop execution
    }

    // ------------------------
    // Header
    // ------------------------
    document.getElementById("docControlNumber").textContent =
      data.document_control_number;
    document.getElementById("docStatus").textContent = data.status;

    // ------------------------
    // Metadata
    // ------------------------
    document.getElementById("docTitle").textContent = data.particular;
    document.getElementById("docDept").textContent = data.office_origin;
    document.getElementById("docAuthor").textContent = data.signatory;
    document.getElementById("docDate").textContent = data.date_of_document;

    // ------------------------
    // Files / Versions
    // ------------------------
    const fileList = document.getElementById("fileVersionsList");
    fileList.innerHTML = "";

    if (data.files && data.files.length) {
      data.files.forEach((file, index) => {
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
                <p class="text-gray-900 dark:text-gray-100 font-medium">
                    ${file.file_name}.0
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Uploaded: ${file.uploaded_at.split(" ")[0]} by ${
          file.uploading_office
        }
                </p>
            </div>

            <a href="${file.file_path}"
               download
               class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
               onclick="event.stopPropagation();">
               Download
            </a>
        `;

        // Make the whole LI open modal
        li.addEventListener("click", () => {
          //   file.file_path;
          // Example usage
          const mySlides = [
            "Slide 1",
            "Slide 2",
            "Slide 3",
            "Slide 4",
            "Slide 5",
          ];
          loadSlidesFromArray(mySlides);
          initModal({ modalId: "pdfPreviewModal" });
        });

        fileList.appendChild(li);
      });
    } else {
      fileList.innerHTML = `
        <li class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
            No files available
        </li>`;
    }

    // ------------------------
    // Activity Log
    // ------------------------
    const activityLog = document.getElementById("activityLog");
    activityLog.innerHTML = "";
    if (data.activities && data.activities.length) {
      data.activities.forEach((act) => {
        const div = document.createElement("div");
        div.classList.add("text-sm", "text-gray-700", "dark:text-gray-300");

        const userName = act.user_id ? `User ${act.user_id}` : "Unknown";
        const timeAgo = new Date(act.created_at).toLocaleString();

        div.innerHTML = `
                    <p><span class="font-semibold">${userName}</span> ${act.action}ed the document <span class="text-gray-500 text-xs">${timeAgo}</span></p>
                `;
        activityLog.appendChild(div);
      });
    } else {
      activityLog.innerHTML = `<div class="text-sm text-gray-500 dark:text-gray-400">No activity yet.</div>`;
    }
  } catch (error) {
    console.error("Failed to populate document modal:", error);
  }
}

window.populateDocumentModal = populateDocumentModal;
