SECURA SERVER is a PHP CODEIGNITER  based project which exposes REST APIs to perform transfer of files to common 3rd Party Storage Infrastructure securely.

Files are encrypted on Client Side useing SECURA CLIENT which transfers files to the SECURA SERVER over HTTP/HTTPS. Then SECURA SERVER performs SFTP file transfer to storage. In this manner the login credentials of storage are not available to everyone and files being encryprted on Client Side using user's private key are secured in 3rd Party Storage.

SecuraServer provide a layer of abstraction to end users by hiding complex storage mechanism and exposing simple REST based APIs.

SECURA STORE performs API authentication before allowing any operation using APIs. The UserAPI in SECURASERVER facilitates the following:

1)USER INFO (GET METHOD)
2)USER FILES (GET METHOD)
3)UPLOAD SMALL(4MB or LESS) FILES TO STORAGE(POST)
4)UPLOAD LARGE(GREATER THAN 4MB) FILES TO STORAGE(POST)
5)DOWNLOAD FILES FROM STORAGE (GET)
6)DELETE FILES FROM STORAGE(GET)


This infrastructure only provide front end view for an Admin priviledge user to monitor statistics and functioning of the infrastructure, file transfer and handling can be done with SECURA CLIENT.

The Technology Stack used here is:
>PHP 7.0
>HTML
>CSS/BOOTSTRAP
>JAVASCRIPT
>JQUERY
>Python


Although still under development interested users can pull the code and deploy it on a LAMP stack with python support. It has been tested on Centos and Ubuntu Machines extensively. Following python packages are also required:

1. PARAMIKO
2. PYSFTP
3. PYCRYPTO


For feedback get in touch with me at: hardiksinghnegi@gmail.com

