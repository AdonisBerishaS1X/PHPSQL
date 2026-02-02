<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orks – Warhammer 40,000 Codex</title>
    <style>
        body {
            background-color: #0f1115;
            color: #e6e6e6;
            font-family: "Segoe UI", sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1c1f26;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h1 {
            color: #c9a24d;
        }
        nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        nav a {
            color: #e6e6e6;
            text-decoration: none;
            font-weight: 500;
        }
        nav a:hover {
            color: #c9a24d;
        }
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            position: relative;
        }
        .side-img {
            position: absolute;
            top: 40px;
            width: 260px;
            height: 340px;
            object-fit: cover;
            border-radius: 16px;
            box-shadow: 0 0 25px rgba(201, 162, 77, 0.2);
        }
        .side-img.left {
            left: 40px;
        }
        .side-img.right {
            right: 40px;
        }
        .lore-box {
            background-color: #1c1f26;
            border-radius: 16px;
            padding: 40px 60px;
            max-width: 700px;
            margin: 0 320px;
            box-shadow: 0 0 25px rgba(201, 162, 77, 0.2);
            text-align: center;
        }
        .lore-box h2 {
            color: #c9a24d;
            margin-bottom: 20px;
        }
        .lore-box p {
            color: #9da5b4;
            font-size: 1.15rem;
            line-height: 1.7;
        }
        .center-img {
            right: 0;
            left: 0;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }
        @media (min-width: 1201px) {
            .center-img {
                position: absolute;
                right: 40px;
                left: auto;
                margin: 0;
            }
        }
        @media (max-width: 1200px) {
            .center-img {
                position: static;
                margin: 20px auto 0 auto;
                display: block;
            }
        }
        @media (max-width: 1200px) {
            .main-content {
                flex-direction: column;
            }
            .side-img.left, .side-img.right {
                position: static;
                width: 90vw;
                height: 200px;
                margin: 20px auto;
                display: block;
            }
            .lore-box {
                margin: 20px auto;
                padding: 30px 10px;
            }
        }
    </style>
</head>
<body>
<header>
    <h1>Warhammer 40,000 Codex</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
        <a href="rules.html">Rules</a>
        <a href="php/login.php" class="login-btn">Login</a>
    </nav>
</header>
<main class="main-content">
    <img src="wagh.jpg" alt="Ork Banner" class="side-img left">
    <div class="lore-box">
        <h2>The Orks</h2>
        <p>
            The Orks, also called Greenskins, are a savage, warlike, green-skinned species of bestial, asexual humanoids who are spread all across the galaxy. They are unique among the intelligent xenos species known to Mankind in that they possess the physiological features of both animals and fungi. They share many physical and cultural features with the dark fantasy Warhammer universe's Orcs (and were initially called "Space Orcs" to distinguish them).

Orks are seen by their enemies (pretty much everyone else in the universe) as primitive, barbaric, hyper-violent, and crude, but they are the most successful and widepsread intelligent species in the whole galaxy, outnumbering possibly every other intelligent starfaring species, even Humanity (with the very plausible exception of the Tyranids).

An Ork  holding the head of an  of the .
An Ork Boy holding the head of an Imperial Guardsman of the Maccabian Janissaries.

Greenskins are one of the most dangerous alien races to plague the galaxy. Numerous beyond belief and driven always to fight and conquer, the Orks threaten every single intelligent species of the galaxy.

Orks are possibly the most warlike aliens in the 41st Millennium, and their number is beyond counting. Amid constant, seething tides of battle and bloodshed, burgeoning Ork stellar empires rise and fall.

Mercifully most are short-lived, soon destroying themselves in a maelstrom of violence and internecine conflict, but should the Orks ever truly unify, they would crush all opposition.

Orks generate a potent psychic gestalt field that allows them to accomplish many feats of technological engineering that might otherwise seem impossible. At the same time, the power of this psychic field is directly proportional to the number of Greenskins present in a given location.

The more Orks that gather, the more Orks are drawn to them, at the same time that the power and intelligence of the Greenskins begins to grow with their numbers.

The Orks' unquenchable thirst for battle has always proved their downfall: historically, the Ork tribes have spent much of their time fighting amongst themselves, waging brutal wars with only the strongest surviving. On occasion, an Ork leader will emerge who is mighty enough to defeat his rivals and unite the warring tribes.

His success draws other tribes to him, and soon a great WAAAGH! is underway -- partly a migration, partly a holy war that can exterminate the populations of entire star systems.

When the Orks are on the rampage, the galaxy trembles, and in the Age of the Dark Imperium there are more WAAAGH!s rising than ever before recorded.
        </p>
    </div>
    <img src="orksorksorks.png" alt="Ork Art" class="side-img right center-img">
</main>
</body>
</html>
