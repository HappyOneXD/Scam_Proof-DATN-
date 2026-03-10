<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <title>About Us - Scam & Threat Detection Platform</title>
</head>
<body class="bg-black text-white">
    <!-- NAVBAR (same as index) -->
    <div class="container-fluid bg-black">
        <nav class="navbar navbar-expand-lg bg-transparent">
            <div class="d-flex justify-content-center align-items-center position-relative mx-auto"
                style="height: 200px;">

                <img src="./asset/numb.gif" alt="logo"
                    class="position-absolute top-50 start-50 translate-middle"
                    style="width: 100px; height: auto; z-index: 2;" />

                <svg viewBox="0 0 300 300" class="rotate-text" style="width: 200px; height: 200px;">
                    <defs>
                        <path id="circlePath" d="M150,150 m-100,0 a100,100 0 1,1 200,0 a100,100 0 1,1 -200,0" />
                    </defs>
                    <text font-size="28" fill="white" font-weight="bold">
                        <textPath href="#circlePath">
                            PROTECT • YOUR • DEVICE • AT • ALL • COSTS •
                        </textPath>
                    </text>
                </svg>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav px-5 w-100">
                    <li class="nav-item me-3">
                        <a class="nav-link fs-4" href="./index.php">HOME</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link fs-4" href="./scan_email.php">EMAIL SCAN</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link fs-4" href="./scan_phone.php">PHONE NUMBER SCAN</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link fs-4" href="./scan_url.php">URL SCAN</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link fs-4 active" aria-current="page" href="./about.php">ABOUT US</a>
                    </li>

                    <li class="nav-item flex-grow-1"></li>

                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link fs-4 dropdown-toggle" href="#" id="userDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end bg-dark border-light" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item text-white" href="./user.php">User Info / History</a>
                                </li>
                                <li><hr class="dropdown-divider border-secondary"></li>
                                <li>
                                    <a class="dropdown-item text-white" href="./auth/logout.php">Log out</a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item me-3">
                            <a class="nav-link fs-4" href="./auth/signup.php">SIGN UP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-4" href="./auth/login.php">SIGN IN</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>

    <!-- HERO -->
    <section class="hero-video position-relative w-100 bg-dark" style="height: 50vh; overflow: hidden;">
        <img src="./asset/glob.gif" alt="background" id="bg-video" style="opacity: 0.5;" />
        <div class="hero-overlay-text d-flex flex-column justify-content-center align-items-center text-center">
            <h1 class="boiler-title">About Our Platform</h1>
            <h2 class="boiler-subtitle font-monospace">Why we care about scams, fraud and online threats.</h2>
        </div>
    </section>

    <!-- CONTENT -->
    <div class="bg-dark py-5">
        <div class="container text-white">
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="mb-3 text-center">Our Mission</h2>
                    <p class="lead text-center">
                        This project was built to make it easier for everyday users to spot suspicious
                        phone numbers, URLs and emails before they become a problem.  
                        Instead of waiting until someone gets scammed, we want to give people a
                        simple way to double-check things first.
                    </p>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card bg-secondary bg-opacity-25 border-light h-100 text-white">
                        <div class="card-body">
                            <h5 class="card-title text-white">What We Do</h5>
                            <p class="card-text text-white">
                                We provide basic tools to analyse suspicious content:
                                unknown phone numbers, strange links and sketchy emails.
                                The goal is to give you a quick risk signal before you interact
                                with anything that feels off.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-secondary bg-opacity-25 border-light h-100 text-white">
                        <div class="card-body">
                            <h5 class="card-title text-white">Who This Is For</h5>
                            <p class="card-text text-white">
                                This platform is designed for anyone who wants to be a little more
                                careful online: students, families, small businesses, and people
                                who are just tired of scam calls and phishing emails.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-secondary bg-opacity-25 border-light h-100 text-white">
                        <div class="card-body">
                            <h5 class="card-title text-white">How It’s Built</h5>
                            <p class="card-text text-white">
                                Under the hood, this is a web project using PHP and Bootstrap, created
                                as a learning exercise in secure design, input handling and threat
                                awareness. Features will evolve over time as we experiment and improve.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Values / Disclaimer -->
            <div class="row mb-4">
                <div class="col-lg-10 mx-auto">
                    <h3 class="mb-3 text-center">What We Believe</h3>
                    <ul class="list-group list-group-flush bg-transparent">
                        <li class="list-group-item bg-transparent text-white border-secondary">
                            Online safety should be accessible, not only for technical people.
                        </li>
                        <li class="list-group-item bg-transparent text-white border-secondary">
                            Education is one of the best defenses against scams and social engineering.
                        </li>
                        <li class="list-group-item bg-transparent text-white border-secondary">
                            No tool is perfect, so users should always stay skeptical and double-check
                            before sharing sensitive information.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="small text-muted">
                        Note: This platform is for educational and awareness purposes only.  
                        It does not guarantee 100% accurate detection and should be used as
                        one extra layer of caution, not as the only security decision-maker.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER DISCLAIMER -->
    <div class="container-fluid bg-black text-center p-3">
        <p class="sub mb-0">
            Disclaimer: This website is for educational purposes only. We do not condone or support any illegal activities.
            Use this tool responsibly and at your own risk.
        </p>
    </div>
</body>
</html>

<style>
    .rotate-text {
        animation: spin 10s linear infinite;
        transform-origin: center;
    }
    @keyframes spin {
        100% { transform: rotate(-360deg); }
    }
    .hero-video {
        width: 100vw;
        height: 50vh;
        overflow: hidden;
        position: relative;
    }
    .hero-video #bg-video {
        width: 100vw;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 0;
    }
    .hero-overlay-text {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 2;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        pointer-events: none;
    }
    .boiler-title {
        font-size: 5vw;
        font-weight: 900;
        color: #fff;
        letter-spacing: 0.05em;
        margin-bottom: 0.2em;
        line-height: 1;
        text-shadow: 0 2px 16px rgba(0, 0, 0, 0.7);
    }
    .boiler-subtitle {
        font-size: 2vw;
        font-weight: 400;
        color: #fff;
        margin-top: 0;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
    }
    .sub {
        color: #fff;
    }
    .navbar,
    .navbar-brand,
    .nav-link,
    .rotate-text text {
        color: white !important;
        z-index: 1;
    }
    .navbar-nav .nav-link:hover {
        background: #fff;
        color: #000 !important;
        border-radius: 0.25rem;
        transition: background 0.2s, color 0.2s;
    }
</style>