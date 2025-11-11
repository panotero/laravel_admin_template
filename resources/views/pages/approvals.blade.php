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
            <table class="w-full text-sm text-left border-collapse responsive-table">
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
</div>

<script>
    (function() {
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
