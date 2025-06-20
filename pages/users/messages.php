<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once(__DIR__ . '/../../database/session.php');
require_once(__DIR__ . '/../../templates/home.tpl.php');
require_once(__DIR__ . '/../../database/classes/message.class.php');

$session = Session::getInstance();
$user = $session->getUser() ?? null;

if (!$user) {
    header('Location: /');
    exit();
}

drawHeader($user);

$directMessageUserId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;

try {
    $conversations = Message::getConversationsForUser($user['id']);
?>
    <link rel="stylesheet" href="/css/main.css">
    <?php include_once(__DIR__ . '/../../templates/irreversible-modal.tpl.php'); ?>
    <div id='messages-page'>
        <div class="chat-app__container">
            <aside class="chat-app__sidebar">
                <h1 class="chat-app__title">chats</h1>
                <div class="chat-app__search-bar">
                    <input class="chat-app__search-input" type="text" placeholder="Search here..." id="conversation-search" />
                    <img class="chat-app__search-icon" src="/images/logos/search.png" alt="search icon" />
                </div>
                <div class="chat-app__chat-list" id="conversation-list">
                    <?php if (empty($conversations)): ?>
                        <p class="chat-app__no-conversations">No conversations yet. Start chatting with someone!</p>
                    <?php else: ?>
                        <?php foreach ($conversations as $conversation):
                            $otherUserId = ($conversation['sender_id'] == $user['id']) ? $conversation['receiver_id'] : $conversation['sender_id'];
                            $profileImage = $conversation['other_profile_image'] ? $conversation['other_profile_image'] : '/images/user_pfp/default.png';
                            $previewText = strlen($conversation['message']) > 25 ? substr($conversation['message'], 0, 25) . '...' : $conversation['message'];
                        ?>
                            <div class="chat-app__chat-item" data-user-id="<?= $otherUserId ?>">
                                <img src="<?= htmlspecialchars($profileImage) ?>" alt="profile" class="chat-app__avatar" />
                                <div class="chat-app__chat-text">
                                    <div class="chat-app__username"><?= htmlspecialchars($conversation['other_username']) ?></div>
                                    <div class="chat-app__message-preview"><?= htmlspecialchars($previewText) ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </aside>

            <main class="chat-app__main">
                <div class="chat-app__header">
                    <div class="chat-app__back-button" id="back-to-conversations">
                        <span class="chat-app__back-icon">←</span>
                    </div>
                    <span id="current-chat-user"></span>
                    <div class="chat-app__menu-container">
                        <span class="chat-app__menu-button">⋯</span>
                        <div class="chat-app__dropdown-menu">
                            <div class="chat-app__dropdown-item" id="visit-profile">Visit Profile</div>
                            <div class="chat-app__dropdown-item" id="delete-conversation">Delete Conversation</div>
                        </div>
                    </div>
                </div>
                <div class="chat-app__messages" id="messages-container">
                    <div class="chat-app__empty-state">
                        <p>Select a conversation to start chatting</p>
                    </div>
                </div>
                <div class="chat-app__input-area">
                    <input class="chat-app__input" type="text" placeholder="Type a message here..." id="message-input" disabled />
                    <button class="chat-app__send-button" id="send-button" disabled>➤</button>
                </div>
            </main>
        </div>
    </div>

    <script>
        const currentUser = <?= json_encode([
                                'id' => $user['id'],
                                'username' => $user['username'],
                                'profile_image' => $user['profile_image'] ?? '/images/user_pfp/default.png'
                            ]) ?>;

        <?php if ($directMessageUserId): ?>
            document.addEventListener("DOMContentLoaded", function() {
                const existingItem = document.querySelector(`.chat-app__chat-item[data-user-id="<?= $directMessageUserId ?>"]`);

                if (existingItem) {
                    existingItem.click();
                } else {
                    createOrSelectConversation(<?= $directMessageUserId ?>);
                }
            });
        <?php endif; ?>
    </script>
    <script src="/js/users/messages.js"></script>

<?php
} catch (Exception $e) {
    echo '<div class="error" style="color: red; padding: 20px; margin: 20px; background: #ffeeee;">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
    error_log('Messages page error: ' . $e->getMessage());
}

drawFooter($user);
?>