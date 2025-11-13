function showMessage({ status = "success", message = "", duration = 3000 }) {
  const container = document.getElementById("globalMessageContainer");
  if (!container) return;

  // Status colors
  const colors = {
    success: "bg-green-500",
    error: "bg-red-500",
    warning: "bg-yellow-400",
  };
  const bgColor = colors[status] || colors.success;

  // Create toast element
  const toast = document.createElement("div");
  toast.className = `
    max-w-sm w-full text-white px-4 py-3 rounded shadow-lg pointer-events-auto
    ${bgColor}
    opacity-0 transform transition-opacity duration-300 ease-in-out mb-2
  `;
  toast.textContent = message;

  // Set position based on screen width
  if (window.innerWidth < 768) {
    container.classList.remove("bottom-4");
    container.classList.add("top-4");
  } else {
    container.classList.remove("top-4");
    container.classList.add("bottom-4");
  }

  container.appendChild(toast);

  // Trigger fade-in
  setTimeout(() => {
    toast.classList.remove("opacity-0");
    toast.classList.add("opacity-100");
  }, 10); // small delay to trigger CSS transition

  // Auto-hide after duration
  setTimeout(() => {
    toast.classList.remove("opacity-100");
    toast.classList.add("opacity-0");
    toast.addEventListener(
      "transitionend",
      () => {
        toast.remove();
      },
      { once: true }
    );
  }, duration);
}

window.showMessage = showMessage;
