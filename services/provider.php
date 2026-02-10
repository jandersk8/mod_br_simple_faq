<?php
/**
 * @package     BR Simple FAQ
 * @author      Janderson Moreira
 * @copyright   Copyright (C) 2026 Janderson Moreira
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{
    /**
     * Registra os serviços do módulo no Container de Injeção de Dependência
     *
     * @param   Container  $container  O container DI
     *
     * @return  void
     */
    public function register(Container $container)
    {
        // 1. Registra a Fábrica de Dispatchers usando o namespace do FAQ
        $container->registerServiceProvider(new ModuleDispatcherFactory('Br\\Module\\SimpleFaq'));

        // 2. Registra o serviço padrão de Módulo do Joomla
        $container->registerServiceProvider(new Module());
    }
};