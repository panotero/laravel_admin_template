<div class="max-w-7xl mx-auto h-screen ">
    <button id="openModalBtn" class="py-3 px-5 bg-blue-600 text-white rounded-md mb-5">New Property</button>
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden  min-h-96">
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Property Name</th>
                        <th class="px-4 py-2 text-left">Address</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Price</th>
                        <th class="px-4 py-2 text-left">Full Details Link</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody id="listingTableBody" class="text-black"></tbody>
            </table>
        </div>
    </div>

    <div id="listingDetailsModal"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
            <h2 class="text-xl font-semibold mb-4">Edit Listing</h2>

            <label class="block text-sm font-medium">Property Name</label>
            <input id="modalPropertyName" class="w-full border rounded px-2 py-1 mb-2" />

            <label class="block text-sm font-medium">Address</label>
            <input id="modalAddress" class="w-full border rounded px-2 py-1 mb-2" />

            <label class="block text-sm font-medium">Description</label>
            <textarea id="modalDescription" class="w-full border rounded px-2 py-1 mb-2"></textarea>

            <label class="block text-sm font-medium">Price</label>
            <input id="modalPrice" class="w-full border rounded px-2 py-1 mb-2" />

            <label class="block text-sm font-medium">Full Details Link</label>
            <input id="modalLink" class="w-full border rounded px-2 py-1 mb-2" />

            <label class="block text-sm font-medium">Status</label>
            <select id="modalStatus" class="w-full border rounded px-2 py-1 mb-4">
                <option value="Active">Active</option>
                <option value="Pending">Pending</option>
                <option value="Sold">Sold</option>
            </select>

            <div>
                <h3 class="text-sm font-medium mb-2">Photos</h3>
                <div id="imageList" class="flex flex-wrap gap-2"></div>
            </div>

            <button id="saveChangesBtn" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hidden">
                Save Changes
            </button>

            <button id="closepropertymodal"
                class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl">✕</button>
        </div>
    </div>
    <!-- Modal backdrop -->
    <div id="listingModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50"
        aria-hidden="true" role="dialog" aria-modal="true">
        <!-- Modal panel -->
        <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl mx-4 md:mx-0 overflow-hidden">
            <header class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Create Listing</h3>
                <button id="closeModalBtn" class="text-gray-500 hover:text-gray-800"
                    aria-label="Close modal">&times;</button>
            </header>

            <form id="listingForm" class="px-6 py-4" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Inputs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Property Name</label>
                        <input type="text" name="propertyName" id="propertyName" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="text" name="price" id="price" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <input type="text" name="address" id="address" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Full Details Link</label>
                        <input type="url" name="link" id="link" placeholder="https://example.com"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="Active">Active</option>
                            <option value="Pending">Pending</option>
                            <option value="Sold">Sold</option>
                        </select>
                    </div>
                </div>

                <!-- Drag & Drop area -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Images</label>

                    <div id="dropzone"
                        class="relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-md bg-gray-50 text-center cursor-pointer"
                        tabindex="0" aria-label="File dropzone. Click or drop images here.">
                        <input id="fileInput" type="file" name="images[]" accept="image/*" multiple
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                        <div class="pointer-events-none">
                            <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">Drag & drop images here, or click to select</p>
                            <p class="text-xs text-gray-400 mt-1">You can add multiple images. New uploads will be
                                appended to the current selection.</p>
                        </div>
                    </div>

                    <div class="mt-3 flex gap-3">
                        <button id="clearSelectionBtn" type="button"
                            class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200">Clear Selection</button>
                        <div id="imageCount" class="text-sm text-gray-600 self-center">0 images selected</div>
                    </div>
                </div>

                <!-- Preview carousel -->
                <div class="mt-6">
                    <div id="carouselContainer" class="hidden">
                        <div class="relative">
                            <div id="carouselSlides"
                                class="h-56 rounded-md overflow-hidden flex items-center justify-center bg-gray-100">
                                <!-- Image slides inserted here by JS -->
                            </div>

                            <!-- Prev / Next -->
                            <button id="prevBtn" type="button"
                                class="absolute left-2 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 shadow hover:bg-gray-50"
                                aria-label="Previous image">
                                ‹
                            </button>
                            <button id="nextBtn" type="button"
                                class="absolute right-2 top-1/2 -translate-y-1/2 bg-white rounded-full p-2 shadow hover:bg-gray-50"
                                aria-label="Next image">
                                ›
                            </button>
                        </div>

                        <!-- Thumbnails -->
                        <div id="carouselThumbs" class="mt-3 flex gap-2 overflow-x-auto py-2">
                            <!-- thumbnails inserted here -->
                        </div>
                    </div>
                </div>

                <!-- Form actions -->
                <div class="mt-6 flex items-center justify-end gap-3 border-t pt-4">
                    <button type="button" id="cancelBtn"
                        class="px-4 py-2 rounded border border-gray-200">Cancel</button>
                    <button type="submit" id="submitBtn" class="px-4 py-2 rounded bg-blue-600 text-white">Save
                        Listing</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Optional: small toast / message area -->
    <div id="toast" class="fixed bottom-6 right-6 hidden bg-green-600 text-white px-4 py-2 rounded shadow">Saved
    </div>


