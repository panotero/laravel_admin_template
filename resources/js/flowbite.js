// flowbiteInit.js

function initFlowbite() {
  if (typeof window.Flowbite === "undefined") {
    // Dynamically load Flowbite JS if not already loaded
    const script = document.createElement("script");
    script.src =
      "https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js";
    script.defer = true;
    script.onload = () => {
      console.log("Flowbite JS loaded");
    };
    document.head.appendChild(script);
  } else {
    // If already loaded, you can re-initialize components if needed
    console.log("Flowbite already loaded");
  }
}

window.initFlowbite = initFlowbite;
