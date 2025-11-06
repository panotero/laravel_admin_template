// resources/js/navmenu.js
document.addEventListener("DOMContentLoaded", function () {
  const AppURL = window.APP_URL;
  const sidebar = document.getElementById("sidebar-menu");
  if (!sidebar) return;

  // === PAGE LOADER FUNCTION ===
  function loadPage(menu) {
    if (!menu) return;

    // Save the last visited menu
    localStorage.setItem("lastMenu", JSON.stringify(menu));
    // console.log(menu.title);
    const menulist = document.querySelectorAll(".menu");
    const activemenu = document.querySelectorAll(".menu.active");
    const activepage = Array.from(menulist).find(
      (btn) => btn.textContent.trim() === menu.title
    );
    activemenu.forEach((activebttn) => {
      activebttn.classList.remove(
        "bg-blue-400",
        "hover:dark:bg-blue-600",
        "text-white",
        "active",
        "hover:bg-blue-600"
      );
      activebttn.classList.add("text-black", "hover:bg-gray-200");
    });
    activepage.classList.add(
      "bg-blue-400",
      "hover:dark:bg-blue-600",
      "text-white",
      "active",
      "hover:bg-blue-600"
    );
    activepage.classList.remove("hover:bg-gray-200", "text-black");
    // console.log(activepage);

    // Update page title
    const titleEl = document.getElementById("page-title");
    if (titleEl) titleEl.textContent = menu.title;

    // Load page content
    fetch(AppURL + menu.link, {
      headers: { Accept: "application/json" },
    })
      .then((res) => res.text())
      .then((data) => {
        const contentEl = document.getElementById("content");

        // Inject the HTML
        // contentEl.innerHTML = `<div class="p-4 bg-white dark:bg-gray-800 rounded shadow">${data}</div>`;
        contentEl.innerHTML = `<div class="dark p-4 dark:bg-gray-800 rounded shadow">${data}</div>`;

        // ✅ Find and execute any inline/external scripts inside the loaded HTML
        const scripts = contentEl.querySelectorAll("script");
        scripts.forEach((oldScript) => {
          const newScript = document.createElement("script");

          if (oldScript.src) {
            // If external script (with src="")
            newScript.src = oldScript.src;
          } else {
            // Inline script content
            newScript.textContent = oldScript.textContent;
          }

          document.body.appendChild(newScript);
          oldScript.remove();
        });
      })
      .catch(() => {
        document.getElementById(
          "content"
        ).innerHTML = `<div class="p-4 bg-red-200 text-red-800 rounded">Failed to load ${menu.title}</div>`;
      });
  }

  window.loadPage = loadPage; // expose globally for other JS

  // === BUILD TREE STRUCTURE ===
  function buildTree(flat) {
    const map = {};
    flat.forEach((m) => (map[m.id] = Object.assign({}, m, { children: [] })));
    const roots = [];
    flat.forEach((m) => {
      if (m.parent_menu && m.parent_menu !== 0 && map[m.parent_menu]) {
        map[m.parent_menu].children.push(map[m.id]);
      } else {
        roots.push(map[m.id]);
      }
    });
    return roots;
  }

  // === CREATE MENU ITEM ===
  function createMenuItem(menu) {
    const wrapper = document.createElement("div");
    wrapper.className = "w-full";

    const btn = document.createElement("button");
    btn.type = "button";
    btn.className =
      "w-full text-left px-3 py-2 rounded hover:bg-gray-200 dark:text-white dark:hover:bg-gray-700 flex items-center justify-between gap-2 menu";

    const left = document.createElement("span");
    left.className = "flex items-center gap-2";
    left.innerHTML = `<i class="${menu.icon || ""}"></i> ${menu.title || ""}`;
    btn.appendChild(left);

    let arrow = null;
    if (menu.children && menu.children.length) {
      arrow = document.createElement("span");
      arrow.innerHTML = "▼";
      arrow.className = "text-xs transition-transform duration-200";
      btn.appendChild(arrow);
    }

    wrapper.appendChild(btn);

    if (menu.children && menu.children.length) {
      const sub = document.createElement("div");
      sub.className =
        "space-y-1 bg-gray-100 dark:bg-gray-800 dark:text-gray-300";
      sub.style.maxHeight = "0px";
      sub.style.overflow = "hidden";
      sub.style.transition = "max-height 250ms ease";

      menu.children.forEach((child) => {
        const childBtn = document.createElement("button");
        childBtn.type = "button";
        childBtn.className =
          "w-full text-left px-3 py-2 rounded hover:bg-gray-200 dark:text-white dark:hover:bg-gray-700 flex items-center gap-2 menu child-menu";
        childBtn.innerHTML = `<i class="${child.icon || ""}"></i> ${
          child.title || ""
        }`;
        childBtn.addEventListener("click", (e) => {
          e.stopPropagation();
          loadPage(child); // ✅ loads child + saves as lastMenu
          if (window.innerWidth < 1024) toggleSidebar();
        });
        sub.appendChild(childBtn);
      });

      wrapper.appendChild(sub);

      btn.addEventListener("click", (e) => {
        e.stopPropagation();
        if (sub.style.maxHeight === "0px") {
          sub.style.maxHeight = sub.scrollHeight + "px";
          if (arrow) arrow.style.transform = "rotate(180deg)";
        } else {
          sub.style.maxHeight = "0px";
          if (arrow) arrow.style.transform = "";
        }
      });
    } else {
      btn.addEventListener("click", () => {
        loadPage(menu);
        if (window.innerWidth < 1024) toggleSidebar(); // Auto-close on mobile
      });
    }

    return wrapper;
  }

  fetch(`${AppURL}/api/debug_auth`, {
    credentials: "include", // send cookies for session-based auth
    headers: {
      Accept: "application/json",
    },
  })
    .then((res) => {
      if (!res.ok) {
        throw new Error(`HTTP error! status: ${res.status}`);
      }
      return res.json(); // parse JSON response
    })
    .catch((err) => {
      console.error("Fetch error:", err);
    });

  // === FETCH MENUS ===
  fetch(`${AppURL}/api/load_menu`, {
    credentials: "include", // IMPORTANT
    headers: {
      Accept: "application/json",
    },
  })
    .then((res) => res.json())
    .then((data) => {
      let menus = data || [];
      if (menus.length && !("children" in menus[0])) {
        menus = buildTree(menus);
      }

      sidebar.innerHTML = "";
      let firstMenu = null;
      menus.forEach((menu) => {
        const node = createMenuItem(menu);
        sidebar.appendChild(node);
        if (!firstMenu && menu.title?.toLowerCase() === "dashboard") {
          firstMenu = menu;
        }
      });

      // 🔥 Restore last visited page
      let lastMenu = localStorage.getItem("lastMenu");
      console.log(lastMenu);
      if (lastMenu) {
        try {
          lastMenu = JSON.parse(lastMenu);
          loadPage(lastMenu);
          return;
        } catch (e) {
          console.warn("Failed to parse lastMenu", e);
        }
      }

      // fallback if no lastMenu
      if (firstMenu) loadPage(firstMenu);
      else if (menus.length) loadPage(menus[0]);
    })
    .catch((err) => console.error("Failed to load nav menus", err));

  // Elements
  const sidebarWrapper = document.getElementById("sidebar-wrapper");
  const sidebarToggle = document.getElementById("sidebar-toggle");
  const sidebarOverlay = document.getElementById("sidebar-overlay");
  const sidebarMenu = document.getElementById("sidebar-menu");

  // Toggle sidebar open/close
  function toggleSidebar() {
    const isHidden = sidebarWrapper.classList.contains("-translate-x-full");

    if (isHidden) {
      // Open
      sidebarWrapper.classList.remove("-translate-x-full");
      sidebarOverlay.classList.remove("hidden");
    } else {
      // Close
      sidebarWrapper.classList.add("-translate-x-full");
      sidebarOverlay.classList.add("hidden");
    }
  }

  sidebarToggle.addEventListener("click", toggleSidebar);
  sidebarOverlay.addEventListener("click", toggleSidebar);

  // Hide sidebar when a menu link is clicked (mobile only)
  sidebarMenu.addEventListener("click", (e) => {
    const link = e.target.closest("a");
    if (!link) return; // only proceed if a link is clicked

    if (window.innerWidth < 1024) {
      // mobile breakpoint
      sidebarWrapper.classList.add("-translate-x-full");
      sidebarOverlay.classList.add("hidden");
    }
  });

  // Optional: reset sidebar visibility on window resize
  window.addEventListener("resize", () => {
    if (window.innerWidth >= 1024) {
      sidebarWrapper.classList.remove("-translate-x-full");
      sidebarOverlay.classList.add("hidden");
    } else {
      sidebarWrapper.classList.add("-translate-x-full");
    }
  });
});
