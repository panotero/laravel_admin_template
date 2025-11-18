function initNotificationStream() {
  const evtSource = new EventSource("/api/notifications/stream");
  const NotifContainer = document.getElementById("notifcount");

  evtSource.onmessage = function (event) {
    const notifications = JSON.parse(event.data);

    // Count UNREAD notifications
    const unreadCount = notifications.filter((n) => n.is_read === false).length;

    // Update the counter display
    NotifContainer.textContent = unreadCount > 0 ? unreadCount : "";

    // Convert backend data to JS array format you want
    const notificationsArray = notifications.map((item) => ({
      id: item.id,
      message: item.message,
      documentControlNumber: item.document?.document_control_number || null,
      created_at: item.created_at,
      is_read: item.is_read,
    }));

    // Populate your UI list if needed
    populateNotifications(notificationsArray);
  };

  evtSource.onerror = (err) => {
    console.error("SSE error:", err);
  };
}

function populateNotifications(notificationsArray) {
  const container = document.getElementById("notificationsContainer");
  if (!container) return;

  container.innerHTML = ""; // clear existing

  notificationsArray.forEach((notification) => {
    const li = document.createElement("div");

    li.className =
      "cursor-pointer px-4 py-3 border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600";

    li.dataset.documentControlNumber = notification.documentControlNumber;

    li.innerHTML = `
            <div class="flex flex-col">
                <span class="text-sm text-gray-800 dark:text-gray-200 font-medium">
                    ${formatNotificationMessage(notification.message)}
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    ${formatTimestamp(notification.created_at)}
                </span>
            </div>
        `;

    // Click listener
    li.addEventListener("click", () => {
      console.log("Notification clicked:");
      console.log("Message:", notification.message);
      console.log("Control Number:", notification.documentControlNumber);
    });

    container.appendChild(li);
  });
}

function formatNotificationMessage(msg) {
  msg = msg.toLowerCase();

  if (msg.includes("uploaded")) return "Uploaded a file";
  if (msg.includes("routed")) return "Routed a file to you";
  if (msg.includes("remanded")) return "Remanded a file";
  if (msg.includes("signed")) return "Signed a file";
  if (msg.includes("approved")) return "Approved the file";
  if (msg.includes("disapproved")) return "Disapproved the file";
  if (msg.includes("3 days")) return "Document is 3 days before due";
  if (msg.includes("due today")) return "Document is due today";
  if (msg.includes("over due") || msg.includes("overdue"))
    return "Document is overdue";

  return msg;
}
function formatTimestamp(isoString) {
  const date = new Date(isoString);
  return date.toLocaleString("en-US", {
    month: "short",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  });
}

window.loadNotifications = initNotificationStream;
