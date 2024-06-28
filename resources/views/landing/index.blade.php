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
}

/* Navbar */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.4rem 7%;
  background-color: #281a08;
  border-bottom: 1px solid #2e1e0a;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 9999;
}


.navbar .navbar-logo span {
  color: var(--primary);
}

.navbar-logo {
  display: flex;
  align-items: center;
  text-decoration: none;
  font-size: 1.7rem;
  font-weight: 700;
  color: #fff;
  font-style: italic;
}

.navbar-logo .logo-image {
  height: 40px;
  margin-right: 0.2rem;
}
.navbar .navbar-nav a {
  color: #fff;
  display: inline-block;
  font-size: 1.3rem;
  margin: 0 1rem;
}

.navbar .navbar-nav a:hover {
  color: var(--primary);
}

.navbar .navbar-nav a::after {
  content: "";
  display: block;
  padding-bottom: 0.5rem;
  border-bottom: 0.1rem solid var(--primary);
  transform: scaleX(0);
  transition: 0.2s linear;
}

.navbar .navbar-nav a:hover::after {
  transform: scaleX(0.5);
}

.cta a {
  display: flex;
  align-items: center;
  color: #fff;
  text-decoration: none;
  font-size: 1.2rem;
}

.navbar .navbar-extra .cta:hover {
  background-color: #281a08;
}

.navbar .navbar-extra .cta {
  margin-top: 1rem;
  display: inline-block;
  padding: 0.5rem 2rem;
  background-color: var(--primary);
  border-radius: 0.5rem;
  box-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
}

#hamburger-menu {
  display: none;
}

/* Navbar search form */
.navbar .search-form {
  position: absolute;
  top: 100%;
  right: 7%;
  background-color: #fff;
  width: 50rem;
  height: 5rem;
  display: flex;
  align-items: center;
  transform: scaleY(0);
  transform-origin: top;
  transition: 0.3s;
}

.navbar .search-form.active {
  transform: scaleY(1);
}

.navbar .search-form input {
  height: 100%;
  width: 100%;
  font-size: 1.6rem;
  color: var(--bg);
  padding: 1rem;
}

.navbar .search-form label {
  cursor: pointer;
  font-size: 2rem;
  margin-right: 1.5rem;
  color: var(--bg);
}

/* button login register */
.btn-login-register {
        display: inline-block;
        padding: 0.5rem 1rem;
        font-size: 1.3rem;
        color: white;
        background-color: var(--primary);
        border: none;
        border-radius: 0.25rem;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s, transform 0.3s;
    }

    .btn-login-register:hover {
        background-color: var(--primary);
        transform: translateY(-2px);
    }

    .btn-login-register:focus {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }

    .btn-login-register.ml-4 {
        margin-left: 1rem;
    }
/* Hero Section */
.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  background-image: url("images/bg.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  position: relative;
  -webkit-mask-image: linear-gradient(rgba(0, 0, 0, 1) 85%, rgba(0, 0, 0, 0));
  mask-image: linear-gradient(rgba(0, 0, 0, 1) 85%, rgba(0, 0, 0, 0));
}

.hero .mask-container {
  position: absolute;
  width: 100%;
  text-align: center;
  position: fixed;
  top: 130px;
}

.hero .content h1 {
  font-size: 5em;
  color: #fff;
  text-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
  line-height: 1.2;
}

.hero .content h1 span {
  color: var(--primary);
}