</div>

<!-- Include script after page loads (or place in a dedicated JS file) -->
<script>
    (function() {
        // Elements
        const openModalBtn = document.getElementById('openModalBtn');
        const listingModal = document.getElementById('listingModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('fileInput');
        const clearSelectionBtn = document.getElementById('clearSelectionBtn');
        const imageCount = document.getElementById('imageCount');
        const carouselContainer = document.getElementById('carouselContainer');
        const carouselSlides = document.getElementById('carouselSlides');
        const carouselThumbs = document.getElementById('carouselThumbs');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const listingForm = document.getElementById('listingForm');
        const toast = document.getElementById('toast');
        const submitBtn = document.getElementById('submitBtn');
        const closepropertymodal = document.getElementById('closepropertymodal')

        // Data stores
        let files = []; // actual File objects
        let previews = []; // { url, name, id }
        let currentIndex = 0;

        // Helpers
        function showModal() {
            listingModal.classList.remove('hidden');
            listingModal.classList.add('flex');
        }

        function hideModal() {
            listingModal.classList.add('hidden');
            listingModal.classList.remove('flex');
            // optional: reset form if you want
            // listingForm.reset();
            // clearAllFiles();
        }

        function updateImageCount() {
            imageCount.textContent = `${files.length} image${files.length !== 1 ? 's' : ''} selected`;
            carouselContainer.classList.toggle('hidden', files.length === 0);
        }

        function addFiles(newFiles) {
            // Accept only image files
            const imageFiles = Array.from(newFiles).filter(f => f.type && f.type.startsWith('image/'));
            if (!imageFiles.length) return;

            // Append to files
            imageFiles.forEach(f => {
                files.push(f);
                const id = cryptoRandomId();
                const reader = new FileReader();
                reader.onload = (e) => {
                    previews.push({
                        id,
                        url: e.target.result,
                        name: f.name
                    });
                    renderCarousel();
                    updateImageCount();
                };
                reader.readAsDataURL(f);
            });
        }

        function clearAllFiles() {
            files = [];
            previews = [];
            currentIndex = 0;
            renderCarousel();
            updateImageCount();
        }

        function cryptoRandomId() {
            return Math.random().toString(36).slice(2, 9);
        }

        // Drag & drop handlers
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-blue-400', 'bg-white');
        });
        dropzone.addEventListener('dragleave', (e) => {
            dropzone.classList.remove('border-blue-400', 'bg-white');
        });
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-blue-400', 'bg-white');
            addFiles(e.dataTransfer.files);
        });

        // Click to choose handled by file input (already overlayed)
        fileInput.addEventListener('change', (e) => {
            addFiles(e.target.files);
            // clear file input so selecting the same file again still triggers change
            fileInput.value = null;
        });

        // Accessibility: allow Enter to trigger file input
        dropzone.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                fileInput.click();
            }
        });

        // Clear selection
        clearSelectionBtn.addEventListener('click', () => {
            clearAllFiles();
        });

        // Carousel render & controls
        function renderCarousel() {
            // slides
            carouselSlides.innerHTML = '';
            carouselThumbs.innerHTML = '';

            previews.forEach((p, i) => {
                const slide = document.createElement('div');
                slide.className = 'flex-shrink-0 w-full h-full flex items-center justify-center';
                slide.style.display = (i === currentIndex) ? 'flex' : 'none';

                const img = document.createElement('img');
                img.src = p.url;
                img.alt = p.name;
                img.className = 'object-contain max-h-full';
                slide.appendChild(img);
                carouselSlides.appendChild(slide);

                // thumbnail
                const thumb = document.createElement('button');
                thumb.className = 'w-20 h-14 rounded overflow-hidden border';
                thumb.style.flex = '0 0 auto';
                thumb.title = p.name;
                const timg = document.createElement('img');
                timg.src = p.url;
                timg.alt = p.name;
                timg.className = 'w-full h-full object-cover';
                thumb.appendChild(timg);

                thumb.addEventListener('click', () => {
                    currentIndex = i;
                    renderCarousel();
                });

                carouselThumbs.appendChild(thumb);
            });

            // if no previews, hide container
            carouselContainer.classList.toggle('hidden', previews.length === 0);
        }

        prevBtn.addEventListener('click', () => {
            if (!previews.length) return;
            currentIndex = (currentIndex - 1 + previews.length) % previews.length;
            renderCarousel();
        });
        nextBtn.addEventListener('click', () => {
            if (!previews.length) return;
            currentIndex = (currentIndex + 1) % previews.length;
            renderCarousel();
        });

        // Open/close modal
        openModalBtn.addEventListener('click', showModal);
        closeModalBtn.addEventListener('click', hideModal);
        closepropertymodal.addEventListener('click', closeDetailsModal);
        cancelBtn.addEventListener('click', (e) => {
            e.preventDefault();
            hideModal();
        });

        // Submit form via fetch with FormData (includes images)
        listingForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';

            const formData = new FormData();
            formData.append('propertyName', document.getElementById('propertyName').value);
            formData.append('address', document.getElementById('address').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('price', document.getElementById('price').value);
            formData.append('link', document.getElementById('link').value);
            formData.append('status', document.getElementById('status').value);

            // Append each selected file as images[]
            files.forEach((file) => {
                if (file instanceof File) {
                    formData.append('images[]', file, file.name);
                } else {
                    console.warn('❌ Skipping invalid file:', file);
                }
            });


            const token =
                document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ||
                document.querySelector('input[name="_token"]').value;

            try {
                const res = await fetch("{{ route('listings.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    body: formData,
                    credentials: 'same-origin'
                });

                const data = await res.json();

                if (!res.ok) {
                    throw new Error(data.message || 'Upload failed');
                }

                showToast('Listing saved successfully!');
                listingForm.reset();
                clearAllFiles();
                hideModal();
            } catch (err) {
                console.error('Error uploading listing:', err);
                alert('Error: ' + err.message);
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Save Listing';
            }
        });


        function showToast(msg = 'Saved') {
            toast.textContent = msg;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 2500);
        }


        // Fetch and display all listings
        function loadListings() {
            fetch(`${window.APP_URL}/api/listings`)
                .then(response => response.json())
                .then(data => {
                    const tableBody = document.querySelector('#listingTableBody');
                    tableBody.innerHTML = ''; // clear table

                    data.forEach(listing => {
                        const row = document.createElement('tr');
                        row.classList.add('cursor-pointer', 'hover:bg-gray-100');
                        row.dataset.id = listing.id;

                        row.innerHTML = `
                    <td class="px-4 py-2">${listing.id}</td>
                    <td class="px-4 py-2">${listing.property_name}</td>
                    <td class="px-4 py-2">${listing.address}</td>
                    <td class="px-4 py-2">${listing.description}</td>
                    <td class="px-4 py-2">${listing.price}</td>
                    <td class="px-4 py-2"><a href="${listing.link}" target="_blank" class="text-blue-600 underline">${listing.link ?? ''}</a></td>
                    <td class="px-4 py-2">${listing.status}</td>
                `;

                        // click to show details modal
                        row.addEventListener('click', () => openDetailsModal(listing.id));

                        tableBody.appendChild(row);
                    });
                })
                .catch(err => console.error('Error loading listings:', err));
        }
        let deletedImages = []; // track deleted image paths
        let currentListingId = null;

        // Open modal and fetch listing
        function openDetailsModal(id) {
            currentListingId = id;
            deletedImages = [];

            fetch(`${window.APP_URL}/api/listings/${id}`)
                .then(res => res.json())
                .then(listing => {
                    // Populate inputs
                    document.getElementById('modalPropertyName').value = listing.property_name;
                    document.getElementById('modalAddress').value = listing.address;
                    document.getElementById('modalDescription').value = listing.description;
                    document.getElementById('modalPrice').value = listing.price;
                    document.getElementById('modalLink').value = listing.link;
                    document.getElementById('modalStatus').value = listing.status;

                    // Populate images
                    const imageContainer = document.getElementById('imageList');
                    imageContainer.innerHTML = '';

                    let images = listing.images;

                    // Make sure `images` is an array
                    if (typeof images === 'string') {
                        try {
                            images = JSON.parse(images);
                        } catch (e) {
                            images = [];
                        }
                    } else if (!Array.isArray(images)) {
                        images = [];
                    }

                    if (images.length) {
                        images.forEach((imgPath, index) => {
                            const card = document.createElement('div');
                            card.className = 'relative w-28 h-28 border rounded overflow-hidden shadow';
                            card.setAttribute('data-img', imgPath);
                            card.innerHTML = `
            <img src="${window.APP_URL}/public/${imgPath}" class="object-cover w-full h-full" />
            <button
                type="button"
                data-img="${window.APP_URL}/public/${imgPath}"
                id="deleteBtn-${index}"
                class="delete-image-btn absolute top-0 right-0 bg-red-500 text-white text-xs px-1.5 py-0.5 rounded-bl hover:bg-red-700">
                ✕
            </button>
        `;
                            imageContainer.appendChild(card);
                        });
                    }


                    document.getElementById('listingDetailsModal').classList.remove('hidden');
                });
        }

        // Handle delete clicks via event delegation
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('delete-image-btn')) {
                const path = e.target.getAttribute('data-img');

                if (!deletedImages.includes(path)) {
                    deletedImages.push(path);
                    const card = e.target.closest('[data-img]');
                    if (card) card.classList.add('opacity-40'); // visually mark as deleted
                }

                document.getElementById('saveChangesBtn').classList.remove('hidden');
            }
        });

        // Close modal
        document.getElementById('closepropertymodal').addEventListener('click', () => {
            document.getElementById('listingDetailsModal').classList.add('hidden');
        });

        // Event listener for Save Changes button
        document.addEventListener('click', function(e) {
            if (e.target && e.target.id === 'saveChangesBtn') {
                saveListingChanges();
            }
        });

        // Save Listing Changes
        function saveListingChanges() {
            if (!currentListingId) return;

            const payload = {
                property_name: document.getElementById('modalPropertyName').value,
                address: document.getElementById('modalAddress').value,
                description: document.getElementById('modalDescription').value,
                price: document.getElementById('modalPrice').value,
                link: document.getElementById('modalLink').value,
                status: document.getElementById('modalStatus').value,
                deleted_images: deletedImages,
            };


            fetch(`${window.APP_URL}/api/listings/${currentListingId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Listing updated successfully!');
                        document.getElementById('listingDetailsModal').classList.add('hidden');
                        deletedImages = [];

                        // Hide save button again
                        document.getElementById('saveChangesBtn').classList.add('hidden');

                        // Optional: refresh listings
                        if (typeof fetchListings === 'function') fetchListings();
                    }
                })
                .catch(err => console.error('Save failed:', err));
        }



        // Close modal
        function closeDetailsModal() {
            document.querySelector('#listingDetailsModal').classList.add('hidden');
            deletedImages = [];
        }

        // Initialize state
        updateImageCount();
        renderCarousel();
        loadListings();

    })();
</script>
