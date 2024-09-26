# Avada PHP Element Plugin

## Overview
This plugin adds a custom Fusion Builder element for the Avada theme that allows administrators to add and execute PHP code within pages. It provides a user-friendly interface for entering PHP code, with an option to choose whether to execute the code or simply display it as text.

## Features
- Add a PHP code block element to Avada Fusion Builder.
- Only administrators can add and execute PHP code.
- Option to execute the PHP code or display it as plain text.
- Custom CSS class option for styling the output.

## Installation

1. **Download the Plugin:**
   - Download the plugin files and place them into a folder named `avada-php-element` inside the `/wp-content/plugins/` directory.

2. **Activate the Plugin:**
   - Go to your WordPress Admin Dashboard, then navigate to Plugins > Installed Plugins.
   - Find the "Avada PHP Element" plugin in the list and click "Activate."

3. **Usage:**
   - Open the Avada Fusion Builder on the page or post where you want to add PHP code.
   - Search for the "PHP Code Block" element.
   - Add the element to your page and enter your PHP code into the provided text area.
   - Use the "Execute PHP?" option to decide whether the PHP code should be executed or simply displayed as plain text.
   - Optionally, apply a custom CSS class to the block for further styling.

## Shortcode
You can also add PHP code blocks directly using the shortcode:

```
[php_code_block php_code="<your_php_code>" execute_php="yes/no" custom_class="your-custom-class"]
```

- `php_code`: Add your PHP code here.
- `execute_php`: Set to `yes` to execute the PHP code or `no` to display it as plain text.
- `custom_class`: Add a custom CSS class for styling purposes.

## Example

```php
[php_code_block php_code="<?php echo 'Hello, World!'; ?>" execute_php="yes" custom_class="custom-output"]
```

## Security Warning
Only administrators have permission to execute PHP code for security reasons. If non-admin users attempt to execute code, they will see the message: 
```
"You do not have permission to execute PHP code."
```

## License
- License: GPLv2
- License URI: https://www.gnu.org/licenses/gpl-2.0.html

## Support
For any issues, you can reach out to the plugin author [Randal Burger](https://www.paypal.me/codelyfe).
