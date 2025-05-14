<?php 
require_once(__DIR__ . '/includes/session.php');
require_once(__DIR__ . '/includes/categories.php');
$session = Session::getInstance();
$user = $session->getUser() ?? null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>artflow</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <header>
            <h1 class='artflow-text'>artflow</h1>
            <nav id="menu">
                <input type="checkbox" id="nav_bar">
                <label class="nav_bar" for="nav_bar"></label>
                <ul id="buttons">
                    <?php if ($user): ?>
                        <li>
                            <form action="/actions/logout.php" method="post">
                                <button type="submit" class="button filled hovering">
                                    <?= htmlspecialchars($user['username']) ?> - Logout
                                </button>
                            </form>
                        </li>
                    <?php else: ?>
                        <li><button class="button filled hovering">Sign Up</button></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
        <main class="container">
            <section id="title">
                <h2>where creativity<br>
                <span class='flow-text'>flows</span> seamlessly</h2>
                <p>a collection of diverse artistic talents</p>
                <div id="boxes">
                    <div class="box" id="box1"></div>
                    <div class="box" id="box2"></div>
                    <div class="box" id="box3"></div>
                </div>
            </section>
            <section id="categories">
                <div id="block">
                    <h2>Explore categories</h2>
                    <div id="category-list">
                        <?php $categories = getCategories(); ?>
                        <?php foreach ($categories as $index => $category): ?>
                            <?php if ($index >= 6) break; // limit to the first 6 categories ?>
                            <div class="category-item">
                                <a class="category-link"><?= htmlspecialchars($category['category_type']) ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a id="link">see more -></a>
                </div>
            </section>
            <section id="info">
                <div>
                    <h2>Our motivation</h2>
                    <p>Etiam pellentesque tempus rutrum. Nullam eget nisl nec nulla ultrices commodo eget eget erat. Phasellus non rutrum erat. Duis nec rhoncus enim. Sed condimentum, odio facilisis maximus aliquet, tellus arcu consequat nibh, nec ultrices erat mauris vitae nisi. In maximus posuere egestas. Aenean congue justo non augue eleifend eleifend. Pellentesque dapibus, orci vitae tempus posuere, dolor risus dapibus augue, sed vehicula orci neque ac orci. Phasellus auctor vulputate volutpat.</p>
                </div>
            </section>
            <footer id="end">
                <h2>Artflow</h2>
                <div id="end-content">
                    <div id="authors">
                        <h3>Developed by:</h3>
                        <ul>
                            <li class="author">@ Francisca Portugal</li>
                            <li class="author">@ Gabriela de Mattos</li>
                            <li class="author">@ Maria Luiza Vieira</li>
                        </ul>
                    </div>
                    <div id="footer-links">
                        <h3>Quick Links:</h3>
                        <ul>
                            <li class="footer-link"><a>Home</a></li>
                            <li class="footer-link"><a>Page 1</a></li>
                            <li class="footer-link"><a>Page 2</a></li>
                        </ul>
                    </div>
                </div>
                <div id="end-footer">
                    <p>This website was built in the context of the course Linguagens e Tecnologias Web of the Bachelor’s Informatics and Computing Engineering of University of Porto .</p>
                    <p>© All rights reserved.</p>
                </div>
            </footer>
        </main>
        <?php if (!$user): ?>
            <?php include 'pages/modals/sign-up-modal.php'; ?>
            <?php include 'pages/modals/sign-in-modal.php'; ?>
            <?php include 'pages/modals/go-with-flow-modal.php'; ?>
        <?php endif; ?>
        
        <script src="js/script.js"></script>
    </body>
</html>

