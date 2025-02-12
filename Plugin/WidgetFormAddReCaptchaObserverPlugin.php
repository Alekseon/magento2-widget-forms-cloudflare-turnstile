<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\WidgetFormsCloudflareTurnstile\Plugin;

use Alekseon\CustomFormsBuilder\Model\Form;
use Alekseon\WidgetFormsReCaptcha\Observer\WidgetFormAddReCaptchaObserver;
use Magento\Framework\View\Element\Template;

class WidgetFormAddReCaptchaObserverPlugin
{
    /**
     * @param WidgetFormAddReCaptchaObserver $observer
     * @param Form $form
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetRecaptchaBlockClass(WidgetFormAddReCaptchaObserver $observer, string $class, Form $form)
    {
        if ($form->getRecaptchaType() == ReCaptchaTypeSourcePluginPlugin::CLOUDFLARE_CAPTCHA_VALUE) {
            $class = \PixelOpen\CloudflareTurnstile\Block\Turnstile::class;
        }
        return $class;
    }

    /**
     * @param WidgetFormAddReCaptchaObserver $observer
     * @param Form $form
     * @param Template $recaptchaBlock
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforePrepareRecaptchaBlock(
        WidgetFormAddReCaptchaObserver $observer,
        Form $form,
        Template $recaptchaBlock
    ) {
        if ($form->getRecaptchaType() == ReCaptchaTypeSourcePluginPlugin::CLOUDFLARE_CAPTCHA_VALUE) {
            $recaptchaBlock->setAction('alekseon_widget_form');
        }
    }
}
