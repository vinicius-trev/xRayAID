# WEBSITE

This subdirectory contains all the files that are used on the [xRayAID website](https://xrayaid.com.br). The backend solution uses PHP version 7.1, and must be installed on you system. This documentation will not cover deployment on Apache/Nginx and PHP installation, since it is widely available on internet, it will also not cover postfix, dovecot, certbot, and system instalation/configuration. Feel free to contact me if any doubts by email: [Vinicius Trevisan](mailto:vinicius_trev@hotmail.com).

The website is segmented in four major folders:
- dist/: Contain basically all the frontend pages.
- dist/backend: Contain PHP backend logic pages.
- dist/css: All CSS and design pages.
- dist/js: All scripts used to interact with the page.

The name of the pages are self explanatory.

## Notes

There are some backend PHP codes that needs changes on mysql login informations. There is also some backend codes that needs your re-CAPTCHA secret key:
- `backend/login_server.php`
- `backend/password_server.php`
- `backend/register_server.php`
- `backend/index_server.php`