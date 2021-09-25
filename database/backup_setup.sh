pip install boto3
mkdir ~/.aws
mv /vagrant/.aws/credentials ~/.aws/credentials
crontab -e
#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "30 0 * * * /vagrant/database/backup_messages.sh" >> mycron
#install new cron file
crontab mycron
rm mycron