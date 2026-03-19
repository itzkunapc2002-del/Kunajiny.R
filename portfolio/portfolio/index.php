<?php
include 'db.php';

$success_msg = '';
$error_msg   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
    $name    = htmlspecialchars(trim($_POST['name']    ?? ''));
    $email   = htmlspecialchars(trim($_POST['email']   ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if ($name && $email && $message && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $success_msg = $stmt->execute()
            ? "✅ Message sent! I'll reply within 24hrs 🚀"
            : "❌ Something went wrong. Try again.";
        $stmt->close();
    } else {
        $error_msg = "⚠️ Please fill all fields with a valid email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Kunajiny R. — Web Developer</title>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>

<div class="noise"></div>
<div class="cur-dot" id="curDot"></div>
<div class="cur-ring" id="curRing"></div>

<!-- ═══ NAVBAR ═══ -->
<header class="header" id="header">
  <div class="header-inner">
    <a href="#home" class="logo">
      <span class="lb">&lt;</span>KR<span class="ls">/</span><span class="lb">&gt;</span>
    </a>
    <nav class="nav" id="nav">
      <a href="#home"     class="nav-a">Home</a>
      <a href="#about"    class="nav-a">About</a>
      <a href="#skills"   class="nav-a">Skills</a>
      <a href="#projects" class="nav-a">Projects</a>
      <a href="#contact"  class="nav-a">Contact</a>
    </nav>
    <a href="#contact" class="hire-btn">Hire Me</a>
    <button class="burger" id="burger"><i class="fas fa-bars"></i></button>
  </div>
</header>

<!-- ═══ HERO ═══ -->
<section class="hero" id="home">
  <div class="blob b1"></div>
  <div class="blob b2"></div>
  <div class="dot-matrix"></div>

  <div class="hero-wrap">
    <div class="hero-left">
      <div class="hero-badge fade-up">
        <span class="bdot"></span> Available for Work
      </div>
      <h1 class="hero-title fade-up">
        Hi, I'm<br/>
        <span class="hero-name">Kunajiny</span><br/>
        <span class="hero-role">
          <span id="typed"></span><span class="tcursor">_</span>
        </span>
      </h1>
      <p class="hero-sub fade-up">
        I craft <em>fast</em>, <em>beautiful</em>, and <em>accessible</em> websites —
        from pixel-perfect UI to powerful PHP backends.
      </p>
      <div class="hero-actions fade-up">
        <a href="#projects" class="btn-primary"><i class="fas fa-rocket"></i> See My Work</a>
        <a href="#contact"  class="btn-ghost"><i class="fas fa-envelope"></i> Let's Talk</a>
      </div>
      <div class="hero-stats fade-up">
        <div class="hs"><span>10+</span><p>Projects</p></div>
        <div class="hs-div"></div>
        <div class="hs"><span>2+</span><p>Yrs Exp</p></div>
        <div class="hs-div"></div>
        <div class="hs"><span>∞</span><p>Passion</p></div>
      </div>
    </div>

    <div class="hero-right fade-up">
      <div class="code-card">
        <div class="cc-header">
          <span class="ccdot rd"></span>
          <span class="ccdot yw"></span>
          <span class="ccdot gn"></span>
          <span class="cc-title">developer.js</span>
        </div>
        <pre class="cc-body"><code><span class="ck">const</span> <span class="cv">kunajiny</span> = {
  <span class="ckey">name</span>:   <span class="cs">"Kunajiny R."</span>,
  <span class="ckey">role</span>:   <span class="cs">"Web Developer"</span>,
  <span class="ckey">stack</span>:  [<span class="cs">"HTML"</span>, <span class="cs">"CSS"</span>,
           <span class="cs">"JS"</span>, <span class="cs">"PHP"</span>],
  <span class="ckey">status</span>: <span class="cs">"Available 🟢"</span>,
  <span class="cfn">greet</span>() {
    <span class="ck">return</span> <span class="cs">"Let's build
    something great!"</span>;
  }
};</code></pre>
        <div class="cc-footer">
          <i class="fas fa-circle" style="color:#00c896;font-size:0.6rem"></i>
          <span style="color:#8892a4">Output: </span>
          <span style="color:#00c896">"Let's build something great!"</span>
        </div>
      </div>
    </div>
  </div>

  <div class="scroll-hint">
    <span>Scroll</span>
    <div class="scroll-line"></div>
  </div>
</section>

<!-- ═══ ABOUT ═══ -->
<section class="section" id="about">
  <div class="container">
    <p class="sec-label fade-up"><i class="fas fa-user-circle"></i> About Me</p>
    <h2 class="sec-title fade-up">The Developer<br/><span>Behind the Code</span></h2>

    <div class="about-grid">
      <div class="about-visual fade-up">
        <div class="av-outer">
          <div class="av-ring"></div>
          <div class="av-inner">KR</div>
          <div class="av-tag t1"><i class="fab fa-html5" style="color:#e34c26"></i></div>
          <div class="av-tag t2"><i class="fab fa-css3-alt" style="color:#264de4"></i></div>
          <div class="av-tag t3"><i class="fab fa-js-square" style="color:#f7df1e"></i></div>
          <div class="av-tag t4"><i class="fab fa-php" style="color:#8892be"></i></div>
        </div>
        <div class="exp-pill fade-up">
          <i class="fas fa-code" style="color:var(--accent)"></i>
          <div><strong>2+ Years</strong><span>Web Development</span></div>
        </div>
      </div>

      <div class="about-text fade-up">
        <h3>Passionate Web Developer</h3>
        <p>I'm <strong>Kunajiny Rengaraja</strong> — a web developer from <strong>Sri Lanka 🇱🇰</strong>
        who loves turning ideas into clean, fast, and beautiful digital experiences.</p>
        <p>I work across the full stack — designing interfaces, building PHP logic, and
        optimizing MySQL databases. Every line of code I write has purpose.</p>

        <div class="acards">
          <div class="ac"><i class="fas fa-palette"></i><div><b>Frontend</b><small>Pixel-perfect UI</small></div></div>
          <div class="ac"><i class="fas fa-server"></i><div><b>Backend</b><small>PHP & MySQL</small></div></div>
          <div class="ac"><i class="fas fa-mobile-alt"></i><div><b>Responsive</b><small>Mobile-first</small></div></div>
        </div>

        <div class="about-btns">
          <a href="#" class="btn-primary"><i class="fas fa-download"></i> Download CV</a>
          <div class="soc-row">
            <a href="#"><i class="fab fa-github"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-codepen"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══ SKILLS ═══ -->
<section class="section skills-sec" id="skills">
  <div class="container">
    <p class="sec-label fade-up"><i class="fas fa-layer-group"></i> Skill Set</p>
    <h2 class="sec-title fade-up">Tools I Work <span>With</span></h2>

    <div class="skills-cols">
      <div class="skill-bars fade-up">
        <?php
        $bars = [
          ["HTML5",      95, "#e34c26", "fab fa-html5"],
          ["CSS3",       90, "#264de4", "fab fa-css3-alt"],
          ["JavaScript", 78, "#f7df1e", "fab fa-js"],
          ["PHP",        74, "#8892be", "fab fa-php"],
          ["MySQL",      70, "#00758f", "fas fa-database"],
          ["Bootstrap",  85, "#7952b3", "fab fa-bootstrap"],
        ];
        foreach ($bars as $b): ?>
        <div class="sk-row">
          <div class="sk-meta">
            <span><i class="<?= $b[3] ?>" style="color:<?= $b[2] ?>"></i> <?= $b[0] ?></span>
            <strong><?= $b[1] ?>%</strong>
          </div>
          <div class="sk-track">
            <div class="sk-fill" data-w="<?= $b[1] ?>" style="--c:<?= $b[2] ?>"></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="tech-cloud fade-up">
        <?php
        $techs = [
          ["Git",       "fab fa-git-alt",   "#f05032"],
          ["GitHub",    "fab fa-github",     "#cdd9e5"],
          ["XAMPP",     "fas fa-server",     "#fb7a24"],
          ["VS Code",   "fas fa-code",       "#007acc"],
          ["Figma",     "fab fa-figma",      "#a259ff"],
          ["Responsive","fas fa-mobile-alt", "#00c896"],
          ["REST API",  "fas fa-plug",       "#ff9f43"],
          ["AJAX",      "fas fa-bolt",       "#ffd93d"],
          ["jQuery",    "fas fa-dollar-sign","#0769ad"],
          ["Linux",     "fab fa-linux",      "#fcc624"],
        ];
        foreach ($techs as $t): ?>
        <div class="tpill" style="--pc:<?= $t[2] ?>">
          <i class="<?= $t[1] ?>" style="color:<?= $t[2] ?>"></i> <?= $t[0] ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ═══ PROJECTS ═══ -->
<section class="section" id="projects">
  <div class="container">
    <p class="sec-label fade-up"><i class="fas fa-folder-open"></i> My Work</p>
    <h2 class="sec-title fade-up">Featured <span>Projects</span></h2>

    <div class="proj-grid">
      <?php
      $projects = [
        ["01","fas fa-user-tie","#00c896","Personal Portfolio",
         "Dark-themed responsive portfolio with PHP contact form, MySQL backend, custom cursor & smooth scroll animations.",
         ["HTML","CSS","PHP","MySQL","JS"],true],
        ["02","fas fa-store","#6c63ff","E-Commerce Store",
         "Full-featured online shop with cart, checkout, PHP backend & admin dashboard.",
         ["PHP","MySQL","Bootstrap","JS"],false],
        ["03","fas fa-graduation-cap","#ff6b6b","Student Manager",
         "CRUD system for student records, marks & attendance with PDF export.",
         ["PHP","MySQL","CSS","JS"],false],
        ["04","fas fa-cloud-sun","#ffd93d","Weather Dashboard",
         "Real-time weather app using OpenWeather API with animated UI & geolocation.",
         ["JavaScript","API","CSS3"],false],
        ["05","fas fa-comments","#54a0ff","Live Chat App",
         "Real-time AJAX chat with user auth, rooms, and persistent message history.",
         ["PHP","AJAX","MySQL","CSS"],false],
        ["06","fas fa-tasks","#ff9f43","Task Manager",
         "Drag-and-drop kanban board with priority tags, due dates & PHP sync.",
         ["JS","PHP","MySQL","CSS"],false],
      ];
      foreach ($projects as [$num,$icon,$clr,$title,$desc,$tags,$feat]): ?>
      <div class="pcard <?= $feat ? 'pcard-feat' : '' ?> fade-up" style="--pc:<?= $clr ?>">
        <div class="pcard-num"><?= $num ?></div>
        <div class="pcard-icon"><i class="<?= $icon ?>" style="color:<?= $clr ?>"></i></div>
        <h3><?= $title ?></h3>
        <p><?= $desc ?></p>
        <div class="pcard-tags">
          <?php foreach($tags as $t): ?><span><?= $t ?></span><?php endforeach; ?>
        </div>
        <div class="pcard-links">
          <a href="#"><i class="fas fa-external-link-alt"></i> Live</a>
          <a href="#"><i class="fab fa-github"></i> Code</a>
        </div>
        <?php if($feat): ?><div class="feat-badge"><i class="fas fa-star"></i> Featured</div><?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ═══ CONTACT ═══ -->
<section class="section" id="contact">
  <div class="container">
    <p class="sec-label fade-up"><i class="fas fa-satellite-dish"></i> Get In Touch</p>
    <h2 class="sec-title fade-up">Let's Build <span>Together</span></h2>

    <div class="contact-grid">
      <div class="contact-left fade-up">
        <p class="ctag">Have a project or just want to say hi? My inbox is always open. 👋</p>
        <div class="clist">
          <a href="mailto:kunajiny@example.com" class="citem">
            <div class="cicon"><i class="fas fa-envelope"></i></div>
            <div><strong>Email</strong><span>kunajiny@example.com</span></div>
          </a>
          <div class="citem">
            <div class="cicon"><i class="fas fa-map-marker-alt"></i></div>
            <div><strong>Location</strong><span>Sri Lanka 🇱🇰</span></div>
          </div>
          <div class="citem">
            <div class="cicon"><i class="fas fa-clock"></i></div>
            <div><strong>Availability</strong><span>Mon–Sat · 9AM–6PM</span></div>
          </div>
        </div>
        <div class="csocs">
          <a href="#"><i class="fab fa-github"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-codepen"></i></a>
        </div>
      </div>

      <div class="contact-right fade-up">
        <?php if($success_msg): ?>
        <div class="alert ok"><i class="fas fa-check-circle"></i> <?= $success_msg ?></div>
        <?php endif; ?>
        <?php if($error_msg): ?>
        <div class="alert err"><i class="fas fa-exclamation-circle"></i> <?= $error_msg ?></div>
        <?php endif; ?>

        <form method="POST" action="#contact" id="cForm">
          <div class="frow">
            <div class="fgroup">
              <label>Your Name</label>
              <div class="finput-wrap">
                <i class="fas fa-user"></i>
                <input type="text" name="name" placeholder="Kunajiny" required/>
              </div>
            </div>
            <div class="fgroup">
              <label>Email</label>
              <div class="finput-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="you@email.com" required/>
              </div>
            </div>
          </div>
          <div class="fgroup">
            <label>Subject</label>
            <div class="finput-wrap">
              <i class="fas fa-tag"></i>
              <input type="text" name="subject" placeholder="Project Inquiry"/>
            </div>
          </div>
          <div class="fgroup">
            <label>Message</label>
            <div class="finput-wrap ta">
              <i class="fas fa-comment-dots"></i>
              <textarea name="message" rows="5" placeholder="Tell me about your project..." required></textarea>
            </div>
          </div>
          <button type="submit" name="send_message" class="btn-primary sbtn">
            <i class="fas fa-paper-plane"></i> Send Message
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- ═══ FOOTER ═══ -->
<footer class="footer">
  <div class="footer-inner">
    <a href="#home" class="logo">
      <span class="lb">&lt;</span>KR<span class="ls">/</span><span class="lb">&gt;</span>
    </a>
    <p>Designed & Coded by <strong>Kunajiny Rengaraja</strong> — with ❤️ & lots of ☕</p>
    <p class="fcopy">&copy; <?= date('Y') ?> All rights reserved.</p>
  </div>
</footer>

<button class="stt" id="stt"><i class="fas fa-arrow-up"></i></button>
<script src="script.js"></script>
</body>
</html>
