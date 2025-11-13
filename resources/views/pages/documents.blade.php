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
                <table class="w-full text-sm text-left border-collapse">
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
                        <tr class="border-t hover:bg-gray-50">
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
                <<<<<<< HEAD <table class="w-full text-sm text-left border-collapse">
                    =======
                    <table id="allDocumentTable" class="w-full text-sm text-left border-collapse">
                        >>>>>>> main
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
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">DOC-00456</td>
                                <td class="px-4 py-2">
                                    <select class="border rounded px-2 py-1 text-xs">
                                        <option>General</option>
                                        <option>Confidential</option>
                                    </select>
                                </td>
                                <td class="px-4 py-2">Budget Proposal</td>
                                <td class="px-4 py-2">Finance</td>
                                <td class="px-4 py-2">Director’s Office</td>
                                <td class="px-4 py-2">2025-11-10</td>
                                <td class="px-4 py-2"></td>
                                <td class="px-4 py-2">2025-11-05</td>
                                <td class="px-4 py-2">Confidential</td>
                                <td class="px-4 py-2">In Review</td>
                            </tr>
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
                <input type="file" accept="application/pdf" class="hidden" id="fileInput" />
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
                        <input type="text" class="w-full border-gray-300 rounded-lg px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Subject</label>
                        <input type="text" class="w-full border-gray-300 rounded-lg px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Signatory</label>
                        <input type="text" class="w-full border-gray-300 rounded-lg px-3 py-2" />
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Remarks</label>
                        <textarea class="w-full border-gray-300 rounded-lg px-3 py-2"></textarea>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm text-gray-600">Origin Office</label>
                        <<<<<<< HEAD <select id="originOffice" class="w-full border-gray-300 rounded-lg px-3 py-2">
                            =======
                            <select id="originOffice"
                                class="w-full border-gray-300 rounded-lg px-3 py-2 officeSelect">
                                >>>>>>> main
                                <option>Select...</option>
                            </select>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Destination Office</label>
                        <<<<<<< HEAD <select id="destinationOffice"
                            class="w-full border-gray-300 rounded-lg px-3 py-2">
                            =======
                            <select id="destinationOffice"
                                class="w-full border-gray-300 rounded-lg px-3 py-2 officeSelect">
                                >>>>>>> main
                                <option>Select...</option>
                            </select>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Document Type</label>
                        <select class="w-full border-gray-300 rounded-lg px-3 py-2">
                            <option>Memo</option>
                            <option>Report</option>
                            <option>Request</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Due Date</label>
                        <input type="date" class="w-full border-gray-300 rounded-lg px-3 py-2" />
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
    <div id="approvalDocumentModal"
        class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/50 px-4 modal">
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
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg max-h-48 overflow-y-auto">
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
                        <div id="activityLog" class="space-y-2 max-h-48 overflow-y-auto">
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

            <!-- Footer Buttons -->
            <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-end gap-3">
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
    (function() {
            <<
            <<
            << < HEAD
            initModal({
                modalId: "modalNewDocument",
                ===
                ===
                =
                const openModalButton = document.getElementById("btnNewDocument");
                console.log(openModalButton);
                openModalButton.addEventListener("click", () => {

                    initModal({
                        modalId: "modalNewDocument",
                    }); >>>
                    >>>
                    > main
                });

                initPDFDropzone({
                    dropzoneId: "dropzone",
                    fileInputId: "fileInput",
                    fileInfoId: "fileInfo",
                    clearBtnId: "clearSelectionBtn",
                });

                <<
                <<
                << < HEAD
            })();
</script>

<script></script>
=======
// Reference to table body
const tableBody = document.querySelector("#allDocumentTable tbody"); // Sample data array
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
        <option ${item.label === "General" ? "selected" : "" }>General</option>
        <option ${item.label === "Confidential" ? "selected" : "" }>Confidential</option>
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

const fileInfoButton = document.querySelector('.fileInfoButton');
fileInfoButton.addEventListener("click", () => {

initModal({
modalId: "pdfPreviewModal"
});
});
const routeBtn = document.querySelector('.routeBtn');
routeBtn.addEventListener("click", () => {

initModal({
modalId: "routingModal"
});
});

const officeSelect = document.getElementById("routeOfficeSelect");
const officedropdown = document.querySelectorAll(".officeSelect");
const userSelect = document.getElementById("userSelect");
const statusSelect = document.getElementById("statusSelect");
const internalSection = document.getElementById("internalSection");
const externalSection = document.getElementById("externalSection");
const pdfUploadSection = document.getElementById("pdfUploadSection");

const currentOffice = "PO-OED"; // Replace this with the logged-in user's office from backend/session
officedropdown.forEach(officeoption => {
// Fetch offices
fetch("/api/offices")
.then(res => res.json())
.then(offices => {
officeoption.innerHTML = `<option value="">Select Office</option>` +
offices.map(o => `<option value="${o.office_name}">${o.office_name}</option>`)
.join("");
});
})

// Handle office change
officeSelect.addEventListener("change", e => {
const selected = e.target.value;
if (!selected) {
internalSection.classList.add("hidden");
externalSection.classList.add("hidden");
return;
}

if (selected === currentOffice) {
internalSection.classList.remove("hidden");
externalSection.classList.add("hidden");

// Fetch users of the same office
fetch("/api/users")
.then(res => res.json())
.then(users => {
const filtered = users.filter(u => u.office && u.office.office_name ===
currentOffice);
userSelect.innerHTML = `<option value="">Select User</option>` +
filtered.map(u => `<option value="${u.id}">${u.name}</option>`).join("");
});
} else {
internalSection.classList.add("hidden");
externalSection.classList.remove("hidden");
}
});

// Show/hide PDF upload when "Approved" is selected
statusSelect.addEventListener("change", e => {
pdfUploadSection.classList.toggle("hidden", e.target.value !== "approved");
});


})();
</script>
>>>>>>> main
