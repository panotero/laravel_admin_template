// Import PDF.js
import * as pdfjsLib from "pdfjs-dist/legacy/build/pdf";

// Worker
pdfjsLib.GlobalWorkerOptions.workerSrc = "/js/pdf.worker.min.js";

/* ---------------------------------------------
 * BUILD HTML <li> SLIDE FROM IMAGE SRC
 * --------------------------------------------- */
function buildSlideHTML(imgSrc) {
  return `
    <li class="glide__slide flex items-center justify-center bg-gray-100">
      <img src="${imgSrc}" class="max-h-[80vh] w-auto object-contain rounded-xl">
    </li>
  `;
}

/* ---------------------------------------------
 * LOAD SLIDES (accepts array of HTML strings)
 * --------------------------------------------- */
function loadSlidesFromArray(slides = []) {
  const slideContainer = document.getElementById("glideSlides");
  const loadingOverlay = document.getElementById("galleryLoading");

  slideContainer.innerHTML = "";
  loadingOverlay.classList.remove("hidden");

  slides.forEach((slideHTML) => {
    slideContainer.insertAdjacentHTML("beforeend", slideHTML);
  });

  initGlide();

  // hide loader
  loadingOverlay.classList.add("hidden");
}

/* ---------------------------------------------
 * GLIDE INITIALIZER (safe for SPA)
 * --------------------------------------------- */
let glideInstance = null;

window.initGlide = function initGlide() {
  if (glideInstance) glideInstance.destroy();

  glideInstance = new Glide("#galleryGlide", {
    type: "slider",
    focusAt: "center",
    perView: 1,
    gap: 10,
    hoverpause: true,
  });

  glideInstance.mount();

  document
    .querySelector(".slide-previous")
    .addEventListener("click", () => glideInstance.go("<"));

  document
    .querySelector(".slide-next")
    .addEventListener("click", () => glideInstance.go(">"));
};

/* ---------------------------------------------
 * EXTRACT IMAGES FROM PDF AND RETURN SLIDE HTML
 * --------------------------------------------- */
async function extractPdfImages(pdfUrl, scale = 1.5) {
  const pdf = await pdfjsLib.getDocument(pdfUrl).promise;

  const slideElements = [];

  for (let i = 1; i <= pdf.numPages; i++) {
    const page = await pdf.getPage(i);
    const viewport = page.getViewport({ scale });

    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");

    canvas.width = viewport.width;
    canvas.height = viewport.height;

    await page.render({
      canvasContext: context,
      viewport,
    }).promise;

    // Convert PDF page to data URL image
    const imgSrc = canvas.toDataURL("image/png");

    // Convert to <li> slide html
    slideElements.push(buildSlideHTML(imgSrc));
  }

  return slideElements;
}

/* Expose to global for SPA */
window.extractPdfImages = extractPdfImages;
window.loadSlidesFromArray = loadSlidesFromArray;
