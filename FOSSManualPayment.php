<?php
/**
 * Manual Payment Gateway for FOSSBilling
 * Version: 1.0.0
 * Author: alex2276564
 * GitHub: https://github.com/alex2276564/FOSSManualPayment
 */
class Payment_Adapter_FOSSManualPayment implements FOSSBilling\InjectionAwareInterface
{
    protected ?Pimple\Container $di = null;

    public function setDi(Pimple\Container $di): void
    {
        $this->di = $di;
    }

    public function getDi(): ?Pimple\Container
    {
        return $this->di;
    }

    public function __construct(private $config)
    {
    }

    public static function getConfig()
    {
        $customHtmlFields = [
            'custom_html' => 'Custom HTML',
            'custom_html2' => 'Custom HTML form 2',
            'custom_html3' => 'Custom HTML form 3',
        ];

        $formConfig = [];
        foreach ($customHtmlFields as $fieldName => $label) {
            $formConfig[$fieldName] = [
                'textarea',
                [
                    'label' => $label,
                    'required' => false,
                    'description' => 'Enter your custom HTML for single payment instructions. You can use simple HTML tags if needed.',
                ],
            ];
        }

        return [
            'version' => '1.0.0',
            'author' => 'alex2276564',
            'homepage' => 'https://github.com/alex2276564/FOSSManualPayment',
            'supports_one_time_payments' => true,
            'supports_subscriptions' => false,
            'description' => 'Manual Payment gateway allows administrators to set up custom manual payment instructions with partial HTML support.',
            'logo' => [
                'logo' => 'FOSSManualPayment.png',
                'height' => '50px',
                'width' => '50px',
            ],
            'form' => $formConfig,
        ];
    }

    public function getHtml($api_admin, $invoice_id, $subscription)
    {
        $invoice = $this->di['db']->getExistingModelById('Invoice', $invoice_id);
        return $this->_generateForm($invoice);
    }

    protected function _generateForm(Model_Invoice $invoice)
    {
        $customHtmlFields = ['custom_html', 'custom_html2', 'custom_html3'];
        $html = '<div class="manual-payment-instructions">';

        foreach ($customHtmlFields as $field) {
            if (!empty($this->config[$field])) {
                $text = nl2br($this->config[$field]);
                // Replacing links with HTML tag <a>
                $text = preg_replace('/(https?:\/\/[^\s<]+)/', '<a href="$1">$1</a>', $text);
                $html .= '<p>' . $text . '</p>';
            }
        }

        $html .= '<p><a href="' . $this->di['url']->link('support') . '" class="btn btn-secondary">Open Support Ticket</a></p>';
        $html .= '</div>';

        return $html;
    }

    public function processTransaction($api_admin, $id, $data, $gateway_id)
    {
        // This payment method does not support direct transaction processing.
        throw new Exception('Direct transaction processing is not supported for this payment method.');
    }
}
