export DBHOST='<database endpoint>'
export DBNAME='chatserver'
export DBUSER='admin'
export DBPASSWD='quack1nce4^'
export MYSQL_PWD='quack1nce4^'

cat messages_to_csv.sql | mysql -u $DBUSER -h $DBHOST $DBNAME > database_backup.csv
python3 backup_to_bucket.py
rm database_backup.csv