<!-- User Config Table -->
<div class="w-full h-screen bg-white dark:bg-gray-800 rounded-2xl shadow-md p-5">
    <div class="w-full flex justify-between p-5">

        <h2 class="text-xl font-semibold mb-4">User List</h2>
        <button id="addUserBtn" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow">
            + New User
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border-collapse" id="userTable">
            <thead class="bg-gray-100">
                <tr class="bg-gray-100 dark:bg-gray-700 text-left">
                    <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">ID</th>
                    <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Name</th>
                    <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Email</th>
                    <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Role</th>
                    <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Office</th>
                    <th class="text-center px-6 py-3 text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody id="userTableBody"></tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="userModal" class="fixed inset-0 bg-black/40 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl w-full max-w-lg p-6 shadow-xl relative transition-all">
        <h2 id="modalTitle" class="text-xl font-semibold mb-4">Add New User</h2>

        <!-- Form -->
        <form id="userForm" class="space-y-4">
            <input type="hidden" id="userId" />

            <div>
                <label class="block text-sm text-gray-600 mb-1">Name</label>
                <input id="userName" type="text"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200" placeholder="Full name" />
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Email</label>
                <input id="userEmail" type="email"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Email address" />
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Password</label>
                <input id="userPassword" type="password"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200" placeholder="Password"
                    minlength="6" required />
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">Office</label>
                <select id="officeSelect" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">Select Office</option>
                </select>
            </div>

            <div>
                <label class="block text-sm text-gray-600 mb-1">User Config</label>
                <select id="configSelect" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">Select Config</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" id="cancelBtn"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">Cancel</button>
                <button type="submit" id="saveBtn"
                    class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg hidden">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Script -->
<script>
    (function() {

        const apiUsers = "/api/users";
        const apiOffices = "/api/offices";
        const apiConfigs = "/api/userconfigs";

        const userTableBody = document.getElementById("userTableBody");
        const userModal = document.getElementById("userModal");
        const modalTitle = document.getElementById("modalTitle");
        const addUserBtn = document.getElementById("addUserBtn");
        const cancelBtn = document.getElementById("cancelBtn");
        const saveBtn = document.getElementById("saveBtn");
        const userForm = document.getElementById("userForm");

        const userName = document.getElementById("userName");
        const userEmail = document.getElementById("userEmail");
        const userPassword = document.getElementById("userPassword");
        const userId = document.getElementById("userId");
        const officeSelect = document.getElementById("officeSelect");
        const configSelect = document.getElementById("configSelect");

        // Fetch all users
        async function loadUsers() {
            const res = await fetch(apiUsers);
            const users = await res.json();
            userTableBody.innerHTML = "";

            users.forEach((u) => {
                const actionLabel = u.status === 'deactivated' ? 'Reactivate' : 'Deactivate';
                const actionClass = u.status === 'deactivated' ? 'reactivateBtn bg-green-400' :
                    'deactivateBtn bg-red-500';

                userTableBody.insertAdjacentHTML(
                    "beforeend",
                    `
      <tr class="border-t hover:bg-gray-50 transition">
        <td class="px-6 py-3">${u.id}</td>
        <td class="px-6 py-3">${u.name}</td>
        <td class="px-6 py-3">${u.email}</td>
        <td class="px-6 py-3">${u.role ?? '-'}</td>
        <td class="px-6 py-3">${u.office_name ?? '-'}</td>
        <td class="px-6 py-3 text-center">
          <button class="text-blue-500 hover:underline editBtn" data-id="${u.id}">Edit</button> |
          <button class="text-white px-5 py-2 rounded ${actionClass}" data-id="${u.id}">${actionLabel}</button>
        </td>
      </tr>
    `
                );
            });
        }

        // Fetch dropdown data
        async function loadDropdowns() {
            const [officesRes, configsRes] = await Promise.all([
                fetch(apiOffices),
                fetch(apiConfigs),
            ]);

            const [offices, configs] = await Promise.all([
                officesRes.json(),
                configsRes.json(),
            ]);

            officeSelect.innerHTML =
                '<option value="">Select Office</option>' +
                offices.map((o) => `<option value="${o.office_id}">${o.office_name}</option>`).join("");

            configSelect.innerHTML =
                '<option value="">Select Config</option>' +
                configs.map((c) => `<option value="${c.id}">${c.designation}</option>`).join("");
        }

        // Show modal
        function openModal(edit = false, user = null) {
            userModal.classList.remove("hidden");
            saveBtn.classList.add("hidden");

            if (edit && user) {
                modalTitle.textContent = "Edit User";
                userId.value = user.id;
                userName.value = user.name;
                userEmail.value = user.email;
                officeSelect.value = user.office_id ?? "";
                configSelect.value = user.config_id ?? "";
            } else {
                modalTitle.textContent = "Add New User";
                userForm.reset();
            }
        }

        // Hide modal
        function closeModal() {
            userModal.classList.add("hidden");
            userForm.reset();
            userId.value = "";
        }

        // Detect form change
        userForm.addEventListener("input", () => {
            saveBtn.classList.remove("hidden");
        });

        // Handle submit
        userForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const data = {
                name: userName.value,
                email: userEmail.value,
                password: userPassword.value,
                office_id: officeSelect.value,
                role_id: configSelect.value,
                role: configSelect.selectedOptions[0].text,
            };

            const method = userId.value ? "PUT" : "POST";
            const url = userId.value ? `${apiUsers}/${userId.value}` : apiUsers;
            await fetch(url, {
                method,
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data),
            });

            closeModal();
            loadUsers();
        });

        // Handle click events
        document.addEventListener("click", (e) => {
            if (e.target.matches(".editBtn")) {
                const id = e.target.dataset.id;
                fetch(`${apiUsers}/${id}`)
                    .then((res) => res.json())
                    .then((data) => openModal(true, data));
            }

            if (e.target.matches(".deactivateBtn")) {
                const id = e.target.dataset.id;
                if (confirm("Deactivate this user?")) {
                    // Deactivate a user
                    fetch(`/api/deactivate_users/${id}`, {
                            method: 'PATCH'
                        })
                        .then(res => res.json())
                        .then(data => {
                            loadUsers(); // refresh table
                        });

                }
            }
            if (e.target.matches(".reactivateBtn")) {
                const id = e.target.dataset.id;
                if (confirm("Reactivate this user?")) {
                    // Deactivate a user
                    fetch(`/api/reactivate_users/${id}`, {
                            method: 'PATCH'
                        })
                        .then(res => res.json())
                        .then(data => {
                            loadUsers(); // refresh table
                        });

                }
            }
        });

        // Modal triggers
        addUserBtn.addEventListener("click", () => openModal());
        cancelBtn.addEventListener("click", closeModal);

        // Init
        loadUsers();
        loadDropdowns();

    })();
</script>
