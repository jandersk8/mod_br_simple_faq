<?php
/**
 * @package     BR Simple FAQ
 * @author      Janderson Moreira
 * @copyright   Copyright (C) 2026 Janderson Moreira
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/** * Mapeamento de dados vindos do arquivo principal
 * No Joomla 5/6 moderno, os dados chegam via $displayData
 */
$faqItems        = $displayData['faqItems'] ?? [];
$styleParams     = $displayData['styleParams'] ?? [];
$moduleclass_sfx = $displayData['moduleclass_sfx'] ?? ''; // Adicionado para corrigir o Warning
$module_id       = 'br-faq-' . $module->id;
?>

<style>
#<?php echo $module_id; ?>.br-faq-container {
    max-width: <?php echo $styleParams['max_width']; ?>;
    margin: 0 auto;
    font-family: sans-serif;
}

#<?php echo $module_id; ?> .br-faq-item {
    border: 1px solid <?php echo $styleParams['border_color']; ?>;
    border-radius: <?php echo $styleParams['border_radius']; ?>;
    margin-bottom: 10px;
    overflow: hidden;
    background-color: transparent;
}

#<?php echo $module_id; ?> .br-faq-trigger {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    cursor: pointer;
    background-color: <?php echo $styleParams['bg_title']; ?>;
    color: <?php echo $styleParams['color_title']; ?>;
    font-size: <?php echo $styleParams['font_size_q']; ?>;
    font-weight: bold;
    transition: background-color 0.3s ease;
    user-select: none;
}

#<?php echo $module_id; ?> .br-faq-trigger:hover,
#<?php echo $module_id; ?> .br-faq-item.active .br-faq-trigger {
    background-color: <?php echo $styleParams['bg_active']; ?>;
}

#<?php echo $module_id; ?> .br-faq-icon {
    width: 20px;
    height: 20px;
    transition: transform 0.3s ease;
}

#<?php echo $module_id; ?> .br-faq-item.active .br-faq-icon {
    transform: rotate(180deg);
}

#<?php echo $module_id; ?> .br-faq-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background-color: <?php echo $styleParams['bg_answer']; ?>;
}

#<?php echo $module_id; ?> .br-faq-content-inner {
    padding: 20px;
    color: <?php echo $styleParams['color_content']; ?>;
    font-size: <?php echo $styleParams['font_size_a']; ?>;
    line-height: 1.6;
}
</style>

<div id="<?php echo $module_id; ?>" class="br-faq-container <?php echo $moduleclass_sfx; ?>">
    <?php if (!empty($faqItems)) : ?>
        <?php foreach ($faqItems as $item) : ?>
            <div class="br-faq-item" itemscope itemtype="https://schema.org/Question">
                <div class="br-faq-trigger">
                    <span itemprop="name"><?php echo htmlspecialchars($item['question']); ?></span>
                    <div class="br-faq-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                </div>
                <div class="br-faq-content" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="br-faq-content-inner" itemprop="text">
                        <?php echo $item['answer']; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('<?php echo $module_id; ?>');
    if (!container) return;
    
    const items = container.querySelectorAll('.br-faq-item');

    items.forEach(item => {
        const trigger = item.querySelector('.br-faq-trigger');
        const content = item.querySelector('.br-faq-content');

        trigger.addEventListener('click', () => {
            const isOpen = item.classList.contains('active');

            // Fecha todos os outros
            items.forEach(i => {
                i.classList.remove('active');
                i.querySelector('.br-faq-content').style.maxHeight = null;
            });

            // Se não estava aberto, abre o atual
            if (!isOpen) {
                item.classList.add('active');
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    });
});
</script>