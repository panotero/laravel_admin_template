function loadSampleSlides() {
  const slidesContainer = document.getElementById("pdfSlide");
  slidesContainer.innerHTML = "";

  for (let i = 1; i <= 5; i++) {
    const slide = `
      <li class="glide__slide flex justify-center">
        <div class="flex flex-col items-center bg-white rounded-2xl shadow-lg p-6 max-w-4xl w-full">
          <h1 class="text-3xl font-bold text-black">Slide ${i}</h1>
        </div>
      </li>
    `;
    slidesContainer.insertAdjacentHTML("beforeend", slide);
  }

  if (window.pdfGlide) window.pdfGlide.destroy();

  window.pdfGlide = new Glide(".glide-parent", {
    type: "carousel",
    perView: 1,
    focusAt: "center",
    gap: 20,
    autoplay: 0,
    hoverpause: true,
  });

  window.pdfGlide.mount();

  // Hook up navigation
  document
    .querySelector(".parent-prev")
    .addEventListener("click", () => pdfGlide.go("<"));
  document
    .querySelector(".parent-next")
    .addEventListener("click", () => pdfGlide.go(">"));
}

window.loadSampleSlides = loadSampleSlides;
