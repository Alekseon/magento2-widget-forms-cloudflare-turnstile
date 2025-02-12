<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\WidgetFormsCloudflareTurnstile\Plugin;

use Alekseon\WidgetFormsReCaptcha\Model\Attribute\Source\ReCaptchaType;

class ReCaptchaTypeSourcePluginPlugin
{
    const CLOUDFLARE_CAPTCHA_VALUE = 'cloudflare_turnstile';

    /**
     * @param ReCaptchaType $subject
     * @param array $options
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetOptions(ReCaptchaType $subject, array $options)
    {
        $options[self::CLOUDFLARE_CAPTCHA_VALUE] = __('Cloudflare Turnstile');
        return $options;
    }
}
