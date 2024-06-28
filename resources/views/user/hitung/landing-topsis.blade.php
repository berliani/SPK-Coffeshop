<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coffe Shop Recommendation</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />


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
        background-image: url("images/bg.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        -webkit-mask-image: linear-gradient(rgba(0, 0, 0, 1) 85%, rgba(0, 0, 0, 0));
        mask-image: linear-gradient(rgba(0, 0, 0, 1) 85%, rgba(0, 0, 0, 0));
    }

    .hero .content {
        text-align: center;
        max-width: 800px; /* Optional: to limit the width of the content */
        margin: 0 auto;
        padding: 20px;
    }

    .hero .content h1 {
        font-size: 3rem;
        color: #fff;
        text-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
        line-height: 1.2;
    }

    .hero .content h1 span {
        color: var(--primary);
    }

    .hero .content .cta {
        margin-top: 1rem;
        display: inline-block;
        padding: 1rem 3rem;
        font-size: 1.4rem;
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
</style>

<body>
 <!-- Hero Section start -->
 <section class="hero" id="home">
    <div class="mask-container">
      <main class="content">
        <h1>Mau <span>Ngopi</span> Dimana Hari Ini?</h1>
        <div class="cta"><a href="{{ route('kriteria1') }}">Pilih Coffee Shop Mu</a></div>
      </main>
    </div>
  </section>
  <!-- Hero Section end -->
</body>
