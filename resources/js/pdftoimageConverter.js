function loadSlidesFromArray(slideTexts = []) {
  const slidesContainer = document.getElementById("pdfSlide");
  if (!slidesContainer) return; // exit if content area not loaded yet

  // Clear previous slides
  slidesContainer.innerHTML = "";

  // Build slides
  slideTexts.forEach((text) => {
    const slideHTML = `
      <li class="glide__slide flex items-center justify-center h-64 bg-gray-100 rounded-xl shadow-md">
        <h1 class="text-3xl font-bold text-black">${text}</h1>
      </li>
    `;
    slidesContainer.insertAdjacentHTML("beforeend", slideHTML);
  });

  // Destroy previous instance if exists
  if (window.pdfGlide) {
    window.pdfGlide.destroy();
    window.pdfGlide = null;
  }

  // Initialize Glide
  window.pdfGlide = new Glide(".glide-parent", {
    type: "carousel",
    perView: 1,
    focusAt: "center",
    gap: 20,
    autoplay: 2000,
    hoverpause: true,
  });

  window.pdfGlide.mount();

  // Remove previous listeners by cloning buttons
  const prevBtn = document.querySelector(".parent-prev");
  const nextBtn = document.querySelector(".parent-next");

  if (prevBtn && nextBtn) {
    prevBtn.replaceWith(prevBtn.cloneNode(true));
    nextBtn.replaceWith(nextBtn.cloneNode(true));

    // Re-select buttons
    const newPrevBtn = document.querySelector(".parent-prev");
    const newNextBtn = document.querySelector(".parent-next");

    newPrevBtn.addEventListener("click", () => window.pdfGlide.go("<"));
    newNextBtn.addEventListener("click", () => window.pdfGlide.go(">"));
  }
}

window.loadSlidesFromArray = loadSlidesFromArray;
