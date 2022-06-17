# PHP-URL-SHORTENER

A Base62 encode based URL shortener using Laravel & Vue

## Setup

1. Open Terminal and Run `cp .env.example .env`
2. Update your `.env` information like, Database info, google safe browsing details, etc.
3. Run `php artisan key:generate`.
4. Run `composer install`.
5. Then run `npm install && npm run dev`.
6. You can import `url_shortener_dump.sql` into your database or run `php artisan migrate`.
7. Run `php artisan config:cache` to cache all config files.
8. Then `php artisan serve`.
9. You will see your project will be up & running.
10. ALL DONE !!
11. Just open browser and hit `http://localhost:8000`.

## Available Route List

| Route URL                                              | Method Type | Payload    |
|--------------------------------------------------------|-------------|------------|
| http://locahost:8000/home                              | GET         |
| http://localhost:8000/home/{SHORT-URL}                 | GET         |
| http://localhost:8000/api/v1/url-shortener             | POST        | `full_url` |
| http://localhost:8000/api/v1/url-shortener/{SHORT-URL} | GET         |

## Sample websites

| URL                                                       | Type           |
|-----------------------------------------------------------|----------------|
| https://developers.google.com/safe-browsing/v4/lookup-api | **Good**       |
| https://testsafebrowsing.appspot.com/s/phishing.html      | **Unsafe URL** |


## Things can be done for further development

* Implement Docker.
* Add DTO for better Type Hint experience.
* Implement another website to check valid websites.
