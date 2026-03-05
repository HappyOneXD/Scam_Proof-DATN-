<?php
// session_start();  // no longer needed unless you want to customise
$type   = $_POST['type'] ?? '';
$result = '';
switch ($type) {
    case 'phone':
        $phone = $_POST['phone'] ?? '';
        $result = "Received phone number: " . htmlspecialchars($phone);
        break;
    case 'url':
        $url = $_POST['url'] ?? '';
        $result = "Received URL: " . htmlspecialchars($url);
        break;
    case 'email':
        $email_address = $_POST['email_address'] ?? '';
        $email_content = $_POST['email_content'] ?? '';
        $result = "Received email address: " . htmlspecialchars($email_address)
                . "<br>Content:<br>" . nl2br(htmlspecialchars($email_content));
        break;
    default:
        $result = "Unknown scan type.";
}
?>
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
    <title>Home</title>
</head>
<body>
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
                        <a class="nav-link fs-4" href="./index.html">HOME</a>
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
    <section class="hero-video position-relative w-100  bg-dark" style="height: 70vh; overflow: hidden;">
        <img src="./asset/glob.gif" alt="background" id="bg-video" style="opacity: 0.5;" />
        <div class="hero-overlay-text d-flex flex-column justify-content-center align-items-center text-center">
            <h1 class="boiler-title ">Scam & Threat Detection Platform</h1>
            <h2 class="boiler-subtitle font-monospace">Protect the people from scams and threats, one device at a time.</h2>
        </div>
    </section>
    
    <div class="bg-dark" style="height: 100vh;">
 <!-- tabbed input section -->
    <div class="container py-5 bg-dark text-white" id="scanner-tabs">
      <ul class="nav nav-tabs" id="scanTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="phone-tab" data-bs-toggle="tab"
                  data-bs-target="#phone" type="button" role="tab">Phone Number</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="url-tab" data-bs-toggle="tab"
                  data-bs-target="#url" type="button" role="tab">URL</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="email-tab" data-bs-toggle="tab"
                  data-bs-target="#email" type="button" role="tab">Email</button>
        </li>
      </ul>
      <div class="tab-content p-4 bg-secondary bg-opacity-25 border border-light rounded-bottom">
        <div class="tab-pane fade show active" id="phone" role="tabpanel">
          <form method="post" action="scan.php">
            <input type="hidden" name="type" value="phone">
            <div class="mb-3">
                <label for="phoneInput" class="form-label">Phone number</label>
                <input type="tel" class="form-control" id="phoneInput"
                       name="phone" placeholder="+1234567890" required>
            </div>
            <button type="submit" class="btn btn-primary">Check</button>
          </form>
        </div>
        <div class="tab-pane fade" id="url" role="tabpanel">
          <form method="post" action="scan.php">
            <input type="hidden" name="type" value="url">
            <div class="mb-3">
                <label for="urlInput" class="form-label">URL</label>
                <input type="url" class="form-control" id="urlInput"
                       name="url" placeholder="https://example.com" required>
            </div>
            <button type="submit" class="btn btn-primary">Check</button>
          </form>
        </div>
        <div class="tab-pane fade" id="email" role="tabpanel">
          <form method="post" action="scan.php">
            <input type="hidden" name="type" value="email">
            <div class="mb-3">
                <label for="emailAddrInput" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailAddrInput"
                       name="email_address" placeholder="user@example.com" required>
            </div>
            <div class="mb-3">
                <label for="emailContentInput" class="form-label">Email contents</label>
                <textarea class="form-control" id="emailContentInput"
                          name="email_content" rows="4"
                          placeholder="Paste email body here" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Check</button>
          </form>
        </div>
      </div>
    </div>
    </div>

    

    <!-- Disclaimers bottom page -->
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
        100% {
            transform: rotate(-360deg);
        }
    }

    .hero-video {
        width: 100vw;
        height: 60vh;
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
        font-size: 6vw;
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