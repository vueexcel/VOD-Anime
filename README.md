
## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Installation

### Clone the Repository
Clone the project repository to your local machine:
```bash
git clone https://github.com/vueexcel/VOD-Anime.git
```
    
### Install dependencies using Composer
```bash
cd VOD-Anime
composer install
```

### Set Environment Variables
Copy the .env.example file to .env in your fronend and backend both and configure your environment variables such as database connections, email configurations, etc.
```bash
cp .env.example .env
```
### Generate Application Key
Run the following command to generate the application key:

```bash
php artisan key:generate
```

### Run Migrations
Run database migrations to set up your database schema:
```bash
php artisan migrate
```
### Seed the Database
Run the import command. This will populate the database with 100 popular anime entries:
```bash
php artisan anime:import
```

### Start the Development Server
You can start the Laravel development server by navigating to Server directory cd Server
```bash 
php artisan serve
```

## Access the API
Open your browser and access the API endpoint to fetch anime information.

For example:

```bash
http://127.0.0.1:8000/api/anime/naruto
```
This would fetch information about the anime Naruto.

## Screenshots
![Response](https://github.com/user-attachments/assets/cc102cb4-8ccb-4bb8-82aa-408c2d4537de)
