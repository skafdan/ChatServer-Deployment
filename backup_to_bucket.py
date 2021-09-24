import boto3
import datetime

# Requires existence of ~/.aws/credentials ?
s3 = boto3.client('s3') 
with open("table_data.csv", "rb") as f:
    current_datetime = f"{datetime.datetime.now().strftime('%Y-%m-%d_%H-%M-%S')}"
    s3.upload_fileobj(f, "BUCKET_NAME", "BACKUP_"+current_datetime)