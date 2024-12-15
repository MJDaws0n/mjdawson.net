<?php
require_once dirname(__FILE__).'/../../vendor/autoload.php';

function getPathSegments() {
    return array_filter(explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/')));
}

if(getPathSegments()[0] == 'chat'){
    echo "<p id='text'>Redirecting to unique generated chat url..</p>";
    echo '<script>window.location.href = "https://chat-v1.mjdawson.net";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/reset.css">
    <link rel="stylesheet" href="/assets/home.css">
    <title>MJDawson</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="">MJDawson</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#freelance">Freelance</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#home">Home</a></li>
            </ul>
        </nav>

        <div>
            <h1>MJDawson</h1>
            <img id="logo" src="https://avatars.githubusercontent.com/u/66313685" alt="mjdawson">
        </div>
    </header>

    <!-- About Me -->
    <section>
        <div>
            <h2>About Me</h2>
            <p>
                Hi, I'm Max, but you might know me as MJDawson. I'm a passionate tech enthusiast based in the UK with a knack for building innovative solutions.
                As the founder of WebWorks, I'm dedicated to creating efficient and user-friendly web technologies, including tools like WebWorks RapidServe and AutoGate.
                My work revolves around making the internet more accessible and streamlined, combining creativity with technical expertise.
                <br><br>
                When I'm not immersed in coding or brainstorming new ideas,
                I enjoy diving into the world of computer science and exploring new ways to push the boundaries of technology.
                Whether it's developing programming languages, optimizing backend systems, or creating secure verification tools,
                I thrive on turning complex challenges into practical solutions.
            </p>
        </div>
        <div>
            <div class="project-square">
                <a href="https://en.wikipedia.org/wiki/HTML"><img src="/assets/images/html.png" alt="html"></a>
                <a href="https://en.wikipedia.org/wiki/CSS"><img src="/assets/images/css.png" alt="css"></a>
                <a href="https://github.com/MJDaws0n/"><img src="/assets/images/github.png" alt="github"></a>
                <a href="https://en.wikipedia.org/wiki/JavaScript"><img src="/assets/images/js.png" alt="js"></a>
                <a href="https://www.php.net/"><img src="/assets/images/php.png" alt="php"></a>
                <a href="https://nodejs.org/en"><img src="/assets/images/node.png" alt="node"></a>
                <a href="https://www.mysql.com/"><img src="/assets/images/mysql.png" alt="mysql"></a>
                <a href="https://webworkshub.online/"><img src="/assets/images/webworks.png" alt="webworks"></a>
                <a href="https://en.wikipedia.org/wiki/Linux"><img src="/assets/images/linux.png" alt="linux"></a>
            </div>
            <h3 class="see-projects" onclick="window.location.href='#projects';">See my projects</h3>
        </div>
    </section>
</body>
</html>