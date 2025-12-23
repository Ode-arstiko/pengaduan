<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Pengaduan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oR8V+R1xk5jR0L+5xw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script> --}}
</head>
<style>
    .slider-image {
        transition: opacity 0.35s ease, transform 0.35s ease;
        opacity: 1;
        transform: translateX(0);
    }

    .slider-exit-left {
        opacity: 0;
        transform: translateX(-30px);
    }

    .slider-exit-right {
        opacity: 0;
        transform: translateX(30px);
    }

    .slider-enter {
        opacity: 1;
        transform: translateX(0);
    }
</style>


<body class="bg-gray-100 min-h-screen flex">
