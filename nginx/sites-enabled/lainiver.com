server {
    listen 80;
    listen [::]:80;

    root /var/www/html/lainiver.com;
    index index.html index.htm;

    server_name lainiver.com www.aliniver.com;

    location / {
        try_files $uri $uri/ =404;
    }
}
