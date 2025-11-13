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


</div>

<script>
    (function() {

        // Sample data array
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


    })();
</script>
