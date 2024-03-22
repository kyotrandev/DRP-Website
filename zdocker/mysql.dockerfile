# Use the official MySQL 8.3.0 image
FROM mysql:8.3.0

# Set environment variables
ENV MYSQL_DATABASE=ct07_db \
    MYSQL_ROOT_PASSWORD=admin \
    MYSQL_USER=ad_db_ct07 \
    MYSQL_PASSWORD=admin \
    MYSQL_ALLOW_EMPTY_PASSWORD=yes \
    TZ=Asia/Ho_Chi_Minh  

# # Copy the data.sql file to the Docker container
COPY ./Data/dump/*.sql /docker-entrypoint-initdb.d/

# Expose MySQL port
EXPOSE 3306

# Set permissions to make sure the script is executable
RUN chmod +x /docker-entrypoint-initdb.d/*.sql
