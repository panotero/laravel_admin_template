let allNotificationIds = []; // store all IDs
let lastUnreadCount = 0;
const NotifContainer = document.getElementById("notifcount");
const notifIcon = document.getElementById("notificationIcon"); // icon you click

function initNotificationStream() {
  const evtSource = new EventSource("/api/notifications/stream");
  evtSource.onmessage = function (event) {
    const notifications = JSON.parse(event.data);

    // Count UNREAD notifications
    const unreadCount = notifications.filter((n) => n.is_read === false).length;
    if (unreadCount <= 0) {
      NotifContainer.classList.add("hidden");
    } else {
      NotifContainer.classList.remove("hidden");
    }
    // console.log(unreadCount);

    // Update the counter display
    NotifContainer.textContent = unreadCount > 0 ? unreadCount : "";
    // Save all notification IDs
    allNotificationIds = notifications.map((n) => n.id);

    // Convert backend data to JS array format you want
    const notificationsArray = notifications.map((item) => ({
      id: item.id,
      message: item.message,
      documentControlNumber: item.document?.document_control_number || null,
      created_at: item.created_at,
      is_read: item.is_read,
    }));
    // 🔥 Only call getDocs() if unread count changed
    if (unreadCount !== lastUnreadCount) {
      //   console.log(
      //     "Notification count changed:",
      //     lastUnreadCount,
      //     "→",
      //     unreadCount
      //   );

      if (typeof window.getDocs === "function") {
        window.getDocs();
      } else {
        console.warn("getDocs() not available yet.");
      }

      // Update tracker
      lastUnreadCount = unreadCount;
    }

    // Populate your UI list if needed
    populateNotifications(notificationsArray);
  };

  evtSource.onerror = (err) => {
    // console.error("SSE error:", err);
  };
  // Mark all as read when notification icon is clicked
  notifIcon.addEventListener("click", async () => {
    if (allNotificationIds.length === 0) return;

    try {
      //   console.log("icon button clicked");
      const res = await fetch("/api/notifications/mark-read", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            .content,
        },
        body: JSON.stringify({ ids: allNotificationIds }),
      });

      if (res.ok) {
        // reset unread counter
        NotifContainer.textContent = "";

        NotifContainer.classList.add("hidden");
      } else {
        console.error("Failed to mark notifications as read.");
      }
    } catch (err) {
      console.error(err);
    }
  });
}

function populateNotifications(notificationsArray) {
  const container = document.getElementById("notificationsContainer");
  if (!container) return;

  container.innerHTML = ""; // clear existing
  const additionalMessage = "";

  notificationsArray.forEach((notification) => {
    const li = document.createElement("div");

    li.className =
      "cursor-pointer px-4 py-3 border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600";

    li.dataset.documentControlNumber = notification.documentControlNumber;

    li.innerHTML = `
  <div class="flex items-start space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
      <!-- Icon/avatar -->

      <!-- Notification content -->
      <div class="flex-1 min-w-0">
          <p class="text-sm text-gray-800 dark:text-gray-200 font-medium">
              ${formatNotificationMessage(notification.message)}
          </p>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
              ${formatTimestamp(notification.created_at)}
          </p>
      </div>
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
  //   console.log(msg);

  if (msg.includes("uploaded")) return "Uploaded a file";
  if (msg.includes("approval")) {
    return "Routed a document for your approval";
  } else if (msg.includes("routed")) {
    return "Routed a document to you";
  }
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
