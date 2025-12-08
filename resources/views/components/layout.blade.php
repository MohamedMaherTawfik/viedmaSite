@props(['title' => ''])

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Optional: Adjust text alignment for RTL */
        body[dir="rtl"] {
            text-align: right;
        }
    </style>

    <script>
        function showDropdownMenu(items, top, left) {
            console.log('Dropdown triggered');

            const existing = document.getElementById("global-dropdown");
            if (existing) existing.remove();

            const div = document.createElement("div");
            div.id = "global-dropdown";
            div.className =
                "absolute w-44 bg-white border border-blue-500 rounded-lg shadow-lg z-[9999999] text-sm p-2";
            div.style.top = `${top}px`;
            div.style.left = `${left}px`;
            div.innerHTML = items;
            document.body.appendChild(div);

            document.addEventListener("click", function removeDropdown(e) {
                if (!div.contains(e.target)) {
                    div.remove();
                    document.removeEventListener("click", removeDropdown);
                }
            });
        }
    </script>
</head>

<body class="bg-gray-100 min-h-screen flex">
    {{ $slot }}

</body>

</html>
