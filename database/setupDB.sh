#!/usr/bin/env bash
export DBHOST='<database endpoint>'
export DBNAME='chatserver'
export DBUSER='admin'
export DBPASSWD='quack1nce4^'
export MYSQL_PWD='quack1nce4^'

echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

echo "DB SETUP-------------------------------------------------------------"
cat /vagrant/database/chatserver.sql | mysql -u $DBUSER -h $DBHOST $DBNAME