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

    <!-- Styles -->
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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            padding: 20px;
            text-align: center;
        }

        .content {
            max-width: 800px;
            margin: 0 auto;
        }

        .content h1 {
            font-size: 3rem;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .content h1 span {
            color: var(--primary);
        }

        .cta {
            margin-top: 1rem;
            display: inline-block;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            background-color: var(--primary);
            color: #fff;
            border-radius: 0.5rem;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .cta:hover {
            background-color: #281a08;
        }

        a {
            color: #fff;
        }

        /* Dropdown Styles */
        select {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            font-size: 1.2rem;
            border-radius: 0.5rem;
            border: 1px solid var(--primary);
            background-color: var(--bg);
            color: #fff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        select:hover {
            background-color: #281a08;
        }

        /* Warning Text Styles */
        .warning-text {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #ffdddd;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Hero Section start -->
    <section class="hero" id="home">
        <div class="content">
            <h1>Pilih Kriteria <span>Harga</span> Mu</h1>
            <select id="harga-dropdown">
                <option value="terjangkau">Terjangkau (Rp 10.000 - Rp 30.000)</option>
                <option value="standar">Standar Normal (Rp 31.000 - Rp 40.000)</option>
                <option value="mahal">Mahal (Rp 41.000 - Rp 100.000)</option>
            </select>
             <!-- Warning Text -->
             <div class="warning-text">
                *Harga bisa berubah pada coffee shop.
            </div>

            <h1>Pilih Kriteria <span>Lokasi</span> Mu</h1>
            <select id="lokasi-dropdown">
                <option value="pusat">Pusat Kota (Kota Tegal)</option>
                <option value="pinggir">Pinggir Kota (Kab. Tegal)</option>
            </select>

            <h1>Pilih Kriteria <span>Variasi Menu</span> Mu</h1>
            <select id="menu-dropdown">
                <option value="sangat-lengkap">Sangat Lengkap (51-100 Menu)</option>
                <option value="lengkap">Lengkap (31-50 Menu)</option>
                <option value="kurang-lengkap">Kurang Lengkap (10-30 Menu)</option>
            </select>

            <h1>Pilih Kriteria <span>Jam Operasional</span> Mu</h1>
            <select id="jam-dropdown">
                <option value="24-jam">24 Jam</option>
                <option value="pagi-malam">Pagi-Malam</option>
                <option value="siang-malam">Siang-Malam</option>
            </select>

            <!-- Call to Action Button -->
            <div class="cta">
                <a href="{{ route('kriteria3') }}">Submit</a>
            </div>


        </div>
    </section>
    <!-- Hero Section end -->

    <!-- Feather Icons Init -->
    <script>
        feather.replace()
    </script>
</body>
</html>
