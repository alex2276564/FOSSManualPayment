# FOSSManualPayment for FOSSBilling 💳

[![FOSSBilling Version](https://img.shields.io/badge/FOSSBilling-Latest-green)](https://fossbilling.org/)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-8892BF)](https://www.php.net/downloads.php)
[![Version](https://img.shields.io/github/v/release/alex2276564/FOSSManualPayment?color=blue)](https://github.com/alex2276564/FOSSManualPayment/releases/latest)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

**FOSSManualPayment** is a flexible payment gateway plugin for FOSSBilling that allows administrators to set up custom manual payment instructions.

## ✨ Features

- ✅ **Fully Customizable:** Set up your own HTML for payment instructions.
- ✅ **Flexible Design:** Create any layout or design for your payment page.
- ✅ **Multiple Payment Methods:** Support various payment methods with custom instructions.
- ✅ **Easy Configuration:** Simple setup through the FOSSBilling admin panel.

## 📥 Installation

1. **Ensure you have FOSSBilling installed on your server (latest version).**

2. **Download the latest release archive (`FOSSManualPayment.zip`) from the [Releases](https://github.com/alex2276564/FOSSManualPayment/releases) section.**

3. **Extract the contents of the archive and drag and drop (or upload) the `library` and `data` folders into the root directory of your FOSSBilling installation.**  This will place the necessary files in the correct locations.

4. **(Optional) Add a custom logo:**
   - If you want to use a custom logo, name the logo file `FOSSManualPayment.png` and place it in the `/data/assets/gateways/` directory of your FOSSBilling installation. If no custom logo is provided, the default logo will be used.

5. **Activate the plugin** through the `FOSSBilling admin panel > System > Payment Gateways > New Gateway payment`.

## 🛠️ Compatibility

- **PHP Versions:** 7.4 and newer
- **FOSSBilling:** Latest version

## 🖥️ Configuration Examples

Here are some examples of how you can configure the custom HTML field for different payment methods:

### 1. Visa Direct Transfer

```html
<h2>Visa Direct Transfer</h2>
Please follow these steps to complete your payment:
Open your bank's mobile app or website
Navigate to the Visa Direct transfer option
Enter the following card number: 4111 1111 1111 1111
Enter the amount
Complete the transfer
<strong>Note:</strong> Payments from Russian banks may not be possible due to sanctions. If you are using a Russian bank, please contact our support team or use alternative payment methods.
Once completed, please contact our support team with your transaction details.
```

### 2. FunPay Transfer

```html
<h2>FunPay Payment</h2>
To complete your payment via FunPay, please follow these steps:
Go to our FunPay listing: https://funpay.com/en/users/userId/
Purchase the item with the following description: "Payment for hosting"
Complete and confirm receipt the purchase on FunPay
After completing the purchase, please open a support ticket with your FunPay transaction ID.
```

### 3. Generic Example

```html
<h2>Custom Payment Method</h2>
This is an example of a custom payment method. You can add any text here to create your desired payment instructions.
Add payment steps
Include contact information
Embed external content
```

## 📝 Important Notes

- **Form Length:** For each payment method, use a separate form in the configuration. Long text in a single form can cause infinite page loading.
- **Unused Fields:** If you are not using all custom instruction fields, insert a single space in each unused field to avoid validation errors. This is a temporary workaround.

## 🆘 Support

If you encounter any issues or have suggestions for improving the plugin, please create an issue in this repository.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

[Alex] - [https://github.com/alex2276564]

We appreciate your contribution to the project! If you like this plugin, please give it a star on GitHub.

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the issues page.

### How to Contribute

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/YourFeature`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/YourFeature`).
5. Open a Pull Request.

---

Thank you for using **FOSSManualPayment for FOSSBilling**! We hope it enhances your billing system and makes managing custom payment methods easier. 💰🌐
