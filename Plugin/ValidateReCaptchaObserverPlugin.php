<?php
/**
 * Copyright © Alekseon sp. z o.o.
 * http://www.alekseon.com/
 */
namespace Alekseon\WidgetFormsCloudflareTurnstile\Plugin;

use Alekseon\CustomFormsBuilder\Model\Form;
use Alekseon\WidgetForms\Controller\Form\Submit;
use Alekseon\WidgetFormsReCaptcha\Observer\ValidateReCaptchaObserver;

class ValidateReCaptchaObserverPlugin
{
    /**
     * @var \PixelOpen\CloudflareTurnstile\Model\Validator
     */
    private $validator;
    /**
     * @var \Alekseon\WidgetFormsReCaptcha\Model\Ajax\ErrorProcessor
     */
    private $errorProcessor;

    /**
     * @param \PixelOpen\CloudflareTurnstile\Model\Validator $validator
     * @param \Alekseon\WidgetFormsReCaptcha\Model\Ajax\ErrorProcessor $errorProcessor
     */
    public function __construct(
        \PixelOpen\CloudflareTurnstile\Model\Validator $validator,
        \Alekseon\WidgetFormsReCaptcha\Model\Ajax\ErrorProcessor $errorProcessor
    ) {
        $this->validator = $validator;
        $this->errorProcessor = $errorProcessor;
    }

    /**
     * @param ValidateReCaptchaObserver $observer
     * @param Form $form
     * @param Submit $controller
     * @param bool $isValidated
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeValidateCaptcha(
        ValidateReCaptchaObserver $observer,
        Form $form,
        Submit $controller,
        bool $isValidated = false
    ) {
        if ($form->getRecaptchaType() == ReCaptchaTypeSourcePluginPlugin::CLOUDFLARE_CAPTCHA_VALUE) {
            $response = $controller->getRequest()->getParam('cf-turnstile-response');
            try {
                if (!$this->validator->isValid($response)) {
                    $this->errorProcessor->processError(
                        $controller->getResponse(),
                        __('Security validation error: %1', join(', ', $this->validator->getErrorMessages()))
                    );
                }
            } catch (\Exception $e) {
                $this->errorProcessor->processError(
                    $controller->getResponse(),
                    __('Security validation error: %1', $e->getMessage())
                );
            }
            $isValidated = true;
        }
        return [$form, $controller, $isValidated];
    }
}
