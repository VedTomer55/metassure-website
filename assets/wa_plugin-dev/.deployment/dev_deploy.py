import sys
import boto3

session = boto3.session.Session()

aws_client = session.client('s3',
                            region_name='ap-south-1',
                            endpoint_url='https://s3.amazonaws.com',
                            aws_access_key_id=str(sys.argv[1]),
                            aws_secret_access_key=str(sys.argv[2]))

print("Deploying to AWS S3")

with open("wachat-1.0.js", "rb") as f:
    aws_client.upload_fileobj(f, "static-assets-dc", "plugin/wa/js/dev/wachat-1.0.js", ExtraArgs={'ACL': 'public-read'})

with open("wabot-1.0.js", "rb") as f:
    aws_client.upload_fileobj(f, "static-assets-dc", "plugin/wa/js/dev/wabot-1.0.js", ExtraArgs={'ACL': 'public-read'})
