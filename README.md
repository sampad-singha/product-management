#Workflow:
1. git clone https://github.com/sampad-singha/product-management.git
2. cd product-management
3. cp .env.example .env
4. create database: product_management
5. composer install
6. php artisan key:generate
7. npm intall
8. npm run build
9. php artisan migrate:fresh --seed

#Platform Requirement:
1. PHP v8.2+
2. node v22+
