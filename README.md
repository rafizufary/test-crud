## Installation

1. Clone the project repository:

   ```sh
   git clone https://github.com/rafizufary/test-crud.git
   ```

3. Install Composer Dependencies:

   ```sh
   composer install   
   ```

3. Copy the Environment File:
   
   ```sh
   cp .env.example .env
   ````
4. Generate Application Key:

   ```sh
   php artisan key:generate
   ```
5. Run Database Migrations and Seed the Databse:
   
   ```sh
   php artisan migrate:fresh --seed
   ```
6. Link Storage:

   ```sh
   php artisan storage:link
   ```

## Configuration

Before running the application, you need to configure the `.env` file.

### Database Configuration

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_crud
DB_USERNAME=root
DB_PASSWORD=
```

Replace everything with your actual database credentials.

## Testing

To test the application feature, use the following commands:

```javascript
php artisan test
```
 
## Usage

To run the application, use the following commands:

```javascript
php artisan serve
```
