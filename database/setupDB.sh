#!/usr/bin/env bash
export DBHOST='chatserverdb.cd3ixmxbmpj0.us-east-1.rds.amazonaws.com'
export DBNAME='chatserverdb'
export DBUSER='admin'
export DBPASSWD='Quack1nce4^'
export MYSQL_PWD='Quack1nce4^'

echo "mysql-server mysql-server/root_password password $MYSQL_PWD" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password $MYSQL_PWD" | debconf-set-selections

echo "DB SETUP-------------------------------------------------------------"
cat /vagrant/database/chatserver.sql | mysql -u $DBUSER -h $DBHOST $DBNAME