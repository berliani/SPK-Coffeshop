<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coffee Shop Recommendation</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet"/>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<style>
    :root {
        --primary: #ddbf86;
        --bg: black;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-decoration: none;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: "Poppins", sans-serif;
        background-color: var(--bg);
        color: #fff;
        height: 100%;
        margin: 0;
    }

    /* Hero Section */
    .hero {
        min-height: 100vh; /* Full height of the viewport */
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        flex-direction: column; /* Stack items vertically */
        /* background-image: url("images/bg.jpg"); */
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        padding: 20px;
        text-align: center;
    }

    .hero .content {
        max-width: 800px; /* Optional: to limit the width of the content */
        margin: 0 auto;
    }

    .hero .content h1 {
        font-size: 3rem;
        color: #fff;
        text-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .hero .content h1 span {
        color: var(--primary);
    }

    .hero .content .cta {
        margin-top: 0.5rem;
        display: inline-block;
        padding: 0.5rem 1rem; /* Adjusted padding for smaller size */
        font-size: 1rem; /* Smaller font size */
        background-color: var(--primary);
        color: #fff;
        border-radius: 0.5rem;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease; /* Smooth hover effect */
    }

    .hero .content .cta:hover {
        background-color: #281a08;
    }

    a {
        color: #fff;
    }

    /* Dropdown Styles */
    .hero .content select {
        margin-top: 1rem;
        padding: 0.5rem 1rem;
        font-size: 1.2rem;
        border-radius: 0.5rem;
        border: 1px solid var(--primary);
        background-color: var(--bg);
        color: #fff;
        transition: background-color 0.3s ease, color 0.3s ease; /* Smooth hover effect */
    }

    .hero .content select:hover {
        background-color: #281a08;
    }

    /* Table Styles */
    .hero .content table {
        margin-top: 1rem;
        margin-bottom: 1rem; /* Added margin-bottom for spacing */
        width: 100%;
        border-collapse: collapse;
    }

    .hero .content table, .hero .content th, .hero .content td {
        border: 1px solid #ddd;
    }

    .hero .content th, .hero .content td {
        padding: 8px;
        text-align: left;
    }

    .hero .content th {
        background-color: var(--primary);
        color: #fff;
        text-align: center;
    }

    .hero .content td {
        background-color: rgba(255, 255, 255, 0.1);
        text-align: center;
    }

    .hero .content table {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Warning Text Styles */
    .hero .content .warning-text {
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #ffdddd;
        font-style: italic;
    }

</style>

<body>
 <!-- Hero Section start -->
 <section class="hero" id="home">
    <div class="content">
        <h1>Pilih Kriteria <span>Fasilitas</span> Mu</h1>

        <!-- Dropdown for selecting facility level -->
        <select id="facility-dropdown">
            <option value="complete">Sangat Lengkap (7-10 Fasilitas)</option>
            <option value="medium">Lengkap (4-6 Fasilitas)</option>
            <option value="basic">Kurang Lengkap (1-3 Fasilitas)</option>
        </select>

        <!-- Call to Action Button -->
        <div class="cta"><a href="{{ route('kriteria2') }}">Submit</a></div>

        <!-- Table for explaining facilities -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Fasilitas</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>WIFI</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>STOP KONTAK</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>AC</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>OUTDOOR</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>TOILET</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>SMOKING ROOM</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>HALAMAN PARKIR</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>MUSHOLLA</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>SPOT FOTO</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>PERMAINAN</td>
                </tr>
            </tbody>
        </table>

        <!-- Warning Text -->
        <div class="warning-text">
            *Urutan fasilitas ini bukan urutan pada dropdown.
        </div>
    </div>
  </section>
  <!-- Hero Section end -->
</body>
</html>
