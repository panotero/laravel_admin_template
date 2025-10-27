<div class="min-h-screen">
    <div class="max-w-7xl mx-auto">


        {{-- Top row: 3 stat cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-black">
            {{-- Total Files --}}
            <div
                class="relative rounded-2xl border border-white/6 bg-white/4 backdrop-blur-lg p-4 shadow-lg  dark:bg-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm ">Total Files</p>
                        <h2 class="mt-2 text-3xl font-bold">
                            {{ $totalFiles ?? 120 }}
                        </h2>
                        <p class="mt-1 text-xs">All files in the system</p>
                    </div>

                    {{-- pill button --}}
                    <div class="flex flex-col items-end gap-2">
                        <button
                            class="px-3 py-1 rounded-full bg-white/8 text-xs font-medium hover:bg-white/12 transition">
                            View
                        </button>
                    </div>
                </div>
            </div>

            {{-- Priority Files --}}
            <div
                class="relative rounded-2xl border border-white/6 bg-white/4 backdrop-blur-lg p-4 shadow-lg dark:bg-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm">Priority Files</p>
                        <h2 class="mt-2 text-3xl font-bold ">
                            {{ $priorityFiles ?? 18 }}
                        </h2>
                        <p class="mt-1 text-xs ">Marked as priority</p>
                    </div>

                    <div class="flex flex-col items-end gap-2">
                        <button
                            class="px-3 py-1 rounded-full bg-white/8 text-xs font-medium  hover:bg-white/12 transition">
                            Manage
                        </button>
                    </div>
                </div>
            </div>

            {{-- Overdue Files --}}
            <div
                class="relative rounded-2xl border border-white/6 bg-white/4 backdrop-blur-lg p-4 shadow-lg dark:bg-white">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm ">Overdue Files</p>
                        <h2 class="mt-2 text-3xl font-bold ">
                            {{ $overdueFiles ?? 5 }}
                        </h2>
                        <p class="mt-1 text-xs ">Past due date</p>
                    </div>

                    <div class="flex flex-col items-end gap-2">
                        <button
                            class="px-3 py-1 rounded-full bg-white/8 text-xs font-medium  hover:bg-white/12 transition">
                            Action
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Graph area: below cards, centered, ~60% width --}}
        <div class="mt-8 flex justify-center ">
            <div class="w-full ">
                <div
                    class="rounded-2xl border border-white/6 bg-white/4 backdrop-blur-lg p-4 shadow-lg text-black dark:bg-white">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-lg font-medium ">File Activity</h3>
                        <div class="flex items-center gap-2">
                            <label for="graph-range" class="text-xs ">Range</label>
                            <select id="graph-range"
                                class="text-xs rounded-full px-3 py-1 bg-white/6focus:outline-none">
                                <option value="week">Week</option>
                                <option value="month">Month</option>
                                <option value="year">Year</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-2">
                        <canvas id="fileGraph" class="w-full h-64"></canvas>
                    </div>
                    <p class="mt-2 text-xs text-gray-400">Sample data shown — replace with your API when ready.</p>
                </div>
            </div>
        </div>

        {{-- Two-column area: Recent updates + Top 5 priority (table) --}}
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Recent updates (span 2 columns on large screens) --}}
            <div class="lg:col-span-2 rounded-2xl border border-white/6 bg-white/4 backdrop-blur-lg p-4 shadow-lg">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-medium text-white">Recent Updates</h3>
                    <span class="text-xs text-gray-300">Latest 10</span>
                </div>

                <div class="max-h-64 overflow-y-auto pr-2 scroll-smooth">
                    <ul class="divide-y divide-white/6 text-sm">
                        <li class="py-3 flex justify-between items-start">
                            <div>
                                <div class="text-sm text-white font-medium">File ABC123</div>
                                <div class="text-xs text-gray-300 mt-1">Marked as Priority by <span
                                        class="text-gray-200">Anna</span></div>
                            </div>
                            <div class="text-xs text-gray-400">2h ago</div>
                        </li>
                        <li class="py-3 flex justify-between items-start">
                            <div>
                                <div class="text-sm text-white font-medium">File XYZ789</div>
                                <div class="text-xs text-gray-300 mt-1">Deadline missed — Overdue</div>
                            </div>
                            <div class="text-xs text-gray-400">1d ago</div>
                        </li>
                        <li class="py-3 flex justify-between items-start">
                            <div>
                                <div class="text-sm text-white font-medium">File LMN456</div>
                                <div class="text-xs text-gray-300 mt-1">Status changed to Closed</div>
                            </div>
                            <div class="text-xs text-gray-400">3d ago</div>
                        </li>
                        <li class="py-3 flex justify-between items-start">
                            <div>
                                <div class="text-sm text-white font-medium">File LMN456</div>
                                <div class="text-xs text-gray-300 mt-1">Status changed to Closed</div>
                            </div>
                            <div class="text-xs text-gray-400">3d ago</div>
                        </li>
                        <li class="py-3 flex justify-between items-start">
                            <div>
                                <div class="text-sm text-white font-medium">File LMN456</div>
                                <div class="text-xs text-gray-300 mt-1">Status changed to Closed</div>
                            </div>
                            <div class="text-xs text-gray-400">3d ago</div>
                        </li>
                        <li class="py-3 flex justify-between items-start">
                            <div>
                                <div class="text-sm text-white font-medium">File LMN456</div>
                                <div class="text-xs text-gray-300 mt-1">Status changed to Closed</div>
                            </div>
                            <div class="text-xs text-gray-400">3d ago</div>
                        </li>
                        <li class="py-3 flex justify-between items-start">
                            <div>
                                <div class="text-sm text-white font-medium">File LMN456</div>
                                <div class="text-xs text-gray-300 mt-1">Status changed to Closed</div>
                            </div>
                            <div class="text-xs text-gray-400">3d ago</div>
                        </li>
                        <li class="py-3 flex justify-between items-start">
                            <div>
                                <div class="text-sm text-white font-medium">File LMN456</div>
                                <div class="text-xs text-gray-300 mt-1">Status changed to Closed</div>
                            </div>
                            <div class="text-xs text-gray-400">3d ago</div>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Top 5 priority (compact table) --}}
            <div class="rounded-2xl border border-white/6 bg-white/4 backdrop-blur-lg p-4 shadow-lg">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-lg font-medium text-white">Top 5 Priority</h3>
                    <span class="text-xs text-gray-300">By priority</span>
                </div>

                <table class="w-full text-sm">
                    <thead class="text-xs text-gray-300 border-b border-white/6">
                        <tr>
                            <th class="py-2 text-left">File</th>
                            <th class="py-2 text-left">Priority</th>
                            <th class="py-2 text-left">Due</th>
                        </tr>
                    </thead>
                    <tbody class="text-white/90">
                        <tr class="border-b border-white/6">
                            <td class="py-2">ABC123</td>
                            <td class="py-2 text-sm">High</td>
                            <td class="py-2 text-sm">Oct 20</td>
                        </tr>
                        <tr class="border-b border-white/6">
                            <td class="py-2">DEF234</td>
                            <td class="py-2 text-sm">High</td>
                            <td class="py-2 text-sm">Oct 22</td>
                        </tr>
                        <tr class="border-b border-white/6">
                            <td class="py-2">GHI345</td>
                            <td class="py-2 text-sm">Medium</td>
                            <td class="py-2 text-sm">Oct 25</td>
                        </tr>
                        <tr class="border-b border-white/6">
                            <td class="py-2">JKL456</td>
                            <td class="py-2 text-sm">Medium</td>
                            <td class="py-2 text-sm">Oct 27</td>
                        </tr>
                        <tr>
                            <td class="py-2">MNO567</td>
                            <td class="py-2 text-sm">Low</td>
                            <td class="py-2 text-sm">Nov 01</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-3 text-xs text-gray-400">Minimal columns for compact view.</div>
            </div>
        </div>

    </div>
</div>
