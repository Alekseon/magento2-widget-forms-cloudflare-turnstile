<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\WidgetFormsCloudflareTurnstile\Plugin;

class CloudflareTurnstileConfigPlugin
{
    /**
     * @param \PixelOpen\CloudflareTurnstile\Block\Turnstile\Config $subject
     * @param array $config
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetTurnstileConfig(\PixelOpen\CloudflareTurnstile\Block\Turnstile\Config $subject, array $config)
    {
        $config['config']['forms'][] = 'alekseon_widget_form';
        return $config;
    }
}
