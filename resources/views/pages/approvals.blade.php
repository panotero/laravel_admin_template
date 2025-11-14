<div class="h-screen bg-white rounded-lg">


    <div class="p-5">

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
                    <tr class="border-t hover:bg-gray-50 cursor-pointer modal-open">
                        <td class="px-4 py-2">DOC-00123</td>
                        <td class="px-4 py-2">
                            <select class="border rounded px-2 py-1 text-xs">
                                <option>General</option>
                                <option>Confidential</option>
                            </select>
                        </td>
                        <td class="px-4 py-2">Quarterly Report</td>
                        <td class="px-4 py-2">HR Office</td>
                        <td class="px-4 py-2">Admin Office</td>
                        <td class="px-4 py-2">2025-11-15</td>
                        <td class="px-4 py-2">8 days</td>
                        <td class="px-4 py-2">2025-11-07</td>
                        <td class="px-4 py-2">Normal</td>
                        <td class="px-4 py-2">Pending</td>
                    </tr>
                    <tr class="border-t hover:bg-gray-50 cursor-pointer  modal-open">
                        <td class="px-4 py-2">DOC-00123</td>
                        <td class="px-4 py-2">
                            <select class="border rounded px-2 py-1 text-xs">
                                <option>General</option>
                                <option>Confidential</option>
                            </select>
                        </td>
                        <td class="px-4 py-2">Quarterly Report</td>
                        <td class="px-4 py-2">HR Office</td>
                        <td class="px-4 py-2">Admin Office</td>
                        <td class="px-4 py-2">2025-11-15</td>
                        <td class="px-4 py-2">8 days</td>
                        <td class="px-4 py-2">2025-11-07</td>
                        <td class="px-4 py-2">Normal</td>
                        <td class="px-4 py-2">Pending</td>
                    </tr>
                    <tr class="border-t hover:bg-gray-50 cursor-pointer modal-open">
                        <td class="px-4 py-2">DOC-00123</td>
                        <td class="px-4 py-2">
                            <select class="border rounded px-2 py-1 text-xs">
                                <option>General</option>
                                <option>Confidential</option>
                            </select>
                        </td>
                        <td class="px-4 py-2">Quarterly Report</td>
                        <td class="px-4 py-2">HR Office</td>
                        <td class="px-4 py-2">Admin Office</td>
                        <td class="px-4 py-2">2025-11-15</td>
                        <td class="px-4 py-2">8 days</td>
                        <td class="px-4 py-2">2025-11-07</td>
                        <td class="px-4 py-2">Normal</td>
                        <td class="px-4 py-2">Pending</td>
                    </tr>
                    <tr class="border-t hover:bg-gray-50 cursor-pointer modal-open">
                        <td class="px-4 py-2">DOC-00123</td>
                        <td class="px-4 py-2">
                            <select class="border rounded px-2 py-1 text-xs">
                                <option>General</option>
                                <option>Confidential</option>
                            </select>
                        </td>
                        <td class="px-4 py-2">Quarterly Report</td>
                        <td class="px-4 py-2">HR Office</td>
                        <td class="px-4 py-2">Admin Office</td>
                        <td class="px-4 py-2">2025-11-15</td>
                        <td class="px-4 py-2">8 days</td>
                        <td class="px-4 py-2">2025-11-07</td>
                        <td class="px-4 py-2">Normal</td>
                        <td class="px-4 py-2">Pending</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Document Details Modal -->
    <div id="approvalDocumentModal"
        class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 px-2 sm:px-4 modal">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-6xl max-h-[95vh] overflow-y-auto">

            <!-- Header -->
            <div class="border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4">
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-gray-100 break-all">
                    Document Control Number: <span id="docControlNumber">DCN-0001</span>
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Status:
                    <span id="docStatus" class="font-medium text-blue-600 dark:text-blue-400">Active</span>
                </p>
            </div>

            <!-- Content -->
            <div
                class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-200 dark:divide-gray-700">

                <!-- LEFT SECTION: PDF PREVIEW CAROUSEL -->
                <div class="w-full lg:w-1/2 p-4 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100 mb-3 sm:mb-4">
                        Document Preview
                    </h3>

                    <!-- Carousel Container -->
                    <div
                        class="relative w-full h-[350px] sm:h-[450px] lg:h-[500px]
                    bg-gray-100 dark:bg-gray-800 rounded-xl overflow-hidden">

                        <div id="pdfCarouselSlides" class="w-full h-full">
                            <iframe src="/sample.pdf" class="w-full h-full" id="pdfPreviewFrame"></iframe>
                        </div>

                        <!-- Carousel Controls -->
                        <button id="prevPdf"
                            class="absolute left-2 top-1/2 -translate-y-1/2
                        bg-gray-700/60 hover:bg-gray-800 text-white
                        px-3 py-2 sm:px-4 sm:py-3 rounded-full text-lg sm:text-xl">
                            ‹
                        </button>

                        <button id="nextPdf"
                            class="absolute right-2 top-1/2 -translate-y-1/2
                        bg-gray-700/60 hover:bg-gray-800 text-white
                        px-3 py-2 sm:px-4 sm:py-3 rounded-full text-lg sm:text-xl">
                            ›
                        </button>
                    </div>
                </div>

                <!-- RIGHT SECTION: DOCUMENT INFORMATION -->
                <div class="w-full lg:w-1/2 p-4 sm:p-6 space-y-6">

                    <!-- Title + Download -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Document Information</h3>

                        <button id="downloadLatestBtn"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg w-full sm:w-auto">
                            Download Latest
                        </button>
                    </div>

                    <!-- Metadata -->
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between gap-3">
                            <span class="text-gray-600 dark:text-gray-400">Title:</span>
                            <span id="docTitle" class="text-gray-900 dark:text-gray-100 text-right break-all">
                                Project Proposal
                            </span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="text-gray-600 dark:text-gray-400">Department:</span>
                            <span id="docDept" class="text-gray-900 dark:text-gray-100 text-right">
                                Engineering
                            </span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="text-gray-600 dark:text-gray-400">Created By:</span>
                            <span id="docAuthor" class="text-gray-900 dark:text-gray-100 text-right">
                                Minton Diaz
                            </span>
                        </div>

                        <div class="flex justify-between gap-3">
                            <span class="text-gray-600 dark:text-gray-400">Created At:</span>
                            <span id="docDate" class="text-gray-900 dark:text-gray-100 text-right">
                                2025-11-13
                            </span>
                        </div>
                    </div>

                    <!-- Versions List -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100 mb-3">File Versions</h3>
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg max-h-64 overflow-y-auto">
                            <ul id="fileVersionsList" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <!-- version items remain unchanged -->
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <!-- FOOTER BUTTONS -->
            <div
                class="border-t border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4
            flex flex-wrap justify-end gap-2 sm:gap-3">

                <button id="approveBtn"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium w-full sm:w-auto">
                    Approve
                </button>

                <button id="disapproveBtn"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium w-full sm:w-auto">
                    Disapprove
                </button>

                <button id="requestDiscussionBtn"
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


    <!-- PDF Preview Modal -->
    <div id="pdfPreviewModal"
        class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 px-4 modal">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-5xl h-[90vh] flex flex-col">
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 px-6 py-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">PDF Preview</h3>

                <button
                    class="modal-close border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 px-5 py-2 rounded-lg text-sm font-medium">
                    Cancel
                </button>
            </div>
            <div class="flex-1 overflow-hidden">
                <iframe id="pdfViewer" src="" class="w-full h-full rounded-b-2xl "></iframe>
            </div>
        </div>
    </div>

