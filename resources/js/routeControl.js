function initroute() {
  document
    .getElementById("routeSubmitBtn")
    .addEventListener("click", async () => {
      console.log("routebutton clicked");
      const documentId = document.getElementById("docId").value; // hidden input
      const destinationOffice =
        document.getElementById("routeOfficeSelect").value;
      const recipientUserId = document.getElementById("routeUserSelect").value;
      //   console.log(recipientUserId);
      const approvalType = document.getElementById("routeApprovalSelect").value;
      const routeStatusSelect =
        document.getElementById("routeStatusSelect").value;
      const remarks = document.getElementById("routeRemarks").value;
      const routedPdfFile = document.getElementById("routefileInput");
      if (routedPdfFile.files && routedPdfFile.files.length > 0) {
        console.log("File is selected");
      } else {
        console.log("No file selected");
      }

      try {
        // Use FormData for text + file upload
        const formData = new FormData();
        formData.append("document_id", documentId);
        formData.append("destination_office", destinationOffice);
        formData.append("recipient_user_id", recipientUserId);
        formData.append("approval_type", approvalType);
        formData.append("status", routeStatusSelect);
        formData.append("remarks", remarks);

        if (routedPdfFile.files.length > 0) {
          formData.append("pdf_file", routedPdfFile.files[0]);
        }

        const res = await fetch("/api/documents/route", {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
              .content,
          },
          body: formData, // DO NOT USE JSON HERE
        });

        const data = await res.json();
        console.log(data);
        window.getDocs();

        const routingmodal = document.getElementById("routingModal");
        routingmodal.classList.add("hidden");
        const documentmodal = document.getElementById("DocumentModal");
        documentmodal.classList.add("hidden");

        // optionally refresh activity log or close modal
      } catch (err) {
        console.error(err);
        alert("Failed to route document.");
      }
    });
}
window.initroute = initroute;
