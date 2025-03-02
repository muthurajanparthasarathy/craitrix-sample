<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  function cleanInput($data)
  {
    return htmlspecialchars(stripslashes(trim($data)));
  }

  $name = cleanInput($_POST['name']);
  $email = cleanInput($_POST['email']);
  $country = cleanInput($_POST['country']);
  $contactMethod = cleanInput($_POST['contact-method']);
  $phone = cleanInput($_POST['phone']);
  $message = cleanInput($_POST['message']);

  $errors = [];

  // Validation
  if (empty($name)) $errors['name'] = "Full Name is required";
  if (empty($email)) $errors['email'] = "Email is required";
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Invalid email format";
  if (empty($country)) $errors['country'] = "Country is required";
  if (empty($contactMethod)) $errors['contact-method'] = "Contact method is required";
  if (empty($phone)) $errors['phone'] = "Contact number is required";
  if (empty($message)) $errors['message'] = "Message is required";

  if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    $_SESSION['formData'] = $_POST; // Save form data to refill inputs
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }

  // Email Details
  $to = "Ram.craitrix@gmail.com"; // Change this to your email
  $subject = "New Contact Form Submission";
  $emailMessage = "
    Name: $name
    Email: $email
    Country: $country
    Contact Method: $contactMethod
    Phone: $phone
    Message: $message
    ";

  $headers = "From: $email" . "\r\n" .
    "Reply-To: $email" . "\r\n" .
    "Content-Type: text/plain; charset=UTF-8";

  // Send email
  if (mail($to, $subject, $emailMessage, $headers)) {
    $_SESSION['success'] = "Form submitted successfully! Email sent.";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  } else {
    $_SESSION['errors']['email'] = "Failed to send email.";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Craitrix</title>
  <link rel="icon" type="image/png" href="./images/logo.png">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
  <link rel="stylesheet" href="./styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="./images/logo.png" alt="Company Logo" class="company-logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav w-100 d-flex justify-content-between align-items-center">
          <li class="nav-item flex-grow-1 text-center"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item flex-grow-1 text-center"><a class="nav-link" href="#">About</a></li>
          <li class="nav-item flex-grow-1 text-center"><a class="nav-link" href="#">Services</a></li>
          <li class="nav-item flex-grow-1 text-center"><a class="nav-link" href="#">Contact</a></li>
          <li class="nav-item flex-grow-1 text-center">
            <img src="./images/whatsapp.png" alt="WhatsApp Icon" class="whatsapp-icon">
          </li>
          <li class="nav-item flex-grow-1 text-center">
            <button class="talk-btn">Let's Talk</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Banner Section -->
  <section class="banner-section">
    <div class="row w-100 m-0">
      <div class="col-lg-6 col-md-6 col-sm-12 banner-text">
        <h1 class="heading">Unleashing your digital potential with a trailblazing vision
        </h1>
        <p class="mt-4">Our tech-driven solutions turn your vision into reality across AI, Metaverse, Blockchain, and
          FinTech ecosystems.</p>
        <button class="mt-4">Get Your Free Consultation</button>
      </div>
      <div class="col-lg-6 col-sm-12 ">
        <div class="contain">
          <img src="./images/banner-bg.png" alt="">
        </div>

      </div>
    </div>
  </section>
  <section class="ChooseUs">
    <div class="container mt-5 mb-5">
      <div class="row justify-content-center">
        <div class="col-auto d-flex align-items-center  text-light rounded ctnbtn">
          <div class="border-end border-3  ">
            <img src="./images/logo.png" style="width: 50px; height: 50px;" class="m-0">
          </div>
          <div class="ms-2 ft px-4">Meet Craitrix</div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 d-flex justify-content-center">
          <img src="./images/Component 80.png" alt="AI Solutions">
        </div>
        <div class="col-lg-6">
          <h1>What Sets Us Apart</h1>

          <div class="list">
            <ul>
              <li>Craitrix brings together the energy of young minds and the wisdom of seasoned professionals to
                drive groundbreaking innovations across industries. We take pride in setting benchmarks
                wherever we work, focusing on delivering results that are future-ready, resilient, and impactful.
                Our vision is rooted</li>
            </ul>
            <button>Learn More</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Scrolling Services Section -->

  <div class="container my-4">
    <div class="row g-3">
      <div class="col-md-3 col-sm-6">
        <div class="stat-card">
          <div class="stat-count">40</div>
          <div class="stat-title">Trailblazing Professionals</div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="stat-card">
          <div class="stat-count">130</div>
          <div class="stat-title">Innovations Deployed</div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="stat-card">
          <div class="stat-count">30</div>
          <div class="stat-title">Trusted across Nations</div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="stat-card">
          <div class="stat-count">50</div>
          <div class="stat-title">Visionary clients</div>
        </div>
      </div>
    </div>
  </div>

  <section class="Services">
    <h1 class="text-center pt-4">What we do</h1>
    <div class="services-card">
      <div class="row w-100 justify-content-center">
        <!-- First row -->
        <div class="col-md-4 col-12 mb-4 d-flex justify-content-end">
          <div class="custom-card custom-firstCard">
            <div class="custom-card-body">
              <h5>Web Development</h5>
              <p>Shape your brand’s digital identity with Craitrix’s expert web development team, offering tailor-made
                solutions designed just for you. Whether it’s crafting custom web applications, launching a brand-new
                site, or giving your existing platform a complete revamp, we handle it all—from UI/UX design and backend
                development to final deployment. We’re your one-stop solution to kickstart and strengthen your digital
                presence.</p>
              <a href="#" class="custom-learn-more text-dark">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-4 d-flex justify-content-center">
          <div class="custom-card custom-lighter-card custom-secondCard">
            <div class="custom-card-body">
              <h5>Blockchain Development</h5>
              <p>Empower your business with blockchain by embedding it into your ecosystem, enhancing transparency,
                trust, and security. Our state-of-the-art solutions and seasoned blockchain developers are here to help
                you embrace next-gen technology, enabling you to lead the way into the future.</p>
              <!-- <a href="#" class="custom-learn-more text-light">Learn More <i class="fas fa-arrow-right"></i></a> -->
            </div>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-4 d-flex justify-content-start">
          <div class="custom-card custom-thirdCard">
            <div class="custom-card-body">
              <h5>Mobile App Development</h5>
              <p>Bring your business closer to your audience with our skilled mobile app development team. Whether it’s
                a native or hybrid app, we craft solutions that maximize your business’s potential and expand your reach
                online. Our focus is on creating robust, secure, and scalable applications that offer a smooth and
                engaging user experience.</p>
              <a href="#" class="custom-learn-more text-dark">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="row w-100 justify-content-center">
        <!-- Second row -->
        <div class="col-md-4 col-12 mb-4 d-flex justify-content-end">
          <div class="custom-card custom-fourthCard">
            <div class="custom-card-body">
              <h5>Managed Cloud Services</h5>
              <p>Simplify your cloud journey with our managed cloud services, covering everything from seamless
                migration to ongoing optimization. We specialize in deploying secure, scalable, and high-performance
                environments across leading platforms like AWS, Microsoft Azure, and Google Cloud. With smooth
                integration, proactive monitoring, and continuous support, we handle the tech while you focus on growing
                your business.</p>
              <!-- <a href="#" class="custom-learn-more text-light">Learn More <i class="fas fa-arrow-right"></i></a> -->
            </div>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-4 d-flex justify-content-center">
          <div class="custom-card custom-lighter-card custom-fifthCard">
            <div class="custom-card-body">
              <h5>AI Development</h5>
              <p>Drive innovation with our AI development services, designed to transform your business through
                intelligent automation and data-driven insights. We build scalable solutions, from machine learning
                models to AI-powered applications, including custom Generative AI chatbots. Harness technologies like
                NLP, computer vision, and predictive analytics to stay ahead in a rapidly evolving digital landscape.
              </p>
              <!-- <a href="#" class="custom-learn-more text-dark">Learn More <i class="fas fa-arrow-right"></i></a> -->
            </div>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-4 d-flex justify-content-start">
          <div class="custom-card custom-sixthCard">
            <div class="custom-card-body">
              <h5>Digital Marketing Services</h5>
              <p>Our digital marketing experts help amplify your online presence with data-driven strategies tailored to
                your business goals. From SEO and PPC ads to targeted digital campaigns, we focus on increasing lead
                generation and driving higher revenue. Our approach ensures maximum visibility, improved engagement, and
                measurable results.</p>
              <!-- <a href="#" class="custom-learn-more text-light">
                <span>Learn More</span>
                <i class="fas fa-arrow-right"></i>
              </a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 
  
  <section class="features">
    <div class="feature-header">
        <span class="feature-icon"><i class="fas fa-exchange-alt"></i></span>
        <span class="feature-icon"><i class="fas fa-university"></i></span>
        <span class="feature-icon"><i class="fas fa-wallet"></i></span>
        <span class="feature-icon"><i class="fas fa-robot"></i></span>
        <span class="feature-icon"><i class="fas fa-gamepad"></i></span>
        <span class="feature-icon"><i class="fas fa-palette"></i></span>
    </div>

    <div class="feature-container">
        <div class="feature-card">
            <div class="feature-left"><i class="fas fa-exchange-alt"></i> Crypto Exchange</div>
            <div class="feature-right">
                We help you build a safe and secure platform for trading various cryptocurrencies.
                <ul>
                    <li>White Label Crypto Exchange</li>
                    <li>Centralized Crypto Exchange</li>
                    <li>Decentralized Crypto Exchange</li>
                    <li>Transparency in Gameplay</li>
                </ul>
            </div>
        </div>

        <div class="feature-card">
            <div class="feature-left"><i class="fas fa-university"></i> Banking And Fintech</div>
            <div class="feature-right">
                Our banking and fintech solutions integrate cryptocurrency with financial services.
                <ul>
                    <li>Crypto payment gateway</li>
                    <li>Neobank development</li>
                    <li>Fintech app development</li>
                    <li>Smart Contract Audited</li>
                </ul>
            </div>
        </div>

        <div class="feature-card">
            <div class="feature-left"><i class="fas fa-wallet"></i> Wallet</div>
            <div class="feature-right">
                We create secure digital wallets with advanced security features.
                <ul>
                    <li>Crypto wallet</li>
                    <li>White Label Wallet</li>
                    <li>Web3 wallet</li>
                    <li>Defi Wallet</li>
                </ul>
            </div>
        </div>

        <div class="feature-card">
            <div class="feature-left"><i class="fas fa-robot"></i> Trading Bots</div>
            <div class="feature-right">
                Our trading bots use algorithms to automate buying and selling.
                <ul>
                    <li>Flash Loan Arbitrage Bot</li>
                    <li>DCA Trading Bot</li>
                    <li>Crypto Sandwich Bot</li>
                    <li>Grid Trading Bot</li>
                </ul>
            </div>
        </div>

        <div class="feature-card">
            <div class="feature-left"><i class="fas fa-gamepad"></i> Gaming</div>
            <div class="feature-right">
                We develop blockchain-based gaming solutions.
                <ul>
                    <li>Blockchain gaming</li>
                    <li>Crypto casino game development</li>
                    <li>Fantasy sports app development</li>
                    <li>Play to Earn Game Development</li>
                </ul>
            </div>
        </div>

        <div class="feature-card">
            <div class="feature-left"><i class="fas fa-palette"></i> NFT</div>
            <div class="feature-right">
                Our NFT services help users create, buy, and sell digital assets.
                <ul>
                    <li>NFT Marketplace Development</li>
                    <li>NFT Game Development</li>
                    <li>NFT Music Marketplace Development</li>
                    <li>NFT Art Marketplace Development</li>
                </ul>
            </div>
        </div>
    </div>
</section> -->

  <!-- 

  <section class="features">
    <div class="feature-header">
      <span class="feature-icon"><i class="fas fa-exchange-alt"></i></span>
      <span class="feature-icon"><i class="fas fa-university"></i></span>
      <span class="feature-icon"><i class="fas fa-wallet"></i></span>
      <span class="feature-icon"><i class="fas fa-robot"></i></span>
      <span class="feature-icon"><i class="fas fa-gamepad"></i></span>
      <span class="feature-icon"><i class="fas fa-palette"></i></span>
    </div>

    <div class="feature-container">
      <div class="feature-card">
        <div class="feature-left"><i class="fas fa-exchange-alt"></i> Crypto Exchange</div>
        <div class="feature-right">
          We help you build a safe and secure platform for trading various cryptocurrencies.
          <ul>
            <li>White Label Crypto Exchange</li>
            <li>Centralized Crypto Exchange</li>
            <li>Decentralized Crypto Exchange</li>
            <li>Transparency in Gameplay</li>
          </ul>
        </div>
      </div>

      <div class="feature-card">
        <div class="feature-left"><i class="fas fa-university"></i> Banking And Fintech</div>
        <div class="feature-right">
          Our banking and fintech solutions integrate cryptocurrency with financial services.
          <ul>
            <li>Crypto payment gateway</li>
            <li>Neobank development</li>
            <li>Fintech app development</li>
            <li>Smart Contract Audited</li>
          </ul>
        </div>
      </div>

      <div class="feature-card">
        <div class="feature-left"><i class="fas fa-wallet"></i> Wallet</div>
        <div class="feature-right">
          We create secure digital wallets with advanced security features.
          <ul>
            <li>Crypto wallet</li>
            <li>White Label Wallet</li>
            <li>Web3 wallet</li>
            <li>Defi Wallet</li>
          </ul>
        </div>
      </div>

      <div class="feature-card">
        <div class="feature-left"><i class="fas fa-robot"></i> Trading Bots</div>
        <div class="feature-right">
          Our trading bots use algorithms to automate buying and selling.
          <ul>
            <li>Flash Loan Arbitrage Bot</li>
            <li>DCA Trading Bot</li>
            <li>Crypto Sandwich Bot</li>
            <li>Grid Trading Bot</li>
          </ul>
        </div>
      </div>

      <div class="feature-card">
        <div class="feature-left"><i class="fas fa-gamepad"></i> Gaming</div>
        <div class="feature-right">
          We develop blockchain-based gaming solutions.
          <ul>
            <li>Blockchain gaming</li>
            <li>Crypto casino game development</li>
            <li>Fantasy sports app development</li>
            <li>Play to Earn Game Development</li>
          </ul>
        </div>
      </div>

      <div class="feature-card">
        <div class="feature-left"><i class="fas fa-palette"></i> NFT</div>
        <div class="feature-right">
          Our NFT services help users create, buy, and sell digital assets.
          <ul>
            <li>NFT Marketplace Development</li>
            <li>NFT Game Development</li>
            <li>NFT Music Marketplace Development</li>
            <li>NFT Art Marketplace Development</li>
          </ul>
        </div>
      </div>
    </div>

  </section> -->
  <section class="Industries">
    <h1>Industries We Serve </h1>
    <div class="scrolling-services-container">
      <!-- First Row -->
      <div class="scrolling-animation-wrapper">
        <div class="scrolling-row">
          <div class="scrolling-services-label">Industries</div>
          <div class="scrolling-services-box">
            <div class="scrolling-content">
              <div class="scrolling-service-item mx-3"><img src="./images/6034544b-2efb-46f7-b1b5-2c6a302c4ddf.png"
                  alt=""> Ecommerce</div>
              <div class="scrolling-service-item mx-3"><img src="./images/1998226e-839b-4922-8f82-337fcdc5aa52.png"
                  alt=""> Finance</div>
              <div class="scrolling-service-item mx-3"><img src="./images/3ed519eb-197a-4102-ad18-f152bbf5158f.png"
                  alt=""> Healthcare</div>
              <div class="scrolling-service-item mx-3"><img src="./images/entertainment.png" alt=""> Entertainment</div>
              <div class="scrolling-service-item mx-3"><img src="./images/1d836e7c-905e-4807-89bf-aa7943c6373e.png"
                  alt=""> Gaming</div>
              <div class="scrolling-service-item mx-3"><img src="./images/graphic_1151221.png" alt=""> On Demand</div>
              <div class="scrolling-service-item mx-3"><img src="./images/education.png" alt=""> Education</div>
              <div class="scrolling-service-item mx-3"><img src="./images/hospitality.png" alt=""> Hospitality</div>
              <div class="scrolling-service-item mx-3"><img src="./images/54fe7408-5b29-4264-b50d-9a1691cd51de.png"
                  alt=""> Logistics</div>
              <div class="scrolling-service-item mx-3"><img src="./images/real-estate.png" alt=""> Real Estate</div>
              <div class="scrolling-service-item mx-3"><img src="./images/manufacturing.png" alt=""> Manufacturing</div>
              <div class="scrolling-service-item mx-3"><img src="./images/retail.png" alt=""> Retail</div>
              <div class="scrolling-service-item mx-3"><img src="./images/banking.png" alt=""> Banking</div>

              <!-- Duplicate for infinite loop -->
              <div class="scrolling-service-item mx-3"><img src="./images/6034544b-2efb-46f7-b1b5-2c6a302c4ddf.png"
                  alt=""> Ecommerce</div>
              <div class="scrolling-service-item mx-3"><img src="./images/1998226e-839b-4922-8f82-337fcdc5aa52.png"
                  alt=""> Finance</div>
              <div class="scrolling-service-item mx-3"><img src="./images/3ed519eb-197a-4102-ad18-f152bbf5158f.png"
                  alt=""> Healthcare</div>
              <div class="scrolling-service-item mx-3"><img src="./images/entertainment.png" alt=""> Entertainment</div>
              <div class="scrolling-service-item mx-3"><img src="./images/1d836e7c-905e-4807-89bf-aa7943c6373e.png"
                  alt=""> Gaming</div>
              <div class="scrolling-service-item mx-3"><img src="./images/graphic_1151221.png" alt=""> On Demand</div>
              <div class="scrolling-service-item mx-3"><img src="./images/education.png" alt=""> Education</div>
              <div class="scrolling-service-item mx-3"><img src="./images/hospitality.png" alt=""> Hospitality</div>
              <div class="scrolling-service-item mx-3"><img src="./images/54fe7408-5b29-4264-b50d-9a1691cd51de.png"
                  alt=""> Logistics</div>
              <div class="scrolling-service-item mx-3"><img src="./images/real-estate.png" alt=""> Real Estate</div>
              <div class="scrolling-service-item mx-3"><img src="./images/manufacturing.png" alt=""> Manufacturing</div>
              <div class="scrolling-service-item mx-3"><img src="./images/retail.png" alt=""> Retail</div>
              <div class="scrolling-service-item mx-3"><img src="./images/banking.png" alt=""> Banking</div>
            </div>

          </div>
        </div>
        <!-- Second Row (Right Side "Industries" with reverse scroll) -->
        <div class="scrolling-row">
          <div class="scrolling-services-box">
            <div class="scrolling-content reverse">
              <div class="scrolling-service-item mx-3"><img src="./images/6034544b-2efb-46f7-b1b5-2c6a302c4ddf.png"
                  alt=""> Ecommerce</div>
              <div class="scrolling-service-item mx-3"><img src="./images/1998226e-839b-4922-8f82-337fcdc5aa52.png"
                  alt=""> Finance</div>
              <div class="scrolling-service-item mx-3"><img src="./images/3ed519eb-197a-4102-ad18-f152bbf5158f.png"
                  alt=""> Healthcare</div>
              <div class="scrolling-service-item mx-3"><img src="./images/entertainment.png" alt=""> Entertainment</div>
              <div class="scrolling-service-item mx-3"><img src="./images/1d836e7c-905e-4807-89bf-aa7943c6373e.png"
                  alt=""> Gaming</div>
              <div class="scrolling-service-item mx-3"><img src="./images/graphic_1151221.png" alt=""> On Demand</div>
              <div class="scrolling-service-item mx-3"><img src="./images/education.png" alt=""> Education</div>
              <div class="scrolling-service-item mx-3"><img src="./images/hospitality.png" alt=""> Hospitality</div>
              <div class="scrolling-service-item mx-3"><img src="./images/54fe7408-5b29-4264-b50d-9a1691cd51de.png"
                  alt=""> Logistics</div>
              <div class="scrolling-service-item mx-3"><img src="./images/real-estate.png" alt=""> Real Estate</div>
              <div class="scrolling-service-item mx-3"><img src="./images/manufacturing.png" alt=""> Manufacturing</div>
              <div class="scrolling-service-item mx-3"><img src="./images/retail.png" alt=""> Retail</div>
              <div class="scrolling-service-item mx-3"><img src="./images/banking.png" alt=""> Banking</div>

              <!-- Duplicate for infinite loop -->
              <div class="scrolling-service-item mx-3"><img src="./images/6034544b-2efb-46f7-b1b5-2c6a302c4ddf.png"
                  alt=""> Ecommerce</div>
              <div class="scrolling-service-item mx-3"><img src="./images/1998226e-839b-4922-8f82-337fcdc5aa52.png"
                  alt=""> Finance</div>
              <div class="scrolling-service-item mx-3"><img src="./images/3ed519eb-197a-4102-ad18-f152bbf5158f.png"
                  alt=""> Healthcare</div>
              <div class="scrolling-service-item mx-3"><img src="./images/entertainment.png" alt=""> Entertainment</div>
              <div class="scrolling-service-item mx-3"><img src="./images/1d836e7c-905e-4807-89bf-aa7943c6373e.png"
                  alt=""> Gaming</div>
              <div class="scrolling-service-item mx-3"><img src="./images/graphic_1151221.png" alt=""> On Demand</div>
              <div class="scrolling-service-item mx-3"><img src="./images/education.png" alt=""> Education</div>
              <div class="scrolling-service-item mx-3"><img src="./images/hospitality.png" alt=""> Hospitality</div>
              <div class="scrolling-service-item mx-3"><img src="./images/54fe7408-5b29-4264-b50d-9a1691cd51de.png"
                  alt=""> Logistics</div>
              <div class="scrolling-service-item mx-3"><img src="./images/real-estate.png" alt=""> Real Estate</div>
              <div class="scrolling-service-item mx-3"><img src="./images/manufacturing.png" alt=""> Manufacturing</div>
              <div class="scrolling-service-item mx-3"><img src="./images/retail.png" alt=""> Retail</div>
              <div class="scrolling-service-item mx-3"><img src="./images/banking.png" alt=""> Banking</div>
            </div>
          </div>
          <div class="scrolling-services-label">Industries</div>
        </div>
      </div>
    </div>

  </section>

  <section class="features">
    <div class="feature-header d-flex justify-content-center gap-4 mx-auto px-5">
      <span class="feature-icon d-flex align-items-center" data-icon-id="feature-1">
        <i class="fas fa-exchange-alt mx-2"></i>
        <small>Trading Portals</small>
      </span>
      <span class="feature-icon d-flex align-items-center" data-icon-id="feature-2">
        <i class="fas fa-coins mx-2"></i> <!-- Updated for Tokenization -->
        <small>Tokenization</small>
      </span>
      <span class="feature-icon d-flex align-items-center" data-icon-id="feature-3">
        <i class="fas fa-image mx-2"></i> <!-- Updated for NFT -->
        <small>NFT</small>
      </span>
      <span class="feature-icon d-flex align-items-center" data-icon-id="feature-4">
        <i class="fas fa-university mx-2"></i> <!-- Updated for Banking & Fintech -->
        <small>Banking & Fintech</small>
      </span>
      <span class="feature-icon d-flex align-items-center" data-icon-id="feature-5">
        <i class="fas fa-wallet mx-2"></i> <!-- Updated for Wallet -->
        <small>Wallet</small>
      </span>
      <span class="feature-icon d-flex align-items-center" data-icon-id="feature-6">
        <i class="fas fa-gamepad mx-2"></i> <!-- Gaming remains the same -->
        <small>Gaming</small>
      </span>
    </div>
    <div class="container">
      <div class="row feature-container">
        <div class="col-12">
          <!-- Trading Portals -->
          <div class="row feature-card mx-auto" data-icon-id="feature-1">
            <div class="col-md-6 feature-left mt-3 d-flex flex-column align-items-center">
              <h5 class="fw-semibold mt-2 text-center">Trading Portals</h5>
              <img src="./images/trading.png" alt="Trading Portals" class="mx-auto">
            </div>
            <div class="col-md-6 feature-right mt-3">
              <p>Start your trade applications with blockchain technology, providing a seamless trading journey for traders worldwide, and become a successful entrepreneur in the blockchain ecospace. We develop advanced, robust, and scalable crypto trading applications, specializing in various segments suitable for all kinds of users.</p>
              <ul>
                <li>Centralized Crypto Exchange Development</li>
                <li>Decentralized Crypto Exchange Development</li>
                <li>Hybrid Crypto Exchange Development</li>
                <li>P2P Crypto Exchange Development</li>
                <li>Derivatives Crypto Exchange Development</li>
              </ul>
            </div>
          </div>

          <!-- Tokenization -->
          <div class="row feature-card mx-auto" data-icon-id="feature-2">
            <div class="col-md-6 feature-left mt-3 d-flex flex-column align-items-center">
              <h5 class="fw-semibold mt-2 text-center">Tokenization</h5>
              <img src="./images/tokenization.png" alt="Tokenization" class="mx-auto">
            </div>
            <div class="col-md-6 feature-right mt-3">
              <p>The concept of tokenization has use cases across various industries and can be used for fundraising and tokenizing real-world assets. Blockchain technology has a pioneering history in tokenization. Get started with us to monetize and tokenize your business.</p>
              <ul>
                <li>ICO Development</li>
                <li>STO Development</li>
                <li>Token Creation (ERC, BEP, TRC, etc.)</li>
                <li>Asset Tokenization</li>
              </ul>
            </div>
          </div>

          <!-- NFT Development -->
          <div class="row feature-card mx-auto" data-icon-id="feature-3">
            <div class="col-md-6 feature-left mt-3 d-flex flex-column align-items-center">
              <h5 class="fw-semibold mt-2 text-center">NFT Development</h5>
              <img src="./images/nft.png" alt="NFT Development" class="mx-auto">
            </div>
            <div class="col-md-6 feature-right mt-3">
              <p>Non-fungible tokens play a vital role for digital creators and artists, providing a digital license for their art forms, securing them, and seamlessly monetizing them through buying and selling digital assets.</p>
              <ul>
                <li>NFT Marketplace Development</li>
                <li>NFT Token Development</li>
                <li>NFT Loan Platform Development</li>
                <li>NFT Game Development</li>
              </ul>
            </div>
          </div>

          <!-- Banking and Fintech -->
          <div class="row feature-card mx-auto" data-icon-id="feature-4">
            <div class="col-md-6 feature-left mt-3 d-flex flex-column align-items-center">
              <h5 class="fw-semibold mt-2 text-center">Banking and Fintech</h5>
              <img src="./images/bank.png" alt="Banking and Fintech" class="mx-auto">
            </div>
            <div class="col-md-6 feature-right mt-3">
              <p>Financial technology is evolving and moving towards a more secure and transparent solution, where blockchain becomes an inevitable technology for building next-level banking and finance solutions.</p>
              <ul>
                <li>Crypto Payment Gateway Development</li>
                <li>Blockchain Integration with Banking Apps</li>
                <li>Banking and Money Transfer Application Development</li>
                <li>Crypto Investment Platform Development</li>
              </ul>
            </div>
          </div>

          <!-- Wallet App Development -->
          <div class="row feature-card mx-auto" data-icon-id="feature-5">
            <div class="col-md-6 feature-left mt-3 d-flex flex-column align-items-center">
              <h5 class="fw-semibold mt-2 text-center">Wallet App Development</h5>
              <img src="./images/wallet.png" alt="Wallet App Development" class="mx-auto">
            </div>
            <div class="col-md-6 feature-right mt-3">
              <p>Store, manage, and transact your crypto assets securely with our wide range of wallet applications, integrated with blockchain at its core.</p>
              <ul>
                <li>Centralized Crypto Wallet Development</li>
                <li>Web3 Wallet Application Development</li>
                <li>NFT Wallet Application Development</li>
              </ul>
            </div>
          </div>

          <!-- Gaming App Development -->
          <div class="row feature-card mx-auto" data-icon-id="feature-6">
            <div class="col-md-6 feature-left mt-3 d-flex flex-column align-items-center">
              <h5 class="fw-semibold mt-2 text-center">Gaming App Development</h5>
              <img src="./images/games.png" alt="Gaming App Development" class="mx-auto">
            </div>
            <div class="col-md-6 feature-right mt-3">
              <p>Gaming has evolved beyond just entertainment, creating new opportunities for players to earn while they play. With blockchain technology at the core, we take gaming to the next level—offering innovative experiences from metaverse development to play-to-earn games.</p>
              <ul>
                <li>Blockchain Game Development</li>
                <li>Metaverse Game Development</li>
                <li>P2E Game Development</li>
                <li>Web3 Game Development</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>


  <section class="chooseus mt-3 mt-sm-0">
    <div class="container">
      <div class="row">
        <div class="col-md-5 col-sm-12">
          <h1 class="section-title">Why Choose <span class="text-warning">Us?</span></h1>
          <p class="chooseus-description text-center">
            Craitrix combines experience, innovation, and global expertise to deliver high-quality, scalable
            solutions. We build for the future while ensuring your business thrives today, adapting to every
            technological shift with precision.
          </p>
        </div>

        <div class="col-md-7 col-sm-12">
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="card">
                <div class="icon"><img src="./images/Fast.png" alt=""></div>
                <h5>Borderless Innovation</h5>
                <p>We serve clients worldwide, leveraging local and global expertise to develop high-standard solutions for startups and enterprises.</p>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card">
                <div class="icon"><img src="./images/Creative.png" alt=""></div>
                <h5>Future-Proof Solutions</h5>
                <p>Our scalable infrastructure adapts to change, ensuring efficiency and long-term business success.</p>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card">
                <div class="icon"><img src="./images/CuttingEdgeTech.png" alt=""></div>
                <h5>Technology Architects</h5>
                <p>With a team of blockchain experts, we drive innovation and deliver cutting-edge technology solutions.</p>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card">
                <div class="icon"><img src="./images/CustomerSupport.png" alt=""></div>
                <h5>Redefining Reliability</h5>
                <p>Built on a customer-first approach, we maintain quality while exceeding expectations with flexible solutions.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section id="process">

    <div class="process-container">
      <h1 class="text-center text-primary">Our Work Process</h1>

      <div class="process-details">
        <h2 id="processTitle">Research</h2>
        <p id="processDescription">We gather data, analyze requirements, and understand project goals before
          proceeding.</p>
      </div>

      <div class="semi-circle">
        <div class="step active" data-index="0">
          <div class="icon-wrapper">
            <img src="./images/ideation.png" alt="Ideation">
          </div>
        </div>
        <div class="step" data-index="1">
          <div class="icon-wrapper">
            <img src="./images/research.png" alt="Research">
          </div>
        </div>
        <div class="step" data-index="2">
          <div class="icon-wrapper">
            <img src="./images/planning.png" alt="Planning">
          </div>
        </div>
        <div class="step" data-index="3">
          <div class="icon-wrapper">
            <img src="./images/design.png" alt="Design">
          </div>
        </div>
        <div class="step" data-index="4">
          <div class="icon-wrapper">
            <img src="./images/development.png" alt="Development">
          </div>
        </div>
        <div class="step" data-index="5">
          <div class="icon-wrapper">
            <img src="./images/testing.png" alt="Testing">
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- Hero Section -->
  <section class="hero-section mt-5">
    <div class="hero-content">
      <h1>Join Our Team</h1>
      <p>Kickstart your carrer with people first work culture place and grow your journey with innovative and energetic
        minds around you</p>
      <a href="#" class="career-btn">Explore Careers</a>
    </div>
  </section>


  <section class="awards-section">
    <h2 class="awards-title">Awards & Recognition</h2>
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="award-card">
            <img src="./images/awr-1.jpg" alt="Award Icon">
            <h3>Best Innovation Award</h3>
            <p>Recognized for groundbreaking technology innovation.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="award-card">
            <img src="./images/awr-2.jpg" alt="Award Icon">
            <h3>Excellence in Service</h3>
            <p>Awarded for delivering outstanding customer support.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="award-card">
            <img src="./images/awr-3.jpg" alt="Award Icon">
            <h3>Top Performer</h3>
            <p>Achieved for consistent high performance in the industry.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="award-card">
            <img src="./images/top-it-consulting-companies1.jpg" alt="Award Icon">
            <h3>Leadership Excellence</h3>
            <p>Honored for exceptional leadership and vision.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="award-card">
            <img src="./images/top-mobile-app-development-companies2.jpg" alt="Award Icon">
            <h3>Community Impact</h3>
            <p>Awarded for contributions towards social responsibility.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="award-card">
            <img src="./images/top-blockchain-development-companies3.jpg" alt="Award Icon">
            <h3>Best Workplace</h3>
            <p>Recognized as a great place to work and grow.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="customer-stories ">

    <div class="row justify-content-center">
      <div class="col-md-6 text-light">
        <h1 class="mt-5">Testimonials</h1>
        <h4>Let us know how we are doing!!! <br>What our Clients says</h4>
        <p>We love hearing customer success stories</p>
      </div>
      <div class="col-md-6">
        <div class="glassy-box p-4 ">
          <h5 id="authorName">Brandon Turp</h5>
          <div class="stars mb-3">
            ★★★★★
          </div>
          <p id="testimonialText">&nbsp; &nbsp;
            Our Experience with Craitrix was really great and happy to associate with them. They create perfect solution
            for my business needs and the support they provide was nice and highly

            recommend

          </p>
          <div class="d-flex justify-content-between prevNextbutton">
            <button id="prevBtn" class="btn btn-outline-light">← Previous</button>
            <button id="nextBtn" class="btn btn-outline-light">Next →</button>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- 
  <section class="FAQ">

    <div class="container mt-5">
      <div class="row">
        <h2 class="text-center text-primary">Frequently Asked Questions</h2>
        <p class="text-center">Click a question to see the answer.</p>
        <div class="col-md-6">
          <div class="faq-container">
            <div class="faq-question active" data-answer="answer1">
              What is Blockchain? <i class="fa-solid fa-chevron-right"></i>
            </div>
            <div class="faq-question" data-answer="answer2">
              How does Blockchain work? <i class="fa-solid fa-chevron-right"></i>
            </div>
            <div class="faq-question" data-answer="answer3">
              What is Smart Contracts? <i class="fa-solid fa-chevron-right"></i>
            </div>
            <div class="faq-question" data-answer="answer4">
              What is the difference between Blockchain and Cryptocurrency? <i class="fa-solid fa-chevron-right"></i>
            </div>
            <div class="faq-question" data-answer="answer5">
              Is Blockchain secure? <i class="fa-solid fa-chevron-right"></i>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="faq-answer" id="answer1">
            <strong>Blockchain</strong> is a distributed ledger technology that allows secure, transparent, and
            immutable record-keeping. It stores data across multiple nodes in a decentralized network.
          </div>
          <div class="faq-answer" id="answer2">
            <strong>Blockchain works</strong> by storing data in blocks that are linked together in a chain.
            Each block contains a timestamp, transaction data, and a hash of the previous block, making it
            nearly impossible to alter the data once added.
          </div>
          <div class="faq-answer" id="answer3">
            <strong>Smart Contracts</strong> are self-executing contracts with the terms of the agreement
            directly written into lines of code. These contracts automatically enforce and execute the terms
            without needing intermediaries.
          </div>
          <div class="faq-answer" id="answer4">
            <strong>Blockchain</strong> is a decentralized ledger technology, while
            <strong>Cryptocurrency</strong> is a type of digital currency that operates on a blockchain network.
            Cryptocurrencies use blockchain for secure transactions and decentralized control.
          </div>
          <div class="faq-answer" id="answer5">
            <strong>Blockchain is secure</strong> due to its decentralized nature, cryptographic encryption, and
            the immutability of the data stored in blocks. Once data is added to the blockchain, it is nearly
            impossible to alter or tamper with.
          </div>
        </div>
      </div>
    </div>

  </section> -->
  <section class="contact-us p-5">
    <div class="row w-100 d-flex align-items-stretch">
      <!-- Contact Form -->
      <div class="col-md-6 col-12 d-flex flex-column">
        <div class="card glassmorphism w-100 h-100">
          <div class="card-body">
            <h3 class="text-center mb-4">Contact Us</h3>

            <div class="container mt-5 ">
              <form id="contactForm" method="post">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name">
                    <small class="text-danger d-none" id="nameError">This field is required</small>
                  </div>
                  <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    <small class="text-danger d-none" id="emailError">This field is required</small>
                  </div>
                </div>

                <div class="mb-4">
                  <label for="country" class="form-label">Country</label>
                  <input type="text" class="form-control" id="country" name="country" placeholder="Enter your country">
                  <small class="text-danger d-none" id="countryError">This field is required</small>
                </div>

                <div class="row mb-3">
                  <label for="contact-method" class="form-label">Contact</label>
                  <div class="col-3">
                    <select class="form-select" id="contact-method" name="contactMethod">
                      <option value="" disabled selected>Select</option>
                      <option value="whatsapp">WhatsApp</option>
                      <option value="telegram">Telegram</option>
                      <option value="skype">Skype</option>
                    </select>
                    <small class="text-danger d-none" id="contactMethodError">This field is required</small>
                  </div>

                  <div class="col-9">
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your contact number">
                    <small class="text-danger d-none" id="phoneError">This field is required</small>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="message" class="form-label">How may we help you?</label>
                  <textarea class="form-control" id="message" name="message" rows="4" placeholder="Describe your query..."></textarea>
                  <small class="text-danger d-none" id="messageError">This field is required</small>
                </div>
                <div class="d-flex justify-content-center">

                  <button type="submit" class="btn">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-12 d-flex flex-column">
        <div class="card glassmorphism w-100 h-100">
          <div class="card-body">
            <h3 class="text-center ">Contact Us Process</h3>
            <div class="row d-flex justify-content-center">

              <div class="steps w-50 mt-4">
                <div class="step">
                  <div class="circle active">1</div>
                  <span>Fill in Your Details</span>
                  <div class="line"></div>
                </div>
                <div class="step">
                  <div class="circle">2</div>
                  <span>Describe Your Query</span>
                  <div class="line"></div>
                </div>
                <div class="step">
                  <div class="circle">3</div>
                  <span>Submit & Confirm</span>
                  <div class="line"></div>
                </div>
                <div class="step">
                  <div class="circle">4</div>
                  <span>Get a Response</span>
                </div>
              </div>

            </div>
          </div>

          <section class="GetInTouch  text-center text-dark">
            <h1>Get In Touch</h1>
            <div class="row justify-content-center w-100 p-5 ">
              <div class="col-md-6 col-sm-6 d-flex align-items-center mb-2">
                <img src="./images/telephone_724664.png" alt="Phone" width="25">
                <p class="ms-2 mb-0">+91 866 772 0681</p>
              </div>
              <div class="col-md-6 col-sm-6 d-flex align-items-center mb-2">
                <img src="./images/home-address_12535925.png" alt="Address" width="25">
                <p class="ms-2 mb-0">Madurai</p>
              </div>
              <div class="col-md-6 col-sm-6 d-flex align-items-center  mb-2">
                <img src="./images/3624728.png" alt="Email" width="25">
                <p class="ms-2 mb-0">business@crypticraft.com</p>
              </div>
              <div class="col-md-6 col-sm-6 d-flex align-items-center mb-2">
                <img src="./images/whatsapp.png" alt="WhatsApp" width="25">
                <p class="ms-2 mb-0">+91 866 772 0681</p>
              </div>
              <!-- <div class="col-md-6 col-sm-6 d-flex align-items-center  mb-2">
                <img src="./images/telegram-5662082_1280.png" alt="Telegram" width="25">
                <p class="ms-2 mb-0">
                  <a href="https://telegram.me/Craitrix" class="text-white text-decoration-none">Telegram</a>
                </p>
              </div> -->
            </div>
          </section>
        </div>
      </div>




    </div>
  </section>


  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row text-center text-md-start">

        <!-- Column 1: Logo -->
        <div class="col-md-4 mb-3">
          <img src="./images/cratitrix_landscape_color.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
          <p class="mt-2">
            Craitrix is a leading provider of innovative IT solutions, dedicated to helping businesses transform and
            thrive in the global marketplace. Our team of industry experts is driven by a passion for delivering
            cutting-edge technology that propels businesses towards success and growth.

          </p>
          <img src="./images/facebook.png" class="icon" alt="facebook">
          <img src="./images/twitter.png" class="icon" alt="youtube">
          <img src="./images/youtube.png" class="icon" alt="youtube">
          <img src="./images/instagram.jpg" class="icon" alt="youtube">
          <img src="./images/linkedin.png" class="icon" alt="youtube">


        </div>

        <!-- Column 2: Navigation Links -->
        <div class="col-md-2 mb-3">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>

          </ul>
        </div>
        <div class="col-md-3 mb-3">
          <h5>IT Consulting</h5>
          <ul class="list-unstyled">
            <li><a href="#">Web Application</a></li>
            <li><a href="#">Blockchain</a></li>
            <li><a href="#">AI</a></li>
            <li><a href="#">Trading Bot</a></li>
            <li><a href="#">Gaming
              </a></li>

          </ul>
        </div>
        <!-- Column 3: Social Media Icons -->
        <div class="col-md-3 mb-3">
          <h5>Turnkey Solution
          </h5>
          <ul class="list-unstyled">
            <li><a href="#">Crypto Exchange</a></li>
            <li><a href="#">NFT Marketplace</a></li>
            <li><a href="#">Decentralized Exchange</a></li>
            <li><a href="#">Crypto Wallet</a></li>
            <li><a href="#">Crypto Payment Gateway

              </a></li>

          </ul>
        </div>
      </div>
    </div>
    <div class="text-center">&copy; 2025 Craitrix. All rights reserved.</div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById("contactForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent form submission
        let isValid = true;

        function validateField(id) {
          let input = document.getElementById(id);
          let error = document.getElementById(id + "Error");
          if (!input.value.trim()) {
            error.classList.remove("d-none");
            isValid = false;
          } else {
            error.classList.add("d-none");
          }
        }

        // Email validation function
        function validateEmail(id) {
          let input = document.getElementById(id);
          let error = document.getElementById(id + "Error");
          let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email format regex

          if (!input.value.trim()) {
            error.textContent = "This field is required";
            error.classList.remove("d-none");
            isValid = false;
          } else if (!emailPattern.test(input.value.trim())) {
            error.textContent = "Invalid email format";
            error.classList.remove("d-none");
            isValid = false;
          } else {
            error.classList.add("d-none");
          }
        }

        // Validate all required fields
        validateField("name");
        validateEmail("email"); // Validate email format
        validateField("country");
        validateField("phone");
        validateField("message");

        // Validate contact method (dropdown)
        let contactMethod = document.getElementById("contact-method");
        let contactMethodError = document.getElementById("contactMethodError");
        if (contactMethod.value === "") {
          contactMethodError.classList.remove("d-none");
          isValid = false;
        } else {
          contactMethodError.classList.add("d-none");
        }

        // Submit the form if all fields are valid
        if (isValid) {
          this.submit();
        }
      });
    });


    document.addEventListener("scroll", function() {
      let activeIconId = null;
      let activeColor = null;

      // Loop through each feature card
      const cards = document.querySelectorAll(".feature-card");
      const lastCard = cards[cards.length - 1]; // Get the last card

      cards.forEach((card, index) => {
        let rect = card.getBoundingClientRect();

        // Check if the card is in view
        if (rect.top < window.innerHeight * 0.75 && rect.bottom > 0) {
          card.classList.add("visible");
          activeIconId = card.getAttribute("data-icon-id");

          console.log(card.style.backgroundColor);
          // Get the card's background color
          activeColor = card.style.backgroundColor;

          // Check if it's the last card
          if (card === lastCard) {
            console.log("This is the last card in view.");
            document.querySelector('.feature-header').style.position = "static"; // Hide feature header

          }
        } else {
          document.querySelector('.feature-header').style.position = "sticky"; // Hide feature header
        }
      });

      // Update header icons: apply the card's background color to the active icon
      document.querySelectorAll(".feature-header .feature-icon").forEach((icon) => {
        if (icon.getAttribute("data-icon-id") === activeIconId) {
          console.log(activeColor)
          icon.style.color = activeColor;
          icon.classList.remove("dim-icon");
        } else {
          icon.style.color = "";
          icon.classList.add("dim-icon");
        }
      });
    });
  </script>


  <script src="./script.js"></script>


</body>

</html>