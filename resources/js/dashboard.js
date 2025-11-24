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
window.initDataTables = function initDataTables() {
  document.querySelectorAll("table").forEach((table) => {
    if (!$.fn.dataTable.isDataTable(table)) {
      $(table).DataTable({
        paging: true,
        searching: true,
        info: true,
        responsive: true,
        dom: "frtip", // include 'f' to show the search input
        stripeClasses: [""],
        language: {
          search: "",
          searchPlaceholder: "Search...",
          paginate: {
            previous: "<",
            next: ">",
          },
          info: "Showing _START_ to _END_ of _TOTAL_ entries",
        },
        createdRow: function (row, data, dataIndex) {
          $(row).css({
            "background-color": "#ffffff",
            "border-bottom": "1px solid #e0e0e0",
          });
          $(row).hover(
            function () {
              $(this).css("background-color", "#f9f9f9");
            },
            function () {
              $(this).css("background-color", "#ffffff");
            }
          );
        },
        initComplete: function () {
          // Style table header
          $(this).find("thead th").css({
            "background-color": "#f8f8f8",
            color: "#1c1c1c",
            "font-weight": "500",
            "border-bottom": "2px solid #e0e0e0",
            padding: "12px 10px",
            "text-align": "left",
          });

          // Style pagination buttons
          $(this)
            .closest(".dataTables_wrapper")
            .find(".dataTables_paginate button")
            .css({
              "background-color": "#ffffff",
              border: "1px solid #d0d0d0",
              color: "#1c1c1c",
              "border-radius": "6px",
              padding: "5px 10px",
              margin: "0 2px",
              cursor: "pointer",
            })
            .hover(
              function () {
                $(this).css("background-color", "#f0f0f0");
              },
              function () {
                $(this).css("background-color", "#ffffff");
              }
            );

          // Style search input
          $(this)
            .closest(".dataTables_wrapper")
            .find(".dataTables_filter input")
            .css({
              border: "1px solid #d0d0d0",
              "border-radius": "8px",
              padding: "6px 10px",
              "background-color": "#ffffff",
              color: "#1c1c1c",
              width: "200px",
            });
        },
      });
    }
  });
};
