# Laravel 5.1 LTS Wrapper for Handset Detection #

A minimal service provider to set up and use the Handset Detection 4.x PHP library in Laravel v5.1 LTS.

## Usage example ##

	/**
	 * Where $httpHeaders is a key=>value array of headers, for example :
	 *     array(
	 *         'user-agent' => "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; fr_FR) AppleWebKit (KHTML, like Gecko) Mobile"
	 *     )
	 **/
	$hd = App('HandsetDetection');
	$hd->deviceDetect($httpHeaders);

Call any of the Handset Detection 4.x PHP library methods in this same fashion. Additional examples at [PHP APIKit Home](https://github.com/HandsetDetection/php-apikit "Handset Detection PHP APIKit") .

	$hd->deviceVendors();
	$hd->deviceModels('Nokia');
	$hd->deviceWhatHas('network', 'EDGE');
	$hd->deviceFetchArchive();
	$hd->communityFetchArchive();

Here's a snippet that ties it all together with a few sample detections.

	$data = array (
		array (
			'user-agent' => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36"
		),
		array (
			'user-agent' => "Mozilla/5.0 (Linux; U; Android 2.3.6; en-us; SAMSUNG-SGH-I577 Build/GINGERBREAD) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1"
		),
		array (
			'user-agent' => "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; fr_FR) AppleWebKit (KHTML, like Gecko) Mobile [FBAN/FBForIPhone;FBAV/4.0.2;FBBV/4020.0;FBDV/iPhone3,1;FBMD/iPhone;FBSN/iPhone OS;FBSV/4.3.3;FBSS/2; FBCR/TELUS;FBID/phone;FBLC/fr_FR;FBSF/2.0]"
		),
		array (
			'user-agent' => "Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; fr_FR) AppleWebKit (KHTML, like Gecko) Mobile",
			'x-local-hardwareinfo' => "480:320:275:200"
		)
	);
	
	$hd = App('HandsetDetection');
	foreach ($data as $headers) {
		$return = $hd->deviceDetect($headers);
		$reply = $hd->getReply();
		$this->info(json_encode($reply));
	}

## Setup ##

### Step 1: Adding the dependency to composer.json ###

Add this to your composer.json. This will also fetch

	"require": {
	    "handsetdetection/laravel51-provider": "1.*",
	}

### Step 2: Register the service provider ###

Register the service provider in config/app.php by inserting into the providers array

	'providers' => [
	    HandsetDetection\Laravel51Provider\HandsetDetectionServiceProvider::class,
	]

### Step 3: From the command-line run ###

	php artisan vendor:publish --provider="HandsetDetection\Laravel51Provider\HandsetDetectionServiceProvider"

This will publish config/handsetdetection.php to your config folder.

###	Step 4: Edit your config file	###

Place your Handset Detection access credentials in the config file.


Job Done.

Let us know if you have any hassles : hello@handsetdetection.com

Happy Detecting :-)
