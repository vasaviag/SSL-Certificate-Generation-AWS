<?php

include 'final.php';
$key_ELB = 'Enter-Your-IAM-Key'; //Enter Your IAM key here
$secret_ELB='Enter-Your-IAM-Secret-Key'; //Enter Your IAM Secret key here

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

$old_cert = $client_ELB->describeListenerCertificates([
	'ListenerArn' => '<string>', // REQUIRED
]);

$k = $old_cert->search('Certificates.CertificateArn');

$attach = $client_ELB->addListenerCertificates([
	'Certificates' => [ // REQUIRED
		[
			'CertificateArn' => $cert_arn,
			'IsDefault' => false,
		],
],
'ListenerArn' => '<string>', // REQUIRED
]);


$remove = $client_ELB->removeListenerCertificates([
	'Certificates' => [ // REQUIRED
		[
		'CertificateArn' => $k,
		'IsDefault' => false,
	],
],
	'ListenerArn' => '<string>', // REQUIRED
]);

$delete_cert = $client_acm->deleteCertificate([
	'CertificateArn' => $k, // REQUIRED
]);


