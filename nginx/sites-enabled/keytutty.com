server {
    listen 80;
    listen [::]:80;

    root /var/www/html/keytutty.com;
    index index.html index.htm;

    server_name keytutty.com;  # Cambia esto por tu dominio real o usa una subdirectorio

    location / {
        try_files $uri $uri/ =404;
    }
}
