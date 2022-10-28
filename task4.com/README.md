![Innowise Group Logo](public/inno-logo.png)
# Task 4 solution

# Run the application
- Make sure Apache2 is installed.
- run `git clone https://github.com/TheRaymondPlex/Tasks/tree/Task4`.
- Create new `YourConfName.conf` file in `sites-available` folder of Apache.
- Change `ServerName` to `www.your-site.com`.
- Change `DocumentRoot` to `/path/to/downloaded/project/folder/with/index/file`.
- Add this line to your hosts file `127.0.0.1 www.your-site.com` for being able to enter site with your own host.
- Install composer for PHP if you don't have it already.
- Rename `.env.example` file to `.env`.
- Fill the required fields in `.env` file with correct data.
- run `sudo a2ensite YourConfName`.
- run `sudo service apache2 restart`.