<div
    class="p-6 bg-gradient-to-br from-slate-100 via-white to-slate-200 min-h-screen rounded-2xl shadow-inner backdrop-blur-xl">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">User Management</h1>

    <!-- Create User Form -->
    <div class="bg-white/60 backdrop-blur-md rounded-2xl p-6 shadow-lg mb-8 border border-white/40">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Create New User</h2>

        <!-- Notification box -->
        <div id="formMessage"
            class="hidden mb-4 px-4 py-3 rounded-lg font-medium transition-all duration-500 opacity-0 text-center">
        </div>

        <form id="userForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <label class="block text-gray-600 font-medium mb-1">Full Name</label>
                <input type="text" name="name"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="John Doe">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-600 font-medium mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="user@example.com">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-600 font-medium mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="••••••••">
            </div>

            <!-- Role Dropdown -->
            <div>
                <label class="block text-gray-600 font-medium mb-1">Role</label>
                <select name="role_id" id="roleSelect"
                    class="w-full rounded-xl border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->role_name) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <div class="md:col-span-2 flex justify-end mt-3">
                <button type="submit"
                    class="px-6 py-2 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-md hover:from-blue-600 hover:to-blue-700 transition-all duration-200 active:scale-95">
                    <i class="fa-solid fa-user-plus mr-2"></i> Create User
                </button>
            </div>
        </form>

        <div class="p-6 max-w-xl mx-auto">
            <h2 class="text-lg font-semibold mb-3">Test API Trigger</h2>

            <div id="apiStatus" style="display:none; padding:8px; margin-bottom:10px; border-radius:4px;"></div>

            <button id="triggerApiStoreBtn"
                style="padding:8px 16px; background:green; color:white; border:none; border-radius:4px; cursor:pointer;">
                Trigger API
            </button>

        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white/60 backdrop-blur-md rounded-2xl p-6 shadow-lg border border-white/40">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Current Users</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead
                    class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3 text-left">Created At</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white/70 text-gray-800">
                    @forelse($users as $user)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border-t">{{ $user->id }}</td>
                            <td class="px-4 py-3 border-t">{{ $user->name }}</td>
                            <td class="px-4 py-3 border-t">{{ $user->email }}</td>
                            <td class="px-4 py-3 border-t capitalize">{{ $user->role->role_name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 border-t">{{ $user->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-3 border-t text-center">
                                <button class="text-blue-600 hover:text-blue-800 transition"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                                <button class="text-red-600 hover:text-red-800 ml-3 transition"><i
                                        class="fa-solid fa-trash-can"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    (function() {


        document.getElementById('userForm').addEventListener('submit', async function(e) {


            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            // 🟢 Get the selected role name and ID
            const roleSelect = document.getElementById('roleSelect');
            const selectedRoleName = roleSelect.options[roleSelect.selectedIndex].text.trim();
            const selectedRoleId = roleSelect.value;

            // 🟢 Append both to FormData
            formData.append('role', selectedRoleName);
            formData.set('role_id', selectedRoleId); // ensure correct role_id is sent

            // Show message box
            const msgBox = document.createElement('div');
            msgBox.className =
                'fixed top-5 right-5 bg-blue-500 text-white px-4 py-2 rounded-xl shadow-lg opacity-0 transition-opacity duration-300';
            document.body.appendChild(msgBox);

            function showMessage(message, type = 'success') {
                msgBox.textContent = message;
                msgBox.className = `fixed top-5 right-5 px-4 py-2 rounded-xl shadow-lg transition-opacity duration-300 ${
            type === 'error' ? 'bg-red-500' : 'bg-green-500'
        } text-white opacity-100`;

                setTimeout(() => {
                    msgBox.style.opacity = '0';
                    setTimeout(() => msgBox.remove(), 600);
                }, 3000);
            }

            try {
                const response = await fetch('/api/users/store', {
                    method: 'POST',
                    body: formData,
                    credentials: 'include', // include cookies/session if needed
                });

                const res = await response.json();

                if (!response.ok || !res.success) {
                    throw new Error(res.message || 'Something went wrong');
                }

                showMessage('✅ User created successfully!');
                form.reset();
                location.reload();

            } catch (error) {
                showMessage('❌ ' + error.message, 'error');
            }
        });


        document.getElementById('triggerApiStoreBtn').addEventListener("click", async function(event) {
            const status = document.getElementById("apiStatus");
            console.log("trigger clicked");

            status.style.display = "block";
            status.style.background = "#eee";
            status.style.color = "#000";
            status.textContent = "⏳ Sending...";

            try {
                const response = await fetch("/api/test-api", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                    body: JSON.stringify({
                        extraData: "test"
                    }),
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    status.style.background = "#d4edda";
                    status.style.color = "#155724";
                    status.textContent = "✅ " + result.message;
                } else {
                    status.style.background = "#f8d7da";
                    status.style.color = "#721c24";
                    status.textContent = "❌ " + (result.message || "Failed");
                }
            } catch (err) {
                status.style.background = "#f8d7da";
                status.style.color = "#721c24";
                status.textContent = "⚠️ Error: " + err.message;
            }

        });

    })();
</script>
