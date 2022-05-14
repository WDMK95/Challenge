

## Twitter Clone Challenge Laravel

This was a coding challenge for a twitter clone. The technologies user are as follows:



- [Laravel Sail](https://laravel.com/docs/9.x/sail).
- [Laravel Jetstream](https://jetstream.laravel.com/2.x/introduction.html).
- [Laravel Livewire](https://laravel-livewire.com/).
- [MySQL](https://www.mysql.com/).



These were the routes that were requested and wether they were implemented respectively:
[x] /signup
[x] /login
[x] /tweet
[x] /retweet
[x] /follow
[x] /followers
[x] /profile
[x] /feed
[x] /fakeTweet (impersonate another user when you are an admin)

## Setup locally
Prerequesites:
To boot the project you need [Docker](https://www.docker.com/) with the command `docker-compose up` or alternatively if [Laravel Sail](https://laravel.com/docs/9.x/sail) is available `./vendor/bin/sail up`.

- Create database schema and setup `.env` accordingly
- Run `./vendor/bin/sail artisan migrate:fresh --seed` to execute the migrations and seed the default users
- Run `./vendor/bin/sail npm install && ./vendor/bin/sail npm dev`

Register or Login with default generated users:
- Admin
    - `email:` admin@example.com
    - `password:` password
- Normal
    - `email:` normal@example.com
    - `password:` password



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
