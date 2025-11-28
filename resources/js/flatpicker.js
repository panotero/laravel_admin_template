window.initDatePickers = function () {
  const datepickers = document.querySelectorAll(".datetimepicker");
  if (!datepickers.length) return;

  datepickers.forEach((el) => {
    // Avoid re-initializing if already initialized
    if (!el._flatpickr) {
      flatpickr(el, {
        dateFormat: "d-m-Y",
        allowInput: false,
      });
    }
  });
};
