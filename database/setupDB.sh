#!/usr/bin/env bash

export DBHOST='localhost'
export DBNAME='chatserver'
export DBUSER='root'
export DBPASSWD='root'

export MYSQL_PWD='root'

echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

echo "CREATE DATABASE $DBNAME;" | mysql

echo "CREATE USER '$DBUSER'@'%' IDENTIFIED BY '$DBPASSWD';" | mysql

echo "GRANT ALL PRIVILEGES ON $DBNAME.* TO '$DBUSER'@'%';" | mysql

cat /vagrant/database/chatserver.sql | mysql -u $DBUSER $DBNAME

sed -i'' -e '/bind-address/s/127.0.0.1/0.0.0.0/' /etc/mysql/mariadb.conf.d/50-server.cnf

service mysql restart