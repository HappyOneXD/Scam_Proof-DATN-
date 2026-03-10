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
    <title>Phone Number Scan</title>
</head>
<body class="bg-black text-white">
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
                <ul class="navbar-nav w-100 justify-content-evenly px-5">
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="./index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="./scan_email.php">EMAIL SCAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="./scan_phone.php">PHONE NUMBER SCAN</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="./scan_url.php">URL SCAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="./contact.html">CONTACT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-4" href="./auth/login.php">LOGIN</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <section class="hero-video position-relative w-100 bg-dark" style="height: 40vh; overflow: hidden;">
        <img src="./asset/glob.gif" alt="background" id="bg-video" style="opacity: 0.5;" />
        <div class="hero-overlay-text d-flex flex-column justify-content-center align-items-center text-center">
            <h1 class="boiler-title">Phone Number Scan</h1>
            <h2 class="boiler-subtitle font-monospace">Check suspicious callers and SMS senders.</h2>
        </div>
    </section>

    <div class="bg-dark py-5">
        <div class="container text-white">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="p-4 bg-secondary bg-opacity-25 border border-light rounded">
                        <form method="post" action="scan.php">
                            <input type="hidden" name="type" value="phone">
                            <div class="mb-3">
                                <label for="phoneInput" class="form-label">Phone number</label>
                                <input type="tel" class="form-control" id="phoneInput"
                                       name="phone" placeholder="+1234567890" required>
                            </div>
                            <button type="submit" class="btn btn-light w-100">Scan Number</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-black text-center p-3">
        <p class="sub mb-0">Disclaimer: This website is for educational purposes only. We do not condone or support any illegal activities. Use this tool responsibly and at your own risk.</p>
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
        height: 40vh;
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
    .sub { color: #fff; }
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