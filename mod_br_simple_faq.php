<?php
/**
 * @package     BR Simple FAQ
 * @author      Janderson Moreira
 * @copyright   Copyright (C) 2026 Janderson Moreira
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Br\Module\SimpleFaq\Helper\SimpleFaqHelper;

require_once __DIR__ . '/src/Helper/SimpleFaqHelper.php';

// Coleta as configurações de estilo
$styleParams = [
    'max_width'       => $params->get('max_width', '800px'),
    'bg_title'        => $params->get('bg_title', '#f4f4f4'),
    'bg_active'       => $params->get('bg_title_active', '#e0e0e0'),
    'color_title'     => $params->get('color_title', '#333333'),
    'bg_answer'       => $params->get('bg_answer', '#ffffff'), 
    'color_content'   => $params->get('color_content', '#666666'),
    'border_color'    => $params->get('border_color', '#dddddd'),
    'border_radius'   => $params->get('border_radius', '4px'),
    'font_size_q'     => $params->get('font_size_q', '18px'),
    'font_size_a'     => $params->get('font_size_a', '16px'),
];

$faqHelper = new SimpleFaqHelper($params);
$faqItems  = $faqHelper->getItems();

// Prepara os dados para o layout
$displayData = [
    'faqItems'        => $faqItems,
    'styleParams'     => $styleParams,
    'module'          => $module,
    'params'          => $params,
    'moduleclass_sfx' => htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8')
];

// Carrega o layout
if (!empty($faqItems)) {
    require ModuleHelper::getLayoutPath('mod_br_simple_faq', $params->get('layout', 'default'));
}