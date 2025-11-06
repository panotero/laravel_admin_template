<div class="lg:m-5 p-5 rounded-lg bg-white">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Navigation Menus</h2>
        <button id="addMenuBtn" onclick="add_menu()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add New Menu
        </button>
    </div>

    <!-- ✅ Table -->
    <table class="w-full border" id="navMenuTable">
        <thead class="bg-gray-200 text-black">
            <tr>
                <th class="p-2 border">Title</th>
                <th class="p-2 border">Icon</th>
                <th class="p-2 border">Link</th>
                <th class="p-2 border">Allowed Roles</th>
                <th class="p-2 border">Parent</th>
                <th class="p-2 border text-center">Order</th>
            </tr>
        </thead>
        <tbody id="navMenuTbody">
            <!-- Rows inserted dynamically -->
        </tbody>
    </table>
</div>

<!-- ✅ Modal -->
<div id="menuModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white w-full max-w-md rounded shadow p-6 relative">
        <h3 id="modalTitle" class="text-lg font-semibold mb-4">Add New Menu</h3>

        <form id="menuForm" class="space-y-3">
            <input type="hidden" id="menuId">

            <div>
                <label class="block font-medium">Title</label>
                <input id="menuTitle" type="text" class="w-full border p-2 rounded text-black">
            </div>

            <div>
                <label class="block font-medium">Icon</label>
                <input id="menuIcon" type="text" class="w-full border p-2 rounded text-black">
            </div>

            <div>
                <label class="block font-medium">Link</label>
                <input id="menuLink" type="text" class="w-full border p-2 rounded text-black">
            </div>

            <div>
                <label class="block font-medium">Allowed Roles</label>
                <div id="menuRolesContainer" class="grid grid-cols-2 gap-2 text-black">
                    <!-- Checkboxes will be injected here -->
                </div>
            </div>

            <div>
                <label class="block font-medium">Parent Menu</label>
                <select id="menuParent" class="w-full border p-2 rounded text-black">
                    <!-- Options will be injected here -->
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button type="button" id="cancelModalBtn" class="px-4 py-2 rounded bg-gray-300">Cancel</button>
                <button type="submit" id="saveMenuBtn" class="px-4 py-2 rounded bg-green-600 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    (function() {
        const modal = document.getElementById("menuModal");
        const cancelBtn = document.getElementById("cancelModalBtn");
        const form = document.getElementById("menuForm");
        const saveBtn = document.getElementById("saveMenuBtn");
        const modalTitle = document.getElementById("modalTitle");

        const fields = {
            id: document.getElementById("menuId"),
            title: document.getElementById("menuTitle"),
            icon: document.getElementById("menuIcon"),
            link: document.getElementById("menuLink"),
            rolesContainer: document.getElementById("menuRolesContainer"),
            parent: document.getElementById("menuParent"),
        };

        const tableBody = document.getElementById("navMenuTbody");
        let menusData = []; // store all menus for parent-child relationship

        // Load initial data
        loadMenus();
        loadRoles();

        // Cancel modal
        cancelBtn.addEventListener("click", () => {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        });

        // Parent select change: if a parent is selected, copy its roles and disable checkboxes
        fields.parent.addEventListener("change", () => {
            const parentId = parseInt(fields.parent.value);
            if (parentId === 0) {
                // Main menu: enable roles
                document.querySelectorAll('.roleCheckbox').forEach(cb => cb.disabled = false);
                document.querySelectorAll('.roleCheckbox').forEach(cb => cb.checked = false);
            } else {
                // Child menu: get parent's allowed_roles
                const parentMenu = menusData.find(m => m.id === parentId);
                if (parentMenu) {
                    const parentRoles = JSON.parse(parentMenu.allowed_roles || "[]");
                    document.querySelectorAll('.roleCheckbox').forEach(cb => {
                        cb.checked = parentRoles.includes(cb.value);
                        cb.disabled = true; // cannot modify child roles
                    });
                }
            }
        });

        // Submit form
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            let checkedRoles = Array.from(
                document.querySelectorAll('.roleCheckbox:checked')
            ).map(cb => cb.value);

            const parentId = parseInt(fields.parent.value);

            // If it has a parent, follow parent's roles
            if (parentId !== 0) {
                const parentMenu = menusData.find(m => m.id === parentId);
                checkedRoles = JSON.parse(parentMenu.allowed_roles || "[]");
            }

            const payload = {
                title: fields.title.value,
                icon: fields.icon.value,
                link: fields.link.value,
                allowed_roles: `[${checkedRoles.map(r => `"${r}"`).join(',')}]`,
                parent_menu: fields.parent.value,
            };

            let url = `${window.APP_URL}/api/nav_menus`;
            let method = "POST";

            if (fields.id.value) {
                url = `${window.APP_URL}/api/nav_menus/${fields.id.value}`;
                method = "PUT";
            }

            const res = await fetch(url, {
                method,
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(payload),
            });

            // ✅ If updating parent, also update child menus
            if (fields.id.value) {
                const currentMenuId = parseInt(fields.id.value);
                const updatedMenu = await res.json();

                // If parent menu was updated, update all children roles
                menusData.forEach(async (m) => {
                    if (m.parent_menu === currentMenuId) {
                        await fetch(`${window.APP_URL}/api/nav_menus/${m.id}`, {
                            method: "PUT",
                            headers: {
                                "Content-Type": "application/json",
                                Accept: "application/json",
                            },
                            body: JSON.stringify({
                                ...m,
                                allowed_roles: updatedMenu.data
                                    .allowed_roles
                            }),
                        });
                    }
                });
            }

            modal.classList.add("hidden");
            loadMenus();
            loadRoles();
        });

        // Function: Load Menus
        async function loadMenus() {
            const res = await fetch(`${window.APP_URL}/api/nav_menus_list`, {
                credentials: 'include',
                headers: {
                    Accept: "application/json"
                }
            });
            menusData = await res.json();

            tableBody.innerHTML = "";

            const menuMap = {};
            menusData.forEach(menu => menuMap[menu.id] = menu.title);

            menusData.forEach(menu => {
                const tr = document.createElement("tr");
                tr.classList.add("cursor-pointer", "hover:bg-gray-100");

                const parentName = menu.parent_menu === 0 ?
                    "Main Menu" :
                    (menuMap[menu.parent_menu] || "Unknown");

                tr.innerHTML = `
            <td class="border p-2">${menu.title}</td>
            <td class="border p-2">${menu.icon || ""}</td>
            <td class="border p-2">${menu.link || ""}</td>
            <td class="border p-2">${menu.allowed_roles || ""}</td>
            <td class="border p-2">${parentName}</td>
            <td class="border p-2 text-center">
                <button class="move-up text-blue-600 hover:text-blue-800" data-id="${menu.id}">⬆️</button>
                <button class="move-down text-blue-600 hover:text-blue-800" data-id="${menu.id}">⬇️</button>
            </td>
        `;
                tableBody.appendChild(tr);
            });
        }

        // ✅ Attach this ONCE — outside of loadMenus()
        tableBody.addEventListener('click', async (e) => {
            const btn = e.target.closest('button');
            if (!btn) return;

            const id = parseInt(btn.dataset.id);
            if (btn.classList.contains('move-up')) {
                await moveMenuUp(id);
            } else if (btn.classList.contains('move-down')) {
                await moveMenuDown(id);
            }
        });


        // ✅ Function to move menu up
        async function moveMenuUp(id) {
            const current = menusData.find(m => m.id === id);
            const siblings = menusData
                .filter(m => m.parent_menu === current.parent_menu)
                .sort((a, b) => a.menu_order - b.menu_order);

            const currentIndex = siblings.findIndex(m => m.id === id);

            if (currentIndex === 0) {
                alert('This menu is already at the top.');
                return;
            }

            const swapWith = siblings[currentIndex - 1];

            // 🔁 Call backend to swap
            await fetch(`${window.APP_URL}/api/menus/swap`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json"
                },
                body: JSON.stringify({
                    id1: current.id,
                    id2: swapWith.id
                }),
                credentials: "include"
            });

            // 🔄 Reload table
            loadMenus();
        }


        // ✅ Function to move menu down
        async function moveMenuDown(id) {
            const current = menusData.find(m => m.id === id);
            const siblings = menusData
                .filter(m => m.parent_menu === current.parent_menu)
                .sort((a, b) => a.menu_order - b.menu_order);

            const currentIndex = siblings.findIndex(m => m.id === id);

            if (currentIndex === siblings.length - 1) {
                alert('This menu is already at the bottom.');
                return;
            }

            const swapWith = siblings[currentIndex + 1];

            // 🔁 Call backend to swap
            await fetch(`${window.APP_URL}/api/menus/swap`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json"
                },
                body: JSON.stringify({
                    id1: current.id,
                    id2: swapWith.id
                }),
                credentials: "include"
            });

            // 🔄 Reload table
            loadMenus();
        }


        // Load on start
        loadMenus();


        // Load roles as checkboxes
        async function loadRoles() {
            const res = await fetch(`${window.APP_URL}/api/userconfigs`, {
                headers: {
                    Accept: "application/json"
                }
            });
            const roles = await res.json();
            const container = fields.rolesContainer;
            container.innerHTML = "";

            roles.forEach(role => {
                const wrapper = document.createElement("label");
                wrapper.classList.add("flex", "items-center", "gap-2");
                wrapper.innerHTML = `
                <input type="checkbox" value="${role.designation}" class="roleCheckbox">
                <span>${role.designation}</span>
            `;
                container.appendChild(wrapper);
            });
        }


        // Add new menu button
        function add_menu() {
            const addBtn = document.getElementById("addMenuBtn");
            addBtn.addEventListener("click", () => {
                modalTitle.textContent = "Add New Menu";
                saveBtn.textContent = "Save";
                fields.id.value = "";
                fields.title.value = "";
                fields.icon.value = "";
                fields.link.value = "";
                fields.parent.value = 0;

                // Reset roles checkboxes
                document.querySelectorAll('.roleCheckbox').forEach(cb => {
                    cb.checked = false;
                    cb.disabled = false;
                });

                modal.classList.remove("hidden");
                modal.classList.add("flex");
            });
        }

        add_menu(); // initialize add menu button

    })();
</script>
