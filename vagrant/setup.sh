#!/bin/sh

# install packages
sudo yum install httpd -y
sudo yum install mysql-server -y
sudo yum install php php-mysql php-pdo -y

# setup mysqld
sudo /etc/init.d/mysqld start
sudo chkconfig mysqld on
mysql -uroot < /vagrant_data/ddl/01_create_database.sql 
mysql -uroot -Dmeigen_db < /vagrant_data/ddl/02_create_table.sql
mysql -uroot -Dmeigen_db < /vagrant_data/ddl/03_foreign_key.sql 
mysql -uroot -Dmeigen_db < /vagrant_data/ddl/04_index.sql 

# setup httpd
sudo mkdir /var/log/meigen
sudo chmod 777 /var/log/meigen
sudo rm -rf /var/www/html
sudo ln -s /vagrant_data /var/www/html
sudo ln -s /vagrant_data /var/www/meigenkun
sudo /etc/init.d/httpd start
sudo chkconfig httpd on
