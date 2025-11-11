<div class="min-h-screen bg-gray-50 text-gray-800">


    <!-- Content -->
    <div class="container mx-auto p-6 space-y-10">
        <!-- Table 1: Assigned to You -->
        <div><button id="btnNewDocument"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
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
                        <select id="originOffice" class="w-full border-gray-300 rounded-lg px-3 py-2">
                            <option>Select...</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm text-gray-600">Destination Office</label>
                        <select id="destinationOffice" class="w-full border-gray-300 rounded-lg px-3 py-2">
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
</div>

<script>
    (function() {
        initModal({
            modalId: "modalNewDocument",
            openBtnId: "btnNewDocument",
            closeBtnId: "btnCancelModal",
        });

        initPDFDropzone({
            dropzoneId: "dropzone",
            fileInputId: "fileInput",
            fileInfoId: "fileInfo",
            clearBtnId: "clearSelectionBtn",
        });

    })();
</script>

<script></script>
