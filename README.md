# api_cash_register
## step 1 : run commands
docker-compose up --build  
docker ps  
docker exec -it "CONTAINER-PHP-ID" bash ( replace the CONTAINER-PHP-ID )  
$ composer install  
$ php bin/console doctrine:database:create  
$ php bin/console doctrine:migrations:version --add --all  
$ php bin/console make:migration  
$ php bin/console doctrine:migrations:migrate  

## step 2 : Configuration JWT  
$ mkdir -p config/jwt  
$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096  
Enter the passphrase  
$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout  
Validate the passphrase  
  
Now go to .env file and add this 3 lines :  
  
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem  
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem    
JWT_PASSPHRASE= YOUR PASSPHRASE ( Don't forget to replace YOUR PASSPHRASE with yours )  
 
step 3 : Création user  
use an API Testing tool to create users such as Advanced Rest Client : https://install.advancedrestclient.com/install  
Execute a POST Request using url : http://localhost:10300/register  
copy on the Body a json like this 2 examples :   
{  
"username": "admin",  
"password": "choose a password",  
"email": "choose an email",  
"roles": [ "ROLE_USER" , "ROLE_ADMIN"  
]  
}  
{  
"username": "user",  
"password": "choose a password",  
"email": "choose an email",  
"roles": [  
"ROLE_USER"  
]  
}  
}  
  
step 3 : Utilisation de l'app  
Go to the angular part of this project :  
  
https://github.com/Idboukori/cashRegisterUi  
