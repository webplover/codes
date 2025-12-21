<?php

/**
 * Mobile Bottom Action Bar
 */

// Configuration - Customize for each site
function wpr_mobile_bar_config()
{
  return array(
    'theme_color' => '#701E7D', // Change this hex color for each site
    'chat' => array(
      'enabled' => true,
      'label' => 'Chat',
      'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>',
      'type' => 'tawk', // Options: 'tawk', 'tidio', 'intercom', 'zendesk', 'drift'
    ),
    'whatsapp' => array(
      'enabled' => true,
      'label' => 'WhatsApp',
      'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>',
      'number' => '+1234567890',
    ),
    'trial' => array(
      'enabled' => true,
      'label' => 'Free Trial',
      'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>',
      'url' => '/start-free-trial',
    ),
    'call' => array(
      'enabled' => true,
      'label' => 'Call',
      'svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>',
      'number' => '+1234567890',
    ),
  );
}

// Add the bottom bar HTML
add_action('wp_footer', function () {
  $config = wpr_mobile_bar_config();
  $buttons = array_filter($config, function ($btn) {
    return isset($btn['enabled']) && $btn['enabled'];
  });

  if (empty($buttons)) return;
?>
  <div id="wpr-mobile-bottom-bar" class="wpr-mobile-bottom-bar">
    <?php foreach ($buttons as $key => $button) : ?>
      <?php if ($key === 'chat') : ?>
        <button class="wpr-bar-btn" onclick="wprOpenChat('<?php echo esc_js($button['type']); ?>')" aria-label="<?php echo esc_attr($button['label']); ?>">
          <span class="wpr-bar-icon"><?php echo $button['svg']; ?></span>
          <span class="wpr-bar-label"><?php echo esc_html($button['label']); ?></span>
        </button>
      <?php elseif ($key === 'whatsapp') : ?>
        <a href="https://wa.me/<?php echo esc_attr(preg_replace('/[^0-9]/', '', $button['number'])); ?>"
          class="wpr-bar-btn"
          target="_blank"
          rel="noopener"
          aria-label="<?php echo esc_attr($button['label']); ?>">
          <span class="wpr-bar-icon"><?php echo $button['svg']; ?></span>
          <span class="wpr-bar-label"><?php echo esc_html($button['label']); ?></span>
        </a>
      <?php elseif ($key === 'call') : ?>
        <a href="tel:<?php echo esc_attr($button['number']); ?>"
          class="wpr-bar-btn"
          aria-label="<?php echo esc_attr($button['label']); ?>">
          <span class="wpr-bar-icon"><?php echo $button['svg']; ?></span>
          <span class="wpr-bar-label"><?php echo esc_html($button['label']); ?></span>
        </a>
      <?php elseif ($key === 'trial') : ?>
        <a href="<?php echo esc_url($button['url']); ?>"
          class="wpr-bar-btn"
          aria-label="<?php echo esc_attr($button['label']); ?>">
          <span class="wpr-bar-icon"><?php echo $button['svg']; ?></span>
          <span class="wpr-bar-label"><?php echo esc_html($button['label']); ?></span>
        </a>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
<?php
});

// Add CSS
add_action('wp_head', function () {
  $config = wpr_mobile_bar_config();
  $theme_color = isset($config['theme_color']) ? $config['theme_color'] : '#0073aa';

  // Convert hex to RGB for alpha variations
  $hex = str_replace('#', '', $theme_color);
  $r = hexdec(substr($hex, 0, 2));
  $g = hexdec(substr($hex, 2, 2));
  $b = hexdec(substr($hex, 4, 2));
?>
  <style>
    :root {
      --wpr-bar-theme-color: <?php echo esc_attr($theme_color); ?>;
      --wpr-bar-theme-rgb: <?php echo "$r, $g, $b"; ?>;
    }

    .wpr-mobile-bottom-bar {
      display: none !important;
      position: fixed !important;
      bottom: 0 !important;
      left: 0 !important;
      right: 0 !important;
      background: rgba(255, 255, 255, 0.95) !important;
      backdrop-filter: blur(10px) !important;
      -webkit-backdrop-filter: blur(10px) !important;
      border-top: 1px solid rgba(0, 0, 0, 0.08) !important;
      z-index: 9999 !important;
      gap: 8px !important;
      margin: 0 !important;
      box-sizing: border-box !important;
    }

    @media (max-width: 768px) {
      .wpr-mobile-bottom-bar {
        display: flex !important;
        justify-content: space-around !important;
        align-items: center !important;
      }

      body {
        padding-bottom: 75px !important;
      }
    }

    .wpr-mobile-bottom-bar .wpr-bar-btn {
      display: flex !important;
      flex-direction: column !important;
      align-items: center !important;
      justify-content: center !important;
      flex: 1 !important;
      padding: 10px 6px !important;
      background: transparent !important;
      border: none !important;
      color: var(--wpr-bar-theme-color) !important;
      text-decoration: none !important;
      cursor: pointer !important;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
      font-size: 11px !important;
      min-height: 58px !important;
      position: relative !important;
      margin: 0 !important;
      box-sizing: border-box !important;
    }

    .wpr-mobile-bottom-bar .wpr-bar-btn:hover,
    .wpr-mobile-bottom-bar .wpr-bar-btn:active {
      background: rgba(var(--wpr-bar-theme-rgb), 0.08) !important;
      transform: translateY(-1px) !important;
    }

    .wpr-mobile-bottom-bar .wpr-bar-btn:active {
      transform: translateY(0) !important;
      background: rgba(var(--wpr-bar-theme-rgb), 0.12) !important;
    }

    .wpr-mobile-bottom-bar .wpr-bar-icon {
      display: block !important;
      margin-bottom: 5px !important;
      line-height: 1 !important;
      transition: transform 0.2s ease !important;
    }

    .wpr-mobile-bottom-bar .wpr-bar-btn:hover .wpr-bar-icon {
      transform: scale(1.1) !important;
    }

    .wpr-mobile-bottom-bar .wpr-bar-icon svg {
      width: 24px !important;
      height: 24px !important;
      display: block !important;
      stroke-width: 1.5 !important;
    }

    .wpr-mobile-bottom-bar .wpr-bar-label {
      font-size: 11px !important;
      line-height: 1.2 !important;
      text-align: center !important;
      display: block !important;
      font-weight: 500 !important;
      letter-spacing: 0.01em !important;
      margin: 0 !important;
      padding: 0 !important;
    }
  </style>
<?php
});

// Add JavaScript for chat integration
add_action('wp_footer', function () {
?>
  <script>
    function wprOpenChat(chatType) {
      switch (chatType) {
        case 'tawk':
          if (typeof Tawk_API !== 'undefined' && Tawk_API.maximize) {
            Tawk_API.maximize();
          }
          break;

        case 'tidio':
          if (typeof tidioChatApi !== 'undefined') {
            tidioChatApi.open();
          }
          break;

        case 'intercom':
          if (typeof Intercom !== 'undefined') {
            Intercom('show');
          }
          break;

        case 'zendesk':
          if (typeof zE !== 'undefined') {
            zE('messenger', 'open');
          }
          break;

        case 'drift':
          if (typeof drift !== 'undefined') {
            drift.api.openChat();
          }
          break;

        default:
          console.log('Chat widget not configured or loaded');
      }
    }
  </script>
<?php
});
?>
