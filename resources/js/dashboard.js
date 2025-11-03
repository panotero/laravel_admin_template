// // resources/js/dashboard.js

// document.addEventListener("DOMContentLoaded", () => {
//   // Fetch nav menus dynamically
//   fetch("/landwise_live/api/nav_menus", {
//     headers: {
//       Accept: "application/json",
//       Authorization: "Bearer " + window.apiToken, // inject via Blade
//     },
//   })
//     .then((res) => res.json())
//     .then((menus) => {
//       const sidebar = document.getElementById("sidebar-menu");
//       let firstMenu = null; // store dashboard or first menu

//       menus.forEach((menu) => {
//         let btn = document.createElement("button");
//         btn.className =
//           "w-full text-left px-3 py-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 flex items-center gap-2";
//         btn.innerHTML = `<i class="${menu.icon}"></i> ${menu.title}`;
//         btn.onclick = () => loadPage(menu);
//         sidebar.appendChild(btn);
//         // If it's Dashboard, mark it as firstMenu
//         if (menu.title.toLowerCase() === "dashboard") {
//           firstMenu = menu;
//         }
//       });

//       // Load Dashboard by default (or fallback to first menu)
//       if (firstMenu) {
//         loadPage(firstMenu);
//       } else if (menus.length > 0) {
//         loadPage(menus[0]);
//       }
//     });

//   function loadPage(menu) {
//     document.getElementById("page-title").textContent = menu.title;

//     fetch(menu.link, {
//       headers: { Accept: "application/json" },
//     })
//       .then((res) => res.text())
//       .then((data) => {
//         document.getElementById(
//           "content"
//         ).innerHTML = `<div class="p-4 bg-white dark:bg-gray-800 rounded shadow">${data}</div>`;
//       })
//       .catch(() => {
//         document.getElementById(
//           "content"
//         ).innerHTML = `<div class="p-4 bg-red-200 text-red-800 rounded">Failed to load ${menu.title}</div>`;
//       });
//   }
// });
document.addEventListener("DOMContentLoaded", () => {
  let lastTouchEnd = 0;

  // resources/js/disableZoom.js
  document.addEventListener("gesturestart", function (e) {
    e.preventDefault(); //block pinch zoom
  });

  document.addEventListener("dblclick", function (e) {
    e.preventDefault(); //block double-tap zoom
  });
});

// // resources/js/dashboard-graph.js
// import Chart from "chart.js/auto";

// document.addEventListener("DOMContentLoaded", () => {
//   const ctx = document.getElementById("fileGraph");
//   const select = document.getElementById("graph-range");

//   if (!ctx) return;

//   // sample datasets for week / month / year
//   const sample = {
//     week: {
//       labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
//       data: [5, 8, 12, 6, 9, 7, 4],
//     },
//     month: {
//       labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
//       data: [20, 35, 50, 25],
//     },
//     year: {
//       labels: [
//         "Jan",
//         "Feb",
//         "Mar",
//         "Apr",
//         "May",
//         "Jun",
//         "Jul",
//         "Aug",
//         "Sep",
//         "Oct",
//         "Nov",
//         "Dec",
//       ],
//       data: [100, 120, 90, 150, 130, 140, 120, 110, 115, 125, 130, 140],
//     },
//   };

//   // chart config
//   const chart = new Chart(ctx, {
//     type: "line",
//     data: {
//       labels: sample.week.labels,
//       datasets: [
//         {
//           label: "File activity",
//           data: sample.week.data,
//           fill: true,
//           tension: 0.35,
//           borderWidth: 2,
//           pointRadius: 3,
//           // subtle styling for dark theme (these are visible only for readability)
//           backgroundColor: "rgba(255,255,255,0.06)",
//           borderColor: "rgba(255,255,255,0.9)",
//           pointBackgroundColor: "rgba(255,255,255,0.95)",
//         },
//       ],
//     },
//     options: {
//       plugins: {
//         legend: { display: false },
//         tooltip: {
//           mode: "index",
//           intersect: false,
//           backgroundColor: "rgba(20,20,20,0.95)",
//           titleColor: "#fff",
//           bodyColor: "#fff",
//         },
//       },
//       maintainAspectRatio: false,
//       scales: {
//         x: {
//           grid: { display: false, color: "rgba(255,255,255,0.03)" },
//           ticks: { color: "rgba(255,255,255,0.8)" },
//         },
//         y: {
//           beginAtZero: true,
//           grid: { color: "rgba(255,255,255,0.03)" },
//           ticks: { color: "rgba(255,255,255,0.8)" },
//         },
//       },
//     },
//   });

//   // range switch handler
//   select.addEventListener("change", (e) => {
//     const val = e.target.value;
//     if (val === "month") {
//       chart.data.labels = sample.month.labels;
//       chart.data.datasets[0].data = sample.month.data;
//     } else if (val === "year") {
//       chart.data.labels = sample.year.labels;
//       chart.data.datasets[0].data = sample.year.data;
//     } else {
//       chart.data.labels = sample.week.labels;
//       chart.data.datasets[0].data = sample.week.data;
//     }
//     chart.update();
//   });
// });
