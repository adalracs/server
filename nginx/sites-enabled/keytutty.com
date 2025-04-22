server {
    listen 80;
    listen [::]:80;

    root /var/www/html/keytutty.com;
    index index.html index.htm;

    server_name keytutty.com www.keytutty.com;

    location / {
        try_files $uri $uri/ =404;
    }
}
