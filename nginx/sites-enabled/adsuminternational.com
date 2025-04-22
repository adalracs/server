server {
    listen 80;
    listen [::]:80;

    root /var/www/html/adsuminternational.com;
    index index.html index.htm;

    server_name adsuminternational.com www.adsuminternational.com;

    location / {
        try_files $uri $uri/ =404;
    }
}
