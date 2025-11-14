function fillOfficeDropdown() {
  const officedropdown = document.querySelectorAll(".officeSelect");

  officedropdown.forEach((officeoption) => {
    // Fetch offices
    fetch("/api/offices")
      .then((res) => res.json())
      .then((offices) => {
        officeoption.innerHTML =
          `<option value="">Select Office</option>` +
          offices
            .map(
              (o) =>
                `<option value="${o.office_name}">${o.office_name}</option>`
            )
            .join("");
      });
  });
}
function fillDocType() {
  const officedropdown = document.querySelectorAll(".docTypeSelect");

  officedropdown.forEach((officeoption) => {
    // Fetch offices
    fetch("/api/documenttypes")
      .then((res) => res.json())
      .then((offices) => {
        officeoption.innerHTML =
          `<option value="">Select Office</option>` +
          offices
            .map(
              (o) =>
                `<option value="${o.office_name}">${o.office_name}</option>`
            )
            .join("");
      });
  });
}
// Call this function on page load
async function fetchAuthUser() {
  try {
    const response = await fetch("/api/user_info", {
      headers: {
        Accept: "application/json",
      },
    });

    const data = await response.json();

    if (data.isLoggedIn) {
      // Store globally
      window.authUser = data.user;
      console.log("Authenticated user:", window.authUser);
    } else {
      window.authUser = null;
      console.log("User is not logged in");
    }
  } catch (error) {
    console.error("Failed to fetch user info:", error);
    window.authUser = null;
  }
}
fetchAuthUser();
window.fetchAuthUser = fetchAuthUser;
window.fillOfficeDropdown = fillOfficeDropdown;
