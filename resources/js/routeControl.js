function initroute() {
  document
    .getElementById("routeSubmitBtn")
    .addEventListener("click", async () => {
      console.log("routebutton clicked");
      const documentId = document.getElementById("docId").value; // hidden input
      const destinationOffice =
        document.getElementById("routeOfficeSelect").value;
      const recipientUserId =
        document.getElementById("userSelect").value || null;
      const approvalType =
        document.getElementById("approvalSelect").value || null;
      const remarks = document.getElementById("remarks").value;

      try {
        const res = await fetch("/api/documents/route", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
              .content,
          },
          body: JSON.stringify({
            document_id: documentId,
            destination_office: destinationOffice,
            recipient_user_id: recipientUserId,
            approval_type: approvalType,
            remarks: remarks,
          }),
        });

        const data = await res.json();
        console.log(data);

        // optionally refresh activity log or close modal
      } catch (err) {
        console.error(err);
        alert("Failed to route document.");
      }
    });
}
window.initroute = initroute;
