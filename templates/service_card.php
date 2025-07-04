<?php
function drawServiceCard($service, $serviceImage = null, $subcatIdsStr = '')
{
    require_once(__DIR__ . '/../database/classes/service.class.php');
    
    // update the rating and get the latest value directly from database
    Service::updateAverageRating($service['id']);
    $db = Database::getInstance();
    $stmt = $db->prepare('SELECT avg_rating FROM Service WHERE id = ?');
    $stmt->execute([$service['id']]);
    $updatedService = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $avgRating = isset($updatedService['avg_rating']) ? (float)$updatedService['avg_rating'] : 0;
    $formattedRating = number_format($avgRating, 1);

?>
    <a href="/pages/services/service.php?id=<?= htmlspecialchars($service['id']) ?>" class="service-card-link">
        <div class="service-card" data-subcategory-ids="<?= htmlspecialchars($subcatIdsStr) ?>">
            <div class="pantone-image-wrapper">
                <?php if ($serviceImage): ?>
                    <img src="<?= htmlspecialchars($serviceImage) ?>" alt="Service image" class="pantone-image" />
                <?php else: ?>
                    <div class="pantone-image pantone-image-placeholder"></div>
                <?php endif; ?>
            </div>
            <div class="pantone-title"><?= htmlspecialchars($service['title']) ?></div>
            <div class="pantone-info-row">
                <span class="pantone-username"><?= htmlspecialchars($service['username']) ?></span>
                <span class="pantone-rating">★ <?= $formattedRating ?></span>
                <span class="pantone-price"><?= htmlspecialchars($service['price']) ?>€</span>

            </div>
        </div>
    </a>
<?php
}
?>