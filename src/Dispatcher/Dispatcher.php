<?php
/**
 * @package     BR Simple FAQ
 * @author      Janderson Moreira
 * @copyright   Copyright (C) 2026 Janderson Moreira
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Br\Module\SimpleFaq\Dispatcher;

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Br\Module\SimpleFaq\Helper\SimpleFaqHelper;

/**
 * Dispatcher para o módulo BR Simple FAQ.
 */
class Dispatcher extends AbstractModuleDispatcher
{
    /**
     * Prepara os dados que serão enviados para o layout (tmpl/default.php)
     *
     * @return  array
     */
    protected function getLayoutData(): array
    {
        // Pega os dados padrão do Joomla (params, module, app, etc)
        $data = parent::getLayoutData();

        // Instancia o Helper do FAQ
        $helper = new SimpleFaqHelper($this->params);

        // Injetamos os itens processados e as cores no array $data
        // No layout (default.php), os dados estarão em $displayData
        $data['faqItems']    = $helper->getItems();
        $data['styleParams'] = [
            'max_width'       => $this->params->get('max_width', '800px'),
            'bg_title'        => $this->params->get('bg_title', '#f4f4f4'),
            'bg_active'       => $this->params->get('bg_title_active', '#e0e0e0'),
            'color_title'     => $this->params->get('color_title', '#333333'),
            'bg_answer'       => $this->params->get('bg_answer', '#ffffff'),
            'color_content'   => $this->params->get('color_content', '#666666'),
            'border_color'    => $this->params->get('border_color', '#dddddd'),
            'border_radius'   => $this->params->get('border_radius', '4px'),
            'font_size_q'     => $this->params->get('font_size_q', '18px'),
            'font_size_a'     => $this->params->get('font_size_a', '16px'),
        ];

        return $data;
    }
}