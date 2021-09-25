export DBHOST='chatserverdb.cd3ixmxbmpj0.us-east-1.rds.amazonaws.com'
export DBNAME='chatserverdb'
export DBUSER='admin'
export DBPASSWD='Quack1nce4^'
export MYSQL_PWD='Quack1nce4^'

cat messages_to_csv.sql | mysql -u $DBUSER -h $DBHOST $DBNAME > database_backup.csv
python3 backup_to_bucket.py
rm database_backup.csv