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
                    <tr class="border-t hover:bg-gray-50 cursor-pointer">
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
    <div id="documentModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 px-4">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-y-auto">

            <!-- Header -->
            <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                    Document Control Number: <span id="docControlNumber">DCN-0001</span>
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Status: <span id="docStatus" class="font-medium text-blue-600 dark:text-blue-400">Active</span>
                </p>
            </div>

            <!-- Content -->
            <div
                class="flex flex-col lg:flex-row divide-y lg:divide-y-0 lg:divide-x divide-gray-200 dark:divide-gray-700">

                <!-- Left Section: Metadata -->
                <div class="w-full lg:w-1/2 p-6 space-y-4">
                    <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">Document Metadata</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Title:</span>
                            <span id="docTitle" class="text-gray-900 dark:text-gray-100">Project Proposal</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Department:</span>
                            <span id="docDept" class="text-gray-900 dark:text-gray-100">Engineering</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Created By:</span>
                            <span id="docAuthor" class="text-gray-900 dark:text-gray-100">Minton Diaz</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Created At:</span>
                            <span id="docDate" class="text-gray-900 dark:text-gray-100">2025-11-13</span>
                        </div>
                    </div>
                </div>

                <!-- Right Section: File Versions -->
                <div class="w-full lg:w-1/2 p-6 space-y-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100">File Versions</h3>
                        <button id="downloadLatestBtn"
                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-lg transition">
                            Download Latest
                        </button>
                    </div>

                    <!-- Versions List -->
                    <div class="space-y-2">
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                            <ul id="fileVersionsList" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <!-- Example version item -->
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer"
                                    data-version="v1.0">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.0</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-10 by
                                            Minton Diaz</p>
                                    </div>
                                    <button
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        Download
                                    </button>
                                </li>
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer"
                                    data-version="v1.1">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.1</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-12 by John
                                            Smith</p>
                                    </div>
                                    <button
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        Download
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Activity History -->
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100 mb-3">Activity History</h3>
                        <div id="activityLog" class="space-y-2 max-h-48 overflow-y-auto">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">John Smith</span> viewed the document <span
                                        class="text-gray-500 text-xs">2 hours ago</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-end gap-3">
                <button id="routeDocumentBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium">
                    Route Document
                </button>
                <button
                    class="modal-close border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 px-5 py-2 rounded-lg text-sm font-medium">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- PDF Preview Modal -->
    <div id="pdfPreviewModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 px-4">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-5xl h-[90vh] flex flex-col">
            <div class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 px-6 py-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">PDF Preview</h3>
                <button
                    class="modal-close text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 text-sm">Close</button>
            </div>
            <div class="flex-1 overflow-hidden">
                <iframe id="pdfViewer" src="" class="w-full h-full rounded-b-2xl"></iframe>
            </div>
        </div>
    </div>

</div>

<script>
    (function() {

        const table = document.getElementById("approvaltable");
        table.addEventListener("click", (e) => {
            const row = e.target.closest("tr");
            row.classList.add("modal-open");
            const cells = Array.from(row.querySelectorAll("td")).map(td => td.textContent.trim());
            initModal({
                modalId: "approvalDocumentModal",
            })
            setTimeout(() => {
                row.classList.remove("modal-open");
            }, 100);
        });




        const MOBILE_BREAKPOINT = 768; // px
        const TABLE_SELECTOR = "table"; // all tables
        const containerSelector = "main"; // SPA container where content is loaded

        function convertTablesToCards(container = document) {
            const tables = container.querySelectorAll(TABLE_SELECTOR);

            tables.forEach((table) => {
                if (table.dataset.processed === "true") return; // already processed
                table.dataset.processed = "true";

                // Create a card container right after the table
                let cardContainer = document.createElement("div");
                cardContainer.classList.add("card-container", "hidden", "mb-4");
                table.parentNode.insertBefore(cardContainer, table.nextSibling);

                const headers = Array.from(table.querySelectorAll("thead th")).map(th => th.textContent);

                function renderCards() {
                    if (window.innerWidth <= MOBILE_BREAKPOINT) {
                        cardContainer.innerHTML = "";
                        table.classList.add("hidden");

                        table.querySelectorAll("tbody tr").forEach(row => {
                            const card = document.createElement("div");
                            card.classList.add(
                                "border", "rounded-lg", "p-4", "mb-4", "shadow-sm", "bg-white"
                            );

                            Array.from(row.children).forEach((cell, index) => {
                                const field = document.createElement("p");
                                field.innerHTML =
                                    `<strong>${headers[index]}:</strong> ${cell.textContent}`;
                                card.appendChild(field);
                            });

                            cardContainer.appendChild(card);
                        });

                        cardContainer.classList.remove("hidden");
                    } else {
                        table.classList.remove("hidden");
                        cardContainer.classList.add("hidden");
                    }
                }

                renderCards();
                window.addEventListener("resize", renderCards);
            });
        }

        // Initial conversion on page load
        document.addEventListener("DOMContentLoaded", () => convertTablesToCards(document.querySelector(
            containerSelector)));

        // Observe changes inside <main> for dynamically loaded tables
        const container = document.querySelector(containerSelector);
        if (container) {
            const observer = new MutationObserver(() => {
                convertTablesToCards(container);
            });

            observer.observe(container, {
                childList: true,
                subtree: true
            });
        }
    })();
</script>
