# Laravel 5.1 LTS Wrapper for Handset Detection #

A minimal service provider to set up and use the Handset Detection 4.x PHP library in Laravel v5.1 LTS.

## How it works ##

This package contains a service provider, which binds an instance of an initialized HandsetDetection client to the IoC-container.
You receive the HandsetDetection client through dependency injection.

## Usage example ##

	class HandsetDetectionManager
	{
		protected $handsetdetection;

		/**
		 * Pull the HandsetDetection-instance from the IoC-container.
		 */
		public function __construct(\HandsetDetection $handsetdetection)
		{
			$this->handsetdetection = $handsetdetection;
		}

		/**
		 * Access the handsetdetection API
		 * See this link for more API info https://handsetdetection.readme.io/v4/docs
		 *
		 * @param array $headers An assoc array of HTTP headers or device Build Information.
		 * @param array A device profile on success or null otherwise.
		 */
		public function detect($headers)
		{
			$reply = null;
			try {
				$reply = $this->handsetdetection->deviceDetect($headers);
			} catch (\Exception $e) {
				// do something
			}
			return $reply;
		}
	}

Or, manually instantiate the client by using:

	$handsetdetection = app('HandsetDetection');

## Setup ##

### Step 1: Adding the dependency to composer.json ###

Add this to your composer.json.

	"require": {
	    "HandsetDetection/laravel-51-lts-wrapper": "4.*",
	}

### Step 2: Register the service provider ###

Register the service provider in config/app.php by inserting into the providers array

	'providers' => [
	    HandsetDetection\Laravel51LTS\HandsetDetectionServiceProvider::class,
	]

### Step 3: From the command-line run ###

	php artisan vendor:publish --provider="HandsetDetection\Laravel51LTS\HandsetDetectionServiceProvider"

This will publish config/handsetdetection.php to your config folder.

###	Step 4: Edit your config file	###

Place your Handset Detection access credentials in the config file.

Job Done.

Let us know if you have any hassles : hello@handsetdetection.com

Happy Detecting :-)
