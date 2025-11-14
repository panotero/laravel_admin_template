<div class="min-h-screen bg-gray-50 text-gray-800">


    <!-- Content -->
    <div class="container mx-auto p-6 space-y-10">
        <!-- Table 1: Assigned to You -->
        <div><button id="btnNewDocument"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition modal-open">
                + New Document
            </button>
            <h2 class="text-lg font-semibold text-gray-700 mb-3">
                Assigned to You
            </h2>

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
                <table id="assignedToYouDocumentTable" class="w-full text-sm text-left border-collapse">
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

        <!-- Table 2: All Office Documents -->
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-3">
                All Documents
            </h2>

            <!-- Filters -->
            <div class="flex flex-wrap gap-3 mb-4">
                <select
                    class="rounded-full border-gray-300 text-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>Filter by Office</option>
                </select>
                <select
                    class="rounded-full border-gray-300 text-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>Filter by Status</option>
                </select>
                <select
                    class="rounded-full border-gray-300 text-sm px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option>Filter by File Type</option>
                </select>
                <input type="text" placeholder="Search..."
                    class="rounded-full border-gray-300 px-4 py-2 text-sm w-64 focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <!-- Table -->
            <div class="overflow-x-auto bg-white rounded-xl shadow">
                <table id="allDocumentTable" class="w-full text-sm text-left border-collapse">
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
    </div>

    <!-- Modal: New Document -->
    <div id="modalNewDocument" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-6 overflow-y-auto max-h-[90vh]">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Upload New Document</h2>

            <!-- PDF Upload Area -->
            <div id="dropzone"
                class="border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center p-6 text-gray-500 cursor-pointer hover:border-blue-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16V4m0 0L3 8m4-4l4 4m-4 8h10a2 2 0 002-2V8a2 2 0 00-2-2h-3" />
                </svg>
                <p class="text-sm">
                    Drag & drop a PDF file here or
                    <span class="text-blue-600 underline">click to browse</span>
                </p>
                <input type="file" accept="application/pdf" class="hidden" id="fileInput" required />
            </div>

            <!-- Display selected file info -->
            <p id="fileInfo" class="text-sm text-gray-600 mt-3 text-center"></p>

            <!-- Clear button -->
            <button id="clearSelectionBtn"
                class="mt-3 bg-gray-200 px-3 py-1 rounded hidden hover:bg-gray-300 transition">Clear</button>


            <!-- Input Fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600">Document Code</label>
                        <input id="document_code" type="text" class="w-full border-gray-300 rounded-lg px-3 py-2"
                            required />

                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Subject</label>
                        <input id="subject" type="text" class="w-full border-gray-300 rounded-lg px-3 py-2"
                            required />
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Signatory</label>
                        <input id="signatory" type="text" class="w-full border-gray-300 rounded-lg px-3 py-2"
                            required />
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Remarks</label>
                        <textarea id="remarks" class="w-full border-gray-300 rounded-lg px-3 py-2" required></textarea>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600">Origin Office</label>
                        <select id="originOffice" class="w-full border-gray-300 rounded-lg px-3 py-2 officeSelect"
                            required>
                            <option>Select...</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Destination Office</label>
                        <select id="destinationOffice" class="w-full border-gray-300 rounded-lg px-3 py-2 officeSelect"
                            required>
                            <option>Select...</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Document Type</label>
                        <select id="documentType" class="w-full border-gray-300 rounded-lg px-3 py-2" required>
                            <option>Memo</option>
                            <option>Report</option>
                            <option>Request</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Document Date</label>
                        <input id="document_date" type="date"
                            class="w-full border-gray-300 rounded-lg px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Due Date</label>
                        <input id="due_date" type="date" class="w-full border-gray-300 rounded-lg px-3 py-2" />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end mt-8 space-x-3">
                <button id="btnCancelModal"
                    class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-100 modal-close">
                    Cancel
                </button>
                <button class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </div>
    </div>

    <!-- Document Details Modal -->
    <div id="DocumentModal" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 px-4 modal">
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-6xl max-h-[90vh overflow-y-auto">

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
                        <div
                            class="border border-gray-200 dark:border-gray-700 rounded-lg max-h-48 lg:h-48 overflow-y-auto">
                            <ul id="fileVersionsList" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <!-- Example version item -->
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer fileInfoButton modal-open"
                                    data-version="v1.0" data-file-id = "123">
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
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer fileInfoButton modal-open"
                                    data-version="v1.1" data-file-id = "123">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.1</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-12 by
                                            John
                                            Smith</p>
                                    </div>
                                    <button
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        Download
                                    </button>
                                </li>
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer fileInfoButton modal-open"
                                    data-version="v1.1" data-file-id = "123">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.1</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-12 by
                                            John
                                            Smith</p>
                                    </div>
                                    <button
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        Download
                                    </button>
                                </li>
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer fileInfoButton modal-open"
                                    data-version="v1.1" data-file-id = "123">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.1</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-12 by
                                            John
                                            Smith</p>
                                    </div>
                                    <button
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 ">
                                        Download
                                    </button>
                                </li>
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer fileInfoButton modal-open"
                                    data-version="v1.1" data-file-id = "123">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.1</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-12 by
                                            John
                                            Smith</p>
                                    </div>
                                    <button
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        Download
                                    </button>
                                </li>
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer fileInfoButton modal-open"
                                    data-version="v1.1" data-file-id = "123">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.1</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-12 by
                                            John
                                            Smith</p>
                                    </div>
                                    <button
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        Download
                                    </button>
                                </li>
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer fileInfoButton modal-open"
                                    data-version="v1.1" data-file-id = "123">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.1</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-12 by
                                            John
                                            Smith</p>
                                    </div>
                                    <button
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        Download
                                    </button>
                                </li>
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer fileInfoButton modal-open"
                                    data-version="v1.1" data-file-id = "123">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.1</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-12 by
                                            John
                                            Smith</p>
                                    </div>
                                    <button
                                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        Download
                                    </button>
                                </li>
                                <li class="flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer fileInfoButton modal-open"
                                    data-version="v1.1" data-file-id = "123">
                                    <div>
                                        <p class="text-gray-900 dark:text-gray-100 font-medium">Version 1.1</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Uploaded: 2025-11-12 by
                                            John
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
                        <div id="activityLog" class="space-y-2 max-h-48 lg:h-48 overflow-y-auto">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">John Smith</span> viewed the document <span
                                        class="text-gray-500 text-xs">2 hours ago</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <p><span class="font-semibold">Minton Diaz</span> routed the document to HR <span
                                        class="text-gray-500 text-xs">yesterday</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons anchored bottom-right -->
            <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-4 mt-auto flex justify-end gap-3">
                <button id="routeDocumentBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium routeBtn">
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

    <!-- Routing Modal -->
    <div id="routingModal" class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 px-4">
        <div
            class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto p-6 space-y-6">

            <!-- Header -->
            <div class="border-b border-gray-200 dark:border-gray-700 pb-3">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Route Document</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Select office and user for routing</p>
            </div>

            <!-- Office Selection -->
            <div class="space-y-2">
                <label class="text-gray-700 dark:text-gray-300 font-medium text-sm">Select Office</label>
                <select id="routeOfficeSelect"
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 officeSelect">
                    <option value="">Loading offices...</option>
                </select>
            </div>

            <!-- Internal Routing Section -->
            <div id="internalSection" class="hidden space-y-2">
                <label class="text-gray-700 dark:text-gray-300 font-medium text-sm">Select User</label>
                <select id="userSelect"
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Loading users...</option>
                </select>
            </div>

            <!-- External Routing Section -->
            <div id="externalSection" class="hidden space-y-4">
                <div class="space-y-2">
                    <label class="text-gray-700 dark:text-gray-300 font-medium text-sm">Select Status</label>
                    <select id="statusSelect"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Status</option>
                        <option value="approved">Approved</option>
                        <option value="remand">Remand</option>
                    </select>
                </div>

                <!-- Drag & Drop Upload Section (Visible only when Approved) -->
                <div id="pdfUploadSection" class="hidden">
                    <div id="dropzone"
                        class="border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-lg flex flex-col items-center justify-center p-6 text-gray-500 dark:text-gray-400 cursor-pointer hover:border-blue-400 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16V4m0 0L3 8m4-4l4 4m-4 8h10a2 2 0 002-2V8a2 2 0 00-2-2h-3" />
                        </svg>
                        <p class="text-sm">
                            Drag & drop a PDF file here or
                            <span class="text-blue-600 dark:text-blue-400 underline">click to browse</span>
                        </p>
                        <input type="file" accept="application/pdf" class="hidden" id="fileInput" />
                    </div>
                    <div id="fileInfo" class="mt-2 text-sm text-gray-600 dark:text-gray-300"></div>
                    <button id="clearSelectionBtn"
                        class="mt-2 text-xs text-gray-500 hover:text-red-500 transition">Clear Selection</button>
                </div>
            </div>

            <!-- Remarks -->
            <div class="space-y-2">
                <label class="text-gray-700 dark:text-gray-300 font-medium text-sm">Remarks</label>
                <textarea id="remarks"
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-lg px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500"
                    rows="3" placeholder="Enter remarks..."></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                <button
                    class="modal-close px-5 py-2 rounded-lg text-sm bg-gray-100 dark:bg-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    Cancel
                </button>
                <button id="routeSubmitBtn"
                    class="px-5 py-2 rounded-lg text-sm bg-blue-600 text-white hover:bg-blue-700 transition">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() { // ----------------------------
        // Helper Functions
        // ----------------------------

        // Calculate duration between two dates
        function calculateDuration(startDate, endDate) {
            if (!startDate || !endDate) return "-";
            const start = new Date(startDate);
            const end = new Date(endDate);
            if (isNaN(start) || isNaN(end)) return "-";
            const diffTime = Math.abs(end - start);
            return `${Math.ceil(diffTime / (1000 * 60 * 60 * 24))} days`;
        }

        // Append a single document row to a table
        function appendDocumentRow(tableBody, item) {
            if (!tableBody || !item) return;

            const tr = document.createElement("tr");
            tr.classList.add("border-t", "hover:bg-gray-50", "cursor-pointer");
            tr.dataset.documentId = item.document_id;
            tr.dataset.documentControlNumber = item.document_control_number;
            tr.dataset.userId = item.user_id || '';
            tr.dataset.status = item.status;

            tr.innerHTML = `
        <td class="px-4 py-2">${item.document_code}</td>
        <td class="px-4 py-2">
            <select class="border rounded px-2 py-1 text-xs labeldropdown">
                <option ${item.document_type === "General" ? "selected" : ""}>General</option>
                <option ${item.document_type === "Confidential" ? "selected" : ""}>Confidential</option>
            </select>
        </td>
        <td class="px-4 py-2">${item.particular}</td>
        <td class="px-4 py-2">${item.office_origin}</td>
        <td class="px-4 py-2">${item.destination_office}</td>
        <td class="px-4 py-2">${item.date_forwarded || "-"}</td>
        <td class="px-4 py-2">${calculateDuration(item.date_of_document, item.date_forwarded)}</td>
        <td class="px-4 py-2">${item.created_at ? item.created_at.split('T')[0] : "-"}</td>
        <td class="px-4 py-2">${item.confidentiality || "-"}</td>
        <td class="px-4 py-2">${item.status || "-"}</td>
    `;

            tr.classList.add("modal-open");
            tr.addEventListener("click", (e) => {
                if (e.target.classList.contains("labeldropdown")) return;
                initModal({
                    modalId: "DocumentModal"
                });
                populateDocumentModal(tr.dataset.documentId);
                logActivity('view', tr.dataset.documentId, tr.dataset.documentControlNumber);
            });

            tableBody.appendChild(tr);
        }

        // ----------------------------
        // Fetch and Render Documents
        // ----------------------------
        async function getDocs() {
            if (!window.authUser) {
                console.error("Auth user not found.");
                return;
            }

            const userId = window.authUser.id;
            const userOfficeName = window.authUser.office?.office_name || null;
            const userApprovalType = window.authUser.user_config?.approval_type || null;

            try {
                const res = await fetch("/api/documents");
                const documents = await res.json();

                const allDocsTableBody = document.querySelector("#allDocumentTable tbody");
                const assignedTableBody = document.querySelector("#assignedToYouDocumentTable tbody");

                if (!allDocsTableBody || !assignedTableBody) return;

                allDocsTableBody.innerHTML = "";
                assignedTableBody.innerHTML = "";

                documents.forEach(doc => {
                    const involvedOffices = Array.isArray(doc.involved_office) ? doc.involved_office :
                    [];
                    const activities = Array.isArray(doc.activities) ? doc.activities : [];

                    // ----------------------------
                    // Determine All Documents visibility
                    // ----------------------------
                    const canSeeAllDocs = !userOfficeName || userOfficeName === "ODDG-PP" ||
                        involvedOffices.includes(userOfficeName);
                    if (canSeeAllDocs) {
                        appendDocumentRow(allDocsTableBody, doc);
                    }

                    // ----------------------------
                    // Determine Assigned To You visibility
                    // ----------------------------
                    const routeActivities = activities.filter(a => a.action?.toLowerCase().includes(
                        "route"));
                    const lastRouteActivity = routeActivities.length ? routeActivities[routeActivities
                        .length - 1] : null;
                    let showAssigned = false;

                    if (!lastRouteActivity) {
                        // No route activity: visible to users with "routing" approval type in destination office
                        if (userApprovalType === "routing" && (!userOfficeName || doc
                                .destination_office === userOfficeName)) {
                            showAssigned = true;
                        }
                    } else if (lastRouteActivity.routed_to === userId) {
                        // If last route activity is assigned to current user
                        showAssigned = true;
                    }

                    if (showAssigned) {
                        appendDocumentRow(assignedTableBody, doc);
                    }
                });

            } catch (error) {
                console.error("Error fetching documents:", error);
            }
        }

        // ----------------------------
        // Event Listeners
        // ----------------------------
        function initEventListeners() {

            initPDFDropzone({
                dropzoneId: "dropzone",
                fileInputId: "fileInput",
                fileInfoId: "fileInfo",
                clearBtnId: "clearSelectionBtn",
            });
            fillOfficeDropdown();
            // Open New Document Modal
            document.getElementById("btnNewDocument")?.addEventListener("click", () => {
                initModal({
                    modalId: "modalNewDocument"
                });
            });

            const submitBtn = document.querySelector("#modalNewDocument button.bg-blue-600");
            const fileInput = document.getElementById("fileInput");

            submitBtn.addEventListener("click", async (e) => {

                // Let browser check required fields
                const form = document.querySelector("#modalNewDocument");
                const invalid = form.querySelector(":invalid");

                if (invalid) {
                    invalid.reportValidity();
                    return;
                }

                // PDF required manually (HTML5 cannot validate hidden file inputs)
                if (!fileInput.files[0]) {
                    alert("Please upload a PDF file.");
                    return;
                }

                // --------------------------------------------
                // GET FIELD VALUES
                // --------------------------------------------
                const document_code = document.getElementById("document_code").value.trim();
                const subject = document.getElementById("subject").value.trim();
                const signatory = document.getElementById("signatory").value.trim();
                const remarks = document.getElementById("remarks").value.trim();

                const originOffice = document.getElementById("originOffice").value;
                const destinationOffice = document.getElementById("destinationOffice").value;
                const documentType = document.getElementById("documentType").value;
                const dueDate = document.getElementById("due_date").value;
                const documentDate = document.getElementById("document_date").value;

                const pdfFile = fileInput.files[0];

                // --------------------------------------------
                // FORM DATA BUILD
                // --------------------------------------------
                const formData = new FormData();
                formData.append("document_code", document_code);
                formData.append("date_received", new Date().toISOString().split("T")[0]);
                formData.append("particular", subject);
                formData.append("office_origin", originOffice);
                formData.append("user_id", window.authUser.id);
                formData.append("document_form", "PDF");
                formData.append("document_type", documentType);
                formData.append("due_date", dueDate);
                formData.append("document_date", documentDate);
                formData.append("signatory", signatory);

                formData.append("destination_office", destinationOffice);
                formData.append("remarks", remarks);
                formData.append("file", pdfFile);

                // --------------------------------------------
                // SUBMIT REQUEST
                // --------------------------------------------
                try {
                    submitBtn.disabled = true;
                    submitBtn.textContent = "Submitting...";

                    const response = await fetch("/api/documents", {
                        method: "POST",
                        body: formData
                    });

                    const result = await response.json();

                    if (!response.ok) {
                        alert("Server validation failed:\n" + JSON.stringify(result, null, 2));
                        return;
                    }

                    alert("Document created successfully!");
                    document.getElementById("modalNewDocument").classList.add("hidden");

                    if (typeof getDocs === "function") getDocs();

                } catch (err) {
                    console.error(err);
                    alert("Unexpected error.");
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.textContent = "Submit";
                }
            });



            // PDF Preview Modal
            document.querySelectorAll('.fileInfoButton').forEach(btn => {
                btn.addEventListener("click", () => initModal({
                    modalId: "pdfPreviewModal"
                }));
            });

            // Routing Modal
            document.querySelectorAll('.routeBtn').forEach(btn => {
                btn.addEventListener("click", () => initModal({
                    modalId: "routingModal"
                }));
            });

            // Office change logic
            const officeSelect = document.getElementById("routeOfficeSelect");
            const userSelect = document.getElementById("userSelect");
            const statusSelect = document.getElementById("statusSelect");
            const internalSection = document.getElementById("internalSection");
            const externalSection = document.getElementById("externalSection");
            const pdfUploadSection = document.getElementById("pdfUploadSection");
            const currentOffice = window.authUser.office?.office_name || null;

            officeSelect?.addEventListener("change", e => {
                const selected = e.target.value;
                if (!selected) {
                    internalSection?.classList.add("hidden");
                    externalSection?.classList.add("hidden");
                    return;
                }

                if (selected === currentOffice) {
                    internalSection?.classList.remove("hidden");
                    externalSection?.classList.add("hidden");

                    fetch("/api/users")
                        .then(res => res.json())
                        .then(users => {
                            const filtered = users.filter(u => u.office?.office_name === currentOffice);
                            userSelect.innerHTML = `<option value="">Select User</option>` +
                                filtered.map(u => `<option value="${u.id}">${u.name}</option>`).join(
                                    "");
                        });
                } else {
                    internalSection?.classList.add("hidden");
                    externalSection?.classList.remove("hidden");
                }
            });

            // Show PDF upload only when approved
            statusSelect?.addEventListener("change", e => {
                pdfUploadSection?.classList.toggle("hidden", e.target.value !== "approved");
            });
        }

        // ----------------------------
        // Initialization
        // ----------------------------
        getDocs();
        initEventListeners();


    })();
</script>
