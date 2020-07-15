<?php

include 'GenerateCertificate.php';
$key_ELB = 'Enter-Your-IAM-Key'; //Enter Your IAM key here
$secret_ELB ='Enter-Your-IAM-Secret-Key'; //Enter Your IAM Secret key here
$listnerArn = 'Enter-Listener-Arn'; //Enter Listener Arn

$client_ELB = ElasticLoadBalancingV2Client::factory(
		array(
			'credentials' 		=> array(
					'key' 		=> $key_ELB,
					'secret' 	=> $secret_ELB
			),
			'version' 	=> 'latest',
			'region' 	=> 'us-east-1'
			)
);

$oldCert = $client_ELB->describeListenerCertificates([
	'ListenerArn' => $listnerArn, // REQUIRED
]);

$oldCertArn = $oldCert->search('Certificates.CertificateArn');

$attach = $client_ELB->addListenerCertificates([
	'Certificates' => [ // REQUIRED
		[
			'CertificateArn' => $cert_arn,
			'IsDefault' => false,
		],
],
'ListenerArn' => $listnerArn, // REQUIRED
]);

$remove = $client_ELB->removeListenerCertificates([
	'Certificates' => [ // REQUIRED
		[
		'CertificateArn' => $oldCertArn,
		'IsDefault' => false,
	],
],
	'ListenerArn' => $listnerArn, // REQUIRED
]);

$delete_cert = $client_acm->deleteCertificate([
	'CertificateArn' => $listnerArn, // REQUIRED
]);