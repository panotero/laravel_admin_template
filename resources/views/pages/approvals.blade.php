<div class="w-full h-screen bg-white">
    <div class=" container mx-auto py-5 rounded-lg">
        <div>

            <!-- Filters -->
            <div class="flex flex-wrap gap-3 mb-4">
                <select class="rounded-full border-gray-300 text-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>Filter by Office</option>
                </select>
                <select class="rounded-full border-gray-300 text-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>Filter by Status</option>
                </select>
                <select class="rounded-full border-gray-300 text-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>Filter by File Type</option>
                </select>
                <input type="text" placeholder="Search..."
                    class="rounded-full border-gray-300 px-4 py-2 text-sm w-64 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <!-- Table -->
            <div class="overflow-x-auto bg-white rounded-xl shadow">
                <table id="approvaltable" class="w-full text-sm text-left border-collapse responsive-table">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Control #</th>
                            <th class="px-4 py-3">Label</th>
                            <th class="px-4 py-3">Subject</th>
                            <th class="px-4 py-3">Origin Office</th>
                            <th class="px-4 py-3">Destination Office</th>
                            <th class="px-4 py-3">Due Date</th>
                            <th class="px-4 py-3">Duration</th>
                            <th class="px-4 py-3">Date Uploaded</th>
                            <th class="px-4 py-3">Confidentiality</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Document Details Modal -->
        <div id="approvalDocumentModal"
            class="fixed inset-0 hidden z-40 flex items-center justify-center bg-black/50 px-2 sm:px-4 modal modal-open">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-6xl max-h-[95vh] overflow-y-auto">

                <!-- Header -->
                <div class="border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-gray-100 break-all">
                        Document Control Number: <span id="modalapprovalDocControlNumber">DCN-0001</span>
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Status:
                        <span id="modalapproveDocStatus"
                            class="font-medium text-blue-600 dark:text-blue-400">Active</span>
                    </p>
                </div>

                <!-- Content -->
                <div
                    class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-200 dark:divide-gray-700">

                    <!-- LEFT SECTION: PDF PREVIEW CAROUSEL -->
                    <div class="w-full lg:w-1/2 p-4 sm:p-6">
                        <!-- Glide (inside Flowbite modal) -->
                        <div id="galleryGlide" class="glide w-full max-w-md mx-auto relative">

                            <!-- Loading Overlay -->
                            <div id="galleryLoading"
                                class="absolute inset-0 flex items-center justify-center bg-white/70 hidden z-50">
                                <div
                                    class="animate-spin text-black dark:text-gray-200 h-10 w-10 border-4 border-gray-400 border-t-transparent rounded-full">
                                </div>
                            </div>

                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides" id="approvalglideSlides">
                                    <!-- JS will populate slides here -->
                                </ul>
                            </div>

                            <!-- Controls -->
                            <div class="flex justify-between mt-4">
                                <button data-glide-dir="<"
                                    class="slide-previous px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">
                                    Prev
                                </button>

                                <button data-glide-dir=">"
                                    class="slide-next px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT SECTION: DOCUMENT INFORMATION -->
                    <div class="w-full lg:w-1/2 p-4 sm:p-6 space-y-6">

                        <!-- Title + Download -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Document Information</h3>

                            <button id="modalDownloadLatestBtn"
                                class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg w-full sm:w-auto">
                                Download Latest
                            </button>
                        </div>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Title:</span>
                                <span id="docTitle"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Document ID:</span>
                                <span id="document_id" class="text-gray-900 dark:text-gray-100"></span>
                            </div>
                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Document Code:</span>
                                <span id="docCode"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Form:</span>
                                <span id="docForm"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Type:</span>
                                <span id="docType"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Due Date:</span>
                                <span id="docDueDate"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Destination Office:</span>
                                <span id="docDestination"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Confidentiality:</span>
                                <span id="docConfidentiality"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Department:</span>
                                <span id="docDept"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Created By:</span>
                                <span id="docAuthor"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Created At:</span>
                                <span id="docDate"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>

                            <div class="flex justify-between gap-3">
                                <span class="text-gray-600 dark:text-gray-400">Remarks:</span>
                                <span id="docRemarks"
                                    class="text-gray-900 dark:text-gray-100 text-right break-all"></span>
                            </div>
                        </div>



                    </div>
                </div>

                <!-- FOOTER BUTTONS -->
                <div
                    class="border-t border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex flex-wrap justify-end gap-2 sm:gap-3">

                    <button id="modalApproveBtn"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium w-full sm:w-auto modal-open">
                        Approve
                    </button>

                    <button id="modalDisapproveBtn"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium w-full sm:w-auto modal-open">
                        Disapprove
                    </button>

                    <button id="modalRequestDiscussionBtn"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium w-full sm:w-auto">
                        Request for Discussion
                    </button>

                    <button
                        class="modal-close border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-200
                hover:bg-gray-100 dark:hover:bg-gray-800 px-4 py-2 rounded-lg text-sm font-medium w-full sm:w-auto">
                        Cancel
                    </button>
                </div>

            </div>
        </div>

        <!-- Approval Modal -->
        <div id="approvalModal"
            class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/30 px-4 sm:px-6">

            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto p-6 relative">


                <!-- Modal Header -->
                <h2 class="text-xl font-semibold text-gray-900 mb-5">Approval Details</h2>

                <!-- Hidden Approval ID -->
                <input type="hidden" id="approval_id">

                <!-- Next Approver -->
                <div class="mb-5">
                    <label for="nextApproverSelect" class="block text-gray-700 font-medium mb-2">Next Approver</label>
                    <select id="nextApproverSelect"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        <option value="">-- Select Approver --</option>
                        <option value="23" data-approval-type="pre-approval">Manager (Pre-Approval)</option>
                        <option value="45" data-approval-type="final-approval">Director (Final Approval)</option>
                    </select>
                </div>

                <!-- User Select (Hidden Initially, shown for pre-approval) -->
                <div id="userSelectWrapper" class="mb-5 hidden">
                    <label for="userSelect" class="block text-gray-700 font-medium mb-2">Select User</label>
                    <select id="userSelect"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        <!-- Options populated dynamically via JS -->
                    </select>
                </div>

                <!-- Remarks (Hidden Initially) -->
                <div id="remarksWrapper" class="mb-5 hidden">
                    <label for="remarksTextarea" class="block text-gray-700 font-medium mb-2">Remarks</label>
                    <textarea id="remarksTextarea"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-gray-300"
                        rows="4" placeholder="Enter remarks..."></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3">
                    <button id="confirmApprovalBtn"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg w-full sm:w-auto">
                        Confirm
                    </button>
                    <button
                        class="modal-close w-full sm:w-auto border border-gray-200 text-gray-700 hover:bg-gray-50 px-6 py-3 rounded-xl transition">
                        Cancel
                    </button>
                </div>
            </div>
        </div>




    </div>
