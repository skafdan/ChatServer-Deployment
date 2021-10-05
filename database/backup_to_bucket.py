import boto3
import datetime

s3 = boto3.client('s3') 
with open("database_backup.csv", "rb") as f:
    current_datetime = f"{datetime.datetime.now().strftime('%Y-%m-%d_%H-%M-%S')}"
    s3.upload_fileobj(f, "<bucket name>", "BACKUP_"+current_datetime)