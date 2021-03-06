<?php

require 'vendor/autoload.php';
use Aws\Acm\AcmClient;
use Aws\ElasticLoadBalancingV2\ElasticLoadBalancingV2Client;

$key_acm = 'Enter-Your-IAM-Key';//Enter Your IAM key here
$secret_acm = 'Enter-Your-IAM-Secret-Key';//Enter Your IAM Secret key here
$DomainName = 'Enter the main domain name here';//Enter the main domain name
$AltNames = ['Enter the alternate domain names here'];//Enter all the alternate domain names];

$client_acm = AcmClient::factory(
	array(
		'credentials' 		=> array(
			'key' 		=> $key_acm,
			'secret' 	=> $secret_acm
		),
		'version' => 'latest',
		'region'  => 'Enter-region'//Enter the region
	)
);

$cert = $client_acm->requestCertificate([

'DomainName' => $DomainName, // REQUIRED
'DomainValidationOptions' => [
	[
		'DomainName' 		=> $DomainName, // REQUIRED
		'ValidationDomain' 	=> $DomainName, // REQUIRED
	],

],
'SubjectAlternativeNames' => $AltNames,

'ValidationMethod' => 'DNS',
]);

$certArn = $cert->search('CertificateArn');

$result = $client_acm->describeCertificate([
	'CertificateArn' => $certArn, // REQUIRED
]);


$r=$result->search('Certificate.DomainValidationOptions');
$r=(array)$r;
$k1 = array();
$size = count($r);
for($i = 0 ; $i < $size ; $i++)
{
	$k1[$i] = array ('DName' => $r[$i]['DomainName'] ,
		'Records' 	=> array ('Name' => $r[$i]['ResourceRecord']['Name'] ,
		'Value' 	=> $r[$i]['ResourceRecord']['Value']));
}

$cname = json_encode($k1);
echo($cname);