</div>


<script>
    (function() {
        const tableBody = document.querySelector("#approvaltable tbody");
        async function loadApprovals() {
            try {
                const res = await fetch("api/approvals");
                const data = await res.json();

                if (!data.approvals) return;

                renderTable(data.approvals);
            } catch (err) {
                console.error("Error loading approvals:", err);
            }
        }

        function renderTable(approvals) {
            tableBody.innerHTML = "";

            approvals.forEach(app => {
                const doc = app.document;


                const tr = document.createElement("tr");
                tr.classList.add("border-t", "hover:bg-gray-50", "cursor-pointer");

                tr.innerHTML = `
                <td class="px-4 py-2">${doc.document_control_number}</td>

                <td class="px-4 py-2">
                    <select class="border rounded px-2 py-1 text-xs labeldropdown">
                        <option ${doc.confidentiality === "General" ? "selected":""}>General</option>
                        <option ${doc.confidentiality === "Confidential" ? "selected":""}>Confidential</option>
                    </select>
                </td>

                <td class="px-4 py-2">${doc.particular}</td>
                <td class="px-4 py-2">${doc.office_origin}</td>
                <td class="px-4 py-2">${doc.destination_office}</td>
                <td class="px-4 py-2">${doc.due_date ?? "—"}</td>
                <td class="px-4 py-2">—</td>
                <td class="px-4 py-2">${doc.date_forwarded ?? "—"}</td>
                <td class="px-4 py-2">${doc.confidentiality}</td>
                <td class="px-4 py-2">${doc.status}</td>
            `;

                // Handle row click (open modal)
                tr.addEventListener("click", (e) => {
                    if (e.target.classList.contains("labeldropdown")) return;
                    loadModal(doc);
                    initModal({
                        modalId: "approvalDocumentModal"
                    });
                });

                tableBody.appendChild(tr);
            });
        }

        async function loadModal(doc) {
            // console.log(doc);

            // HEADER
            document.getElementById("modalapprovalDocControlNumber").innerText = doc.document_control_number;
            document.getElementById("modalapproveDocStatus").innerText = doc.status;

            // Document Modal Fields
            document.getElementById("docTitle").innerText = doc.particular ?? "";
            document.getElementById("document_id").innerText = doc.document_id ?? "";
            document.getElementById("docCode").innerText = doc.document_code ?? "";
            document.getElementById("docForm").innerText = doc.document_form ?? "";
            document.getElementById("docType").innerText = doc.document_type ?? "";
            document.getElementById("docDueDate").innerText = doc.due_date ?? "None";
            document.getElementById("docDestination").innerText = doc.destination_office ?? "";
            document.getElementById("docConfidentiality").innerText = doc.confidentiality ?? "";
            document.getElementById("docDept").innerText = doc.office_origin ?? "";
            document.getElementById("docAuthor").innerText = doc.user_id ??
                ""; // If you want actual username, return it from backend
            document.getElementById("docDate").innerText = doc.date_received ?? "";
            document.getElementById("docRemarks").innerText = doc.remarks ?? "";

            const baseUrl = window.location.origin;
            const pdfUrl = `${baseUrl}/${doc.files[0].file_path}`;

            const slides = await extractPdfImages(pdfUrl);

            const slideContainer = document.getElementById("approvalglideSlides");

            slideContainer.innerHTML = "";
            slides.forEach((slideHTML) => {
                slideContainer.insertAdjacentHTML("beforeend", slideHTML);
            });

            if (typeof window.initGlide === "function") {
                window.initGlide();
            } else {
                console.warn("initGlide() not available yet.");
            }

            // RIGHT DETAILS SECTION
            setText("modalDocCode", doc.document_code);
            setText("modalDocType", doc.document_type);
            setText("modalDocOrigin", doc.office_origin);
            setText("modalDocDestination", doc.destination_office);
            setText("modalDocRemarks", doc.remarks ?? "None");
            setText("modalDocSignatory", doc.signatory ?? "—");
            setText("modalDocConfidentiality", doc.confidentiality);
            setText("modalDocDateReceived", doc.date_received);
            setText("modalDocDueDate", doc.due_date ?? "—");
        }

        function setText(id, value) {
            const el = document.getElementById(id);
            if (el) el.innerText = value;
        }

        // Init loader
        loadApprovals();
        initApprovalHandler();

    })();
</script>