.hero .content p {
  font-size: 1.8rem;
  margin-top: 1rem;
  line-height: 1.4;
  font-weight: 300;
  text-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
  mix-blend-mode: difference;
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

/* About Section */
.about,
.products,
.contact {

  padding: 8rem 7% 1.4rem;
}

.about h2,
.timeline h2,
.products h2,
.FAQ h2 {
  text-align: center;
  font-size: 2.6rem;
  margin-bottom: 3rem;
}

.about h2 span,
.timeline h2 span,
.products h2 span,
.FAQ h2 span {
  color: var(--primary);
}

.about .row {
  display: flex;
}

.about .row .about-img {
  flex: 1 1 45rem;
}
.about .row .about-img img {
  width: 100%;
  border-radius: 10%;
}

.about .row .content {
  flex: 1 1 35rem;
  padding: 0 1rem;
}

.about .row .content h3 {
  font-size: 1.8rem;
  margin-bottom: 1rem;
  color: #7c9070;
}

.about .row .content p {
  margin-bottom: 0.8rem;
  font-size: 1.5rem;
  font-weight: 300;
  line-height: 1.6;
  color: #ec8f5e;
}
.content .cta {
  margin-top: 1rem;
  display: inline-block;
  padding: 1rem 3rem;
  font-size: 1.4rem;
  background-color: var(--primary);
  border-radius: 0.5rem;
  box-shadow: 1px 1px 3px rgba(1, 1, 3, 0.5);
}
a {
  color: #fff;
}

.timeline-items{
	max-width: 1000px;
	margin:auto;
	display: flex;
	flex-wrap: wrap;
	position: relative;
}
.timeline-items::before{
	content: '';
	position: absolute;
	width: 2px;
	height: 100%;
	background-color:#fff;
	left: calc(50% - 1px);
    animation: moveline 6s linear forwards;
}
@keyframes moveline{
    0%{
        height: 0;
    }
    100%{
        height: 100%;
    }
}
.timeline-item{
	margin-bottom: 40px;
	width: 100%;
	position: relative;
}
.timeline-item:last-child{
	margin-bottom: 0;
}
.timeline-item:nth-child(odd){
    padding-right: calc(50% + 30px);
	text-align: right;
}
.timeline-item:nth-child(even){
    padding-left: calc(50% + 30px);
}
.timeline-dot{
	height: 16px;
	width: 16px;
	background-color: #eaa023;
	position: absolute;
	left: calc(50% - 8px);
	border-radius: 60%;
	top:10px;
}
.timeline-date{
	font-size: 18px;
	color: #eaa023;
	margin:6px 0 15px;
}
.timeline-content{
    background-color:var(--primary);
	padding: 30px;
	border-radius: 5px;
}
.timeline-content h3{
    font-size: 20px;
	color: #ffffff;
	margin:0 0 10px;
	text-transform: capitalize;
	font-weight: 500;
}
.timeline-content p{
    color: #281a08;
	font-size: 16px;
	font-weight: 300;
	line-height: 22px;
}

/* Products Section */
.products .row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
  gap: 1.5rem;
  margin-top: 4rem;
}

.products p {
  text-align: center;
  font-size: 1.5rem;
}

.products .product-card {
  text-align: center;
  border: 1px solid #281a08;
  padding: 2rem;
}

.products .product-icons {
  display: flex;
  justify-content: center;
  gap: 0.5rem;
}

.products .product-icons a {
  width: 4rem;
  height: 4rem;
  color: #fff;
  margin: 0.3rem;
  border: 1px solid #666;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.products .product-icons a:hover {
  background-color: var(--primary);
  border: 1px solid var(--primary);
}

.products .product-image {
  padding: 1rem 0;
}

.products .product-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.products .product-content h3 {
  font-size: 2rem;
}

.products .product-stars {
  font-size: 1.7rem;
  padding: 0.8rem;
  color: var(--primary);
}

.products .product-stars .star-full {
  fill: var(--primary);
}

.products .product-price {
  font-size: 1.3rem;
  font-weight: bold;
}

.products .product-price span {
  text-decoration: line-through;
  font-weight: lighter;
  font-size: 1rem;
}

/* FAQ Section */
.FAQ{
    padding: 8rem 7% 1.4rem;
}
.accordion {
  background-color: var(--primary);
  color: #281a08;
  cursor: pointer;
  font-size: 1.2rem;
  width: 100%;
  padding: 2rem 2.5rem;
  border: none;
  outline: none;
  transition: 0.4s;
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: bold;
}

.accordion i {
  font-size: 1.6rem;
}

.active,
.accordion:hover {
  background-color: #f1f7f5;
}
.pannel {
  padding: 0 2rem 2.5rem 2rem;
  background-color: white;
  overflow: hidden;
  background-color: #f1f7f5;
  display: none;
}
.pannel p {
  color: rgba(0, 0, 0, 0.7);
  font-size: 1.2rem;
  line-height: 1.4;
}

