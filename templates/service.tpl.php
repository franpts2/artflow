<?php function drawServiceDisplay($service, $user, $db) { ?>
    <div id="service-display">
        <div id="service-imgs">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div id="service-img">
        <?php 
        $stmtImg = $db->prepare('SELECT images FROM Service WHERE id = ?');
        $stmtImg->execute([$service['id']]);
        $images = $stmtImg->fetchAll(PDO::FETCH_ASSOC);
        foreach ($images as $image) {
            echo '<img src="' . htmlspecialchars($image['images']) . '" alt="Service Image">';
        }
        ?>
        </div>
        <div id="service-detail">
            <div id="service-name">
                <h2><?= htmlspecialchars($service['title']) ?></h2>
                <p><?= htmlspecialchars($service['description']) ?></p>
            </div>
            <div id="service-info">
                <p id="price" class="service-info"><?= htmlspecialchars($service['price']) ?>€</p>
                <div id="service-delivery">
                    <img src="/images/logos/local_shipping.png" alt="Star Icon">
                    <p class="service-delivery" class="service-info">Delivery Time: </p>
                    <p class="service-delivery"><?= htmlspecialchars($service['delivery_time']) ?> days</p>
                </div>
                <div id="service-options">
                    <button id="message" class="service-options">Message</button>
                    <button id="payment" class="service-options">Continue to Payment</button>
                <div>
            </div>
        </div>
    </div>
<?php } ?>