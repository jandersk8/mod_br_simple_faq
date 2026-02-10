<?php
/**
 * @package     BR Simple FAQ
 * @author      Janderson Moreira
 * @copyright   Copyright (C) 2026 Janderson Moreira
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Br\Module\SimpleFaq\Helper;

defined('_JEXEC') or die;

class SimpleFaqHelper
{
    protected $params;

    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Recupera os 10 itens de FAQ do XML e retorna apenas os preenchidos
     */
    public function getItems()
    {
        $items = [];

        for ($i = 1; $i <= 10; $i++) {
            $question = $this->params->get('q' . $i, '');
            $answer   = $this->params->get('a' . $i, '');

            // Só adiciona se a pergunta não estiver vazia
            if (!empty(trim($question))) {
                $items[] = [
                    'question' => $question,
                    'answer'   => $answer
                ];
            }
        }

        return $items;
    }
}