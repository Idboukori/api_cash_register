# api_cash_register  

REST API that can do:  
1. Admin: Add a product (properties: barcode, name, cost, vat-class (6% or 21%))  
2. Admin: List all products  
3. Cash register: Get a product by barcode  
4. Cash register: Create a new receipt  
5. Cash register: Add a product by barcode to the receipt  
6. Cash register: Change the amount of the last product on the receipt  
7. Cash register: Finish a receipt  
8. Cash register: Get the receipt, including all product names grouped, amount of that product,
costs per row and total, and total vat per class
  
## step 1 : run commands
docker-compose up --build  
docker ps  
docker exec -it "CONTAINER-PHP-ID" bash ( replace the CONTAINER-PHP-ID )  
$ composer install  
$ php bin/console doctrine:database:create  
$ php bin/console doctrine:migrations:version --add --all  
$ php bin/console make:migration  
$ php bin/console doctrine:migrations:migrate   

If any problem happened with migrations, try to do this :  

1 - delete existing migrations.  
2 - change the name of database on env file .  
3 - then try again this commands :  
$ php bin/console doctrine:database:create  
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
