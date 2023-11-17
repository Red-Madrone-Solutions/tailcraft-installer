# TailCraft Installer

The TailCraft Installer is a Composer package that simplifies the process of setting up the [TailCraft base theme](https://github.com/Red-Madrone-Solutions/tailcraft) for WordPress development. TailCraft is a Tailwind CSS-based starter theme that provides a modern build process and an organized PHP class structure for block-based themes.

## Features

- Global Composer installation for easy access
- Simple command-line interface to set up TailCraft
- Customizations over [TailPress](https://github.com/jeffreyvr/tailpress) for a starting point more inline with my own site build practices (Note: Details on changes to be fleshed out)

## Installation

**Prerequisites:**
- Composer
- PHP version 8.0 or higher

**Steps:**
1. Add the TailCraft Installer repository to your global Composer configuration (this package is not yet available on Packagist).
2. Run the following command to install the TailCraft Installer globally:
   ```
   composer global require rms/tailcraft-installer
   ```
3. Once installed, you can access the installer help using:
   ```
   tailcraft -h
   ```

Please note that the TailCraft Installer is currently in active development and is not ready for production use.

## Contributing

Contributions are welcome for both the TailCraft Installer and the base theme. We are looking to add support for the installation of pre-defined blocks to streamline the setup of new sites.

## License

This project is licensed under the ISC License.

## Contact

For support or more information, please contact:

Matt Vanderpol  
Email: matt@redmadronesolutions.com  
Website: https://mattvanderpol.com