.faq {
  border: 1px solid rgba(0, 0, 0, 0.2);
  margin: 10px 0;
}
.faq.active {
  border: none;
}


/* Footer */
footer {
  background-color: #281a08;
  text-align: center;
  padding: 1rem 0 3rem;
  margin-top: 3rem;
}

footer .socials {
  padding: 1rem 0;
}

footer .socials a {
  color: #fff;
  margin: 1rem;
}

footer .socials a:hover,
footer .links a:hover {
  color: var(--primary);
}

footer .links {
  margin-bottom: 1.4rem;
}

footer .links a {
  color: #fff;
  padding: 0.7rem 1rem;
}

footer .credit {
  font-size: 0.8rem;
}

footer .credit a {
  color: var(--primary);
  font-weight: 700;
}

/* Media Queries */
/* Laptop */
@media (max-width: 1366px) {
  html {
    font-size: 75%;
  }
}

/* Tablet */
@media (max-width: 758px) {
  html {
    font-size: 62.5%;
  }

  #hamburger-menu {
    display: inline-block;
  }

  .navbar .navbar-nav,
  .navbar-extra .cta {
    position: absolute;
    top: 100%;
    right: -100%;
    background-color: #fff;
    width: 30rem;
    height: auto;
    padding: 2rem;
    /* height: 100vh; */
    transition: 0.3s;
  }

  .navbar .navbar-extra .cta {
    margin-top: auto;
    padding: 0.5rem 0.5rem;
    font-size: 4 rem;
    background-color: var(--primary);
    color: #fff;
    border-radius: 0.3rem;
    cursor: pointer;
  }

  .navbar .navbar-nav .cta:hover {
    background-color: var(--primary-dark);
  }
  .navbar .navbar-nav.active,
  .navbar-extra .cta.active {
    right: 0;
  }

  .navbar .navbar-nav a {
    color: var(--bg);
    display: block;
    margin: 1.5rem;
    padding: 0.5rem;
    font-size: 2rem;
  }

  .navbar .navbar-nav a::after {
    transform-origin: 0 0;
  }

  .navbar .navbar-nav a:hover::after {
    transform: scaleX(0.2);
  }

  .navbar .search-form {
    width: 90%;
    right: 2rem;
  }

}
/* Adjust for smaller screens */
@media (max-width: 768px) {
    .timeline-date {
        width: 60px;
        height: 60px;
        font-size: 16px;
    }
}

  .menu p {
    font-size: 1.2rem;
  }

  .contact .row {
    flex-wrap: wrap;
  }

  .contact .row .map {
    height: 30rem;
  }

  .contact .row form {
    padding-top: 0;
  }


/* Mobile Phone */
@media (max-width: 450px) {
  html {
    font-size: 55%;
  }
}

  </style>
  <body>
    <!-- Navbar start -->
    @include('landing.navbar')
    <!-- Navbar end -->

    <!-- Hero start -->
    @include('landing.hero')
    <!-- Hero end -->

    <!-- About Section start -->
   @include('landing.timeline')
    <!-- About Section end -->

    <!-- Coffe Shop Section start -->
    @include('landing.coffeshop')
    <!-- Coffe Shop Section end -->

    <!-- Contact Section start -->
    @include('landing.faq')
     <!-- Contact Section end -->

    <!-- Footer start -->
    @include('landing.footer')
    <!-- Footer End -->

    <!-- Feather Icons -->
    <script>
      feather.replace();
    </script>

    <!-- My Javascript -->
    <!-- JavaScript to Toggle Navbar -->
    <script>
        const hamburgerMenu = document.getElementById('hamburger-menu');
        const navbarNav = document.getElementById('navbarNav');

        hamburgerMenu.addEventListener('click', () => {
          navbarNav.classList.toggle('active');
        });


      var acc = document.getElementsByClassName("accordion");
      var i;

      for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
          this.classList.toggle("active");
          this.parentElement.classList.toggle("active");

          var pannel = this.nextElementSibling;

          if (pannel.style.display === "block") {
            pannel.style.display = "none";
          } else {
            pannel.style.display = "block";
          }
        });
      }

      </script>
  </body>
</html>
