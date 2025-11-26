// window.initApprovalHandler = function initApprovalHandler (currentOffice) {
//   const modalApproveBtn = document.getElementById("modalApproveBtn");
//   const modalDisapproveBtn = document.getElementById("modalDisapproveBtn");
//   const document_id = document.getElementById("document_id"); // hidden field

//   const approvalModal = document.getElementById("approvalModal");
//   const nextApproverSelect = document.getElementById("nextApproverSelect");
//   const remarksWrapper = document.getElementById("remarksWrapper");
//   const remarksTextarea = document.getElementById("remarksTextarea");
//   const confirmBtn = document.getElementById("confirmApprovalBtn");
//   const approvalIdInput = document.getElementById("approval_id");

//   // Create user select dynamically
//   let userSelectWrapper = document.getElementById("userSelectWrapper");
//   if (!userSelectWrapper) {
//     userSelectWrapper = document.createElement("div");
//     userSelectWrapper.id = "userSelectWrapper";
//     userSelectWrapper.className = "mb-5 hidden";
//     userSelectWrapper.innerHTML = `
//             <label for="userSelect" class="block text-gray-700 font-medium mb-2">Select User</label>
//             <select id="userSelect"
//                 class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
//             </select>
//         `;
//     nextApproverSelect.parentNode.insertBefore(
//       userSelectWrapper,
//       remarksWrapper
//     );
//   }
//   const userSelect = document.getElementById("userSelect");

//   // BASE URL FOR APPROVAL ACTIONS
//   const baseUrl = "/api/approvals";
//   async function sendApprovalAction(
//     approvalId,
//     action,
//     next_action,
//     remarks = "",
//     nextUserId = null
//   ) {
//     try {
//       const response = await fetch(`${baseUrl}/${approvalId}/action`, {
//         method: "POST",
//         headers: {
//           "Content-Type": "application/json",
//           "X-CSRF-TOKEN": document
//             .querySelector('meta[name="csrf-token"]')
//             .getAttribute("content"),
//         },
//         body: JSON.stringify({
//           action,
//           next_action,
//           remarks,
//           next_user_id: nextUserId,
//         }),
//       });
//       const result = await response.json();
//       console.log("Server Response:", result);
//     } catch (err) {
//       console.error("Approval action error:", err);
//     }
//   }

//   // Load users from API (filter by office & approval type)
//   function populateUsers(approvalType) {
//     fetch("/api/users")
//       .then((res) => res.json())
//       .then((users) => {
//         const filtered = users.filter(
//           (u) =>
//             u.office?.office_name === window.authUser.office.office_name &&
//             u.user_config?.approval_type === approvalType
//         );

//         userSelect.innerHTML =
//           `<option value="">Select User</option>` +
//           filtered
//             .map((u) => `<option value="${u.id}">${u.name}</option>`)
//             .join("");
//       });
//   }

//   // Handle approval type change
//   nextApproverSelect.addEventListener("change", function () {
//     const selected =
//       nextApproverSelect.options[nextApproverSelect.selectedIndex];
//     const approvalType = selected.dataset.approvalType;

//     // Reset UI
//     remarksWrapper.classList.add("hidden");
//     userSelectWrapper.classList.add("hidden");
//     confirmBtn.classList.add("hidden");
//     remarksTextarea.value = "";

//     if (!approvalType) return;

//     if (approvalType === "pre-approval") {
//       // Show user select dropdown
//       populateUsers("pre-approval");
//       userSelectWrapper.classList.remove("hidden");
//       remarksWrapper.classList.remove("hidden");
//       confirmBtn.classList.remove("hidden");
//     } else if (approvalType === "final-approval") {
//       // Show remarks textarea
//       remarksWrapper.classList.remove("hidden");
//       confirmBtn.classList.remove("hidden");
//     }
//   });

//   // Confirm button click
//   confirmBtn.addEventListener("click", function () {
//     const approvalId = document_id.textContent;
//     const selectedApprovalType =
//       nextApproverSelect.options[nextApproverSelect.selectedIndex].dataset
//         .approvalType;

//     const nextUserId =
//       selectedApprovalType === "pre-approval" ? userSelect.value : null;
//     const remarks = remarksTextarea.value;

//     sendApprovalAction(
//       approvalId,
//       "approved",
//       selectedApprovalType,
//       remarks,
//       nextUserId
//     );
//   });

//   // APPROVE BUTTON
//   modalApproveBtn.addEventListener("click", () => {
//     initModal({ modalId: "approvalModal" });
//   });

//   // DISAPPROVE BUTTON
//   modalDisapproveBtn.addEventListener("click", () => {
//     initModal({ modalId: "approvalModal" });
//   });
// };