</div>

<script>
    (function() {


        // Reference to table body
        const tableBody = document.querySelector("#approvaltable tbody"); // Sample data array
        const approvalData = [{
                controlNumber: "DOC-00123",
                label: "General",
                subject: "Quarterly Report",
                originOffice: "HR Office",
                destinationOffice: "Admin Office",
                dueDate: "2025-11-15",
                duration: "8 days",
                dateUploaded: "2025-11-07",
                confidentiality: "Normal",
                status: "Pending"
            },
            {
                controlNumber: "DOC-00124",
                label: "Confidential",
                subject: "Monthly Report",
                originOffice: "Finance Office",
                destinationOffice: "Admin Office",
                dueDate: "2025-11-20",
                duration: "5 days",
                dateUploaded: "2025-11-07",
                confidentiality: "High",
                status: "Pending"
            }
            // Add more objects as needed
        ];

        // Populate table
        tableBody.innerHTML = ""; // clear existing rows
        approvalData.forEach(item => {
            const tr = document.createElement("tr");
            tr.classList.add("border-t", "hover:bg-gray-50", "cursor-pointer");

            tr.innerHTML = `
        <td class="px-4 py-2">${item.controlNumber}</td>
        <td class="px-4 py-2 ">
            <select class="border rounded px-2 py-1 text-xs labeldropdown">
                <option ${item.label === "General" ? "selected" : ""}>General</option>
                <option ${item.label === "Confidential" ? "selected" : ""}>Confidential</option>
            </select>
        </td>
        <td class="px-4 py-2">${item.subject}</td>
        <td class="px-4 py-2">${item.originOffice}</td>
        <td class="px-4 py-2">${item.destinationOffice}</td>
        <td class="px-4 py-2">${item.dueDate}</td>
        <td class="px-4 py-2">${item.duration}</td>
        <td class="px-4 py-2">${item.dateUploaded}</td>
        <td class="px-4 py-2">${item.confidentiality}</td>
        <td class="px-4 py-2">${item.status}</td>
    `;
            tr.classList.add("modal-open");
            // Optional: attach row click to open modal
            tr.addEventListener("click", (e) => {
                console.log(e.target.classList);

                if (e.target.classList.contains("labeldropdown")) return;
                initModal({
                    modalId: "approvalDocumentModal"
                });
            });

            tableBody.appendChild(tr);
        });




    })();
</script>
