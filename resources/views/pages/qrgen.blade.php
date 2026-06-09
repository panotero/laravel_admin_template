<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>QR Code Generator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">

        <h1 class="text-xl font-bold mb-4">QR Code Generator</h1>

        <!-- FORM -->
        <div class="space-y-4">

            <div>
                <label class="block text-sm font-medium">URL</label>
                <input id="url" type="text" class="w-full border p-2 rounded" placeholder="https://example.com">
            </div>

            <div>
                <label class="block text-sm font-medium">Logo (optional)</label>
                <select id="img" class="w-full border p-2 rounded">
                    <option value="">Default Logo</option>
                    <option value="images/lenovologo.png">Lenovo Logo</option>
                    <option value="images/custom.png">Custom Logo</option>
                </select>
            </div>

            <button id="generateQR" class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                Generate QR
            </button>

        </div>

        <!-- RESULT -->
        <div class="mt-6 text-center">
            <img id="qrPreview" class="mx-auto border p-2 hidden">
        </div>

    </div>

    <script>
        (function() {
            document.getElementById("generateQR").addEventListener("click", async function() {

                let url = document.getElementById('url').value;

                const payload = {
                    value: url
                };

                const response = await apiCall({
                    mode: "POST",
                    isJson: true,
                    payload: payload,
                    url: "/api/qr/generate",
                    button: document.getElementById("proceedBtn"),
                });
            });
        })();
    </script>

</body>

</html>
