# SSL-Certificate-Generation-AWS
Automation of generation of SSL certificates through Amazon Certificate Manager, attaching it to the Load Balancer and deleting if any old certificate exists

You need to Install aws-php-sdk Here is a link which can be followed to do so - https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/getting-started_installation.html

GenerateCertificate.php - Generates SSL Certificates for the specified domain names and alternate domain names

AttachCertificateAndDeleteOldCertificate.php - Attaches the generated certificates to the Elastic Load Balancer and deletes the old ones if any.

You need to update your IAM KEY, IAM SECRET KEY, Domain Names and Alternate Domain Names in GenerateCertificate.php

You need to update your IAM KEY, IAM SECRET KEY and Listener ARN in AttachCertificateAndDeleteOldCertificate.